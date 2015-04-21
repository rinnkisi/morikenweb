<?php 

class KenteiFunctionComponent extends object{
	public $name = 'KenteiFunction'; //クラス名
	
	function updateMain($pointUpdateFlag,$problemUpdateFlag,$countFlag,$problemId){
		/*$pointUpdateFlag 0=解答ポイント 1=作問ポイント 2=評価ポイント
		 *$problemUpdateFlag 0=正解 1＝不正解 2=良評価 3=悪評価
		 *共通化を目指してる途中な関数
		 */
		$this->requestAction('/kentei_full_function/problemUpdate/'.$problemUpdateFlag.'/'.$countFlag.'/'.$problemId);//問題情報更新第1引数=フラグ,第2引数=問題ID
		$this->requestAction('/kentei_full_function/pointUpdate/'.$pointUpdateFlag);//ユーザーポイント更新0=解答
	}
	
	function test(){
		$answerFlag['data'] = $this->AnswerHistory->find('all',array('conditions' => 
				array('AnswerHistory.user_id' => $this->Auth->user('id')),
				'order' => array('created' => 'DESC')
			));
		
		//正解数と誤答数を取得
		foreach ($answerFlag['data'] as $key => $value){
			if($value['AnswerHistory']['answerFlag'] == 1){
				$answerFlag['correctCount']++;
			}else{
				$answerFlag['mistakeCount']++;
			}
		}
		
//		$this->set('data',$data);
//		$this->set('answerFlag',$answerFlag);
		return $answerFlag;
	}
	
	/*ユーザーの解答履歴を記録*/
	function answerHistory($problemId,$answerFlag,$elapsedTime){
		/*
		$answerData = $this->AnswerHistory->find('all',array('conditions' => 
				array('AnswerHistory.user_id' => $this->Auth->user('id')),
				'order' => array('created' => 'DESC')
			));
		*/
		//解答履歴記録
		$this->data = array("AnswerHistory" => 
						array(
							"user_id" => $this->Auth->user('id'),
							"problem_id" => $problemId,
							"answerFlag" => $answerFlag,
							"elapsedTime" => $elapsedTime,
							)
						);
		$this->AnswerHistory->save($this->data);
	}
	
	function pointUpdate($flag){//ポイント更新
		$userData = $this->User->find('first',array('conditions' =>
				array('User.id' => $this->Auth->user('id')))); //ユーザー情報	
		$answerPoint = $userData['User']['answerPoint'];
		$makePoint = $userData['User']['makePoint'];
		$assessPoint = $userData['User']['assessPoint'];		
		if($flag == 0){
			$answerPoint++;
		}elseif($flag == 1){
			$makePoint++;
		}elseif($flag == 2){
			$assessPoint++;
		}
				
		$totalPoint = $assessPoint * 10 + $makePoint * 5 + $answerPoint;//トータルポイント計算
		//ポイント追加
		$conditions = array('User.id' => $this->Auth->user('id'));//idが一致するもの
		$contents = array(
						'User.answerPoint' => "'{$answerPoint}'", //解答ポイントを更新*/
						'User.makePoint' => "'{$makePoint}'", //作問ポイントを更新*/
						'User.assessPoint' => "'{$assessPoint}'", //評価ポイントを更新*/
						'User.totalPoint' => "'{$totalPoint}'");//評価数全体
		$this->User->updateAll($contents,$conditions);
				//更新後のデータを取得、ポイントによって権限を与えるか評価
		$userUpdateData = $this->User->find('first',array('conditions' =>
				array('User.id' => $this->Auth->user('id'))));
		//$this->requestAction('/problem_users/levelUP/'.$userUpdateData['User']['totalPoint'].'/'.$userUpdateData['User']['type']);
	}
	
	function problemUpdate($flag,$count,$id){//問題の正答率や評価の情報を更新する
		$updateTime = date( "Y-m-d H:i:s" );
		$updater = $this->Auth->user('username');

		if($flag == 0){//正解解答の場合
			$correctCount = $count;
			$correctCount++;
			$pointAdd = $correctCount;
			$addField = "Problem.correctCount";
		}elseif($flag == 1){//不正解解答の場合
			$mistakeCount = $count;
			$mistakeCount++;
			$pointAdd = $mistakeCount;
			$addField = "Problem.mistakeCount";
		}elseif($flag == 2){//良評価の場合
			$goodCount = $count;
			$goodCount++;
			$pointAdd = $goodCount;
			$addField = "Problem.goodCount";
		}elseif($flag == 3){//悪評価の場合
			$badCount = $count;
			$badCount++;
			$pointAdd = $badCount;
			$addField = "Problem.badCount";
		}
		
		$conditions = array('Problem.id' => $id);//idが一致するもの
		$contents = array('Problem.updateTime' => "'{$updateTime}'", //updateTimeを更新
								$addField => $pointAdd, //ポイント更新
								'Problem.updater' => "'{$updater}'");		
		$this->Problem->updateAll($contents,$conditions);//更新処理
	}
	
	function levelUp($totalPoint,$type){//ユーザーのレベルをアップ
		if($totalPoint >= 30 && $totalPoint < 100 && $type == 0){//30ポイント取得 解答者>>作問者
			$type++;
		}elseif($totalPoint >= 100 && $type == 1){//100ポイント以上取得した場合 作問者>>評価者
			$type++;
		}else{}
		$updateTime = date( "Y-m-d H:i:s" );
		$conditions = array('User.id' => $this->Auth->user('id'));//idが一致するもの
		$contents = array(//'User.updateTime' => "'{$updateTime}'", //updateTimeを更新*/
								'User.type' => "'{$type}'");//評価数全体
		$this->User->updateAll($contents,$conditions);
	}
	
	function acl($acl){
		if(($acl == 'assess' && $this->Session->read('type') < 2) || ($acl == 'make' && $this->Session->read('type') < 1)){
			$this->redirect('index');
		}elseif($acl == 'kentei' && $this->Auth->user('type') < 3){
		 	$this->redirect('/problem_pc_indices/');
		}
	}
	
	/*ログ記録用
	 * */
	function activity($actflag,$acl,$actionId){//第1引数=アクション 第2引数=公開範囲 第3引数=各アクションのid
		if($actflag == 0){
			$message='問題の解答を';
     	}elseif($actflag == 1){
     		$message='作問を';
     	}elseif($actflag == 2){
     		$message='問題を評価';
     	}elseif($actflag == 3){
     		$message='問題を編集';
     	}elseif($actflag == 4){
     		$message='問題にコメント';
     	}elseif($actflag == 5){
     		$message='ユーザー情報を更新';
     	}elseif($actflag == 6){
     		$message='過去問題をクリア';
     	}elseif($actflag == 7){
     		$message='バッチを取得';
     	}elseif($actflag == 8){
     		$message='テンプレートを作成';
     	}      /*作問,評価,解答,編集,ディスカッション,ユーザー情報更新,過去問クリア,バッチ取得*/
     
     	$this->data = array("Activity" => array(//コントローラ側で$this->dataを指定
			"type" => $actflag,
			"creater" => $this->Auth->user('username'),
			"createrId" => $this->Auth->user('id'),
			"acl" => $acl,
			"message" => $this->Auth->user('username')."さんが".$message.'しました。',
			"lectureId" => '5170b93d962574d617b9abc08e6d8db9',
			"actionId" => $actionId
		));
     	
     	$this->Activity->save($this->data);
	}
}
?>