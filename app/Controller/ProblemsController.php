<?php
class ProblemsController extends AppController{
	public $name = "Problems";
	public $uses = array('Evaluate');
	public function index(){
	}
	// ユーザが作問した問題を一覧表示
	public function show_evaluation_problem(){
		$this->Session->destroy();
		// $api_urlは後に定数化
		$api_url = 'problems/index.json';
		// 非公開問題
		$priv_api_pram = 'kentei_id=1&employ=0&public_flag=0&category_id=0&item=100';
		$show_obj['priv'] = $this->get_api_data($api_url,$priv_api_pram);
		// 公開問題
		$publ_api_pram = 'kentei_id=1&employ=0&public_flag=1&category_id=0&item=100';
		$show_obj['publ'] = $this->get_api_data($api_url,$publ_api_pram);
		$this->set('show_obj',$show_obj);
	}
	// 選択した問題への評価とコメント
	public function check_evaluation_problem($id){ //making question ID
		// 選択した問題のID
		$check_obj['problem_id'] = $id;
		// 評価項目呼び出し
		// $api_urlは後に定数化
		$api_url = 'evaluateItems/index.json';
		$check_obj['evaluate_items'] = $this->get_api_data($api_url,'kentei_id=1');
		$this->set('data',$check_obj);
	}
	// 登録前に評価・コメントの内容を確認
	public function precheck_evaluation_problem(){
		$eval_cont = $this->request->data;
		$arrange_eval_data['Problems'] = $this->Evaluate->eval_cont_arrange($eval_cont);
		$arrange_eval_data['Problem_info']['id'] = $eval_cont['Problem_info']['id'];
		$this->set('arrange_eval_data',$arrange_eval_data);
	}
	// 評価登録機能'kentei_id=1'
	public function add_evaluation_problem(){
		// ログイン機能とは未連結、ユーザIDはダミー
		$eval_data = $this->request->data;
		// debug($eval_data);
		foreach ($eval_data['Problems'] as $eval_id => $eval_value){
			// user_idは、後でログイン機能から受け取る
			$add_api_pram[$eval_id]['evaluate_item_id'] = $eval_id;
			$add_api_pram[$eval_id]['problem_id'] = $eval_data['Problem_info']['id'];
			$add_api_pram[$eval_id]['user_id'] = 7;
			$add_api_pram[$eval_id]['evaluate_comment'] = $eval_value['comment'];
			if($eval_value['check'] == 1)
				$result[$eval_id] = $this->post_evaluateComments_api($add_api_pram[$eval_id]);
		}

		if(!empty($result)){
			foreach($result as $evaluate_result_id => $evaluate_result_value){
				if(!empty($evaluate_result_value['error']['code'])){
					foreach ($eval_data['Problems'] as $evaluate_id => $evaluate_value){
						if($evaluate_result_id == $evaluate_id)
							$error_list[$evaluate_result_id] = $evaluate_value['name'];
					}
				}
			}
		}else{
			$this->redirect('show_evaluation_problem');
		}
		if(!empty($error_list)){
			$this->Session->write('evaluation.error_list',$error_list);
			$this->Session->write('evaluation.Problem_id',$eval_data['Problem_info']['id']);
			$this->redirect('check_again_evaluation_problem');
			// $this->check_again_evaluation_problem($error_list);
		}else{
			$this->redirect('show_evaluation_problem');
		}
	}
	// add_ecaluatetion_problemからerror_listを受け渡し、コメントを催促・入力
	public function check_again_evaluation_problem(){
		$check_again_data['error_list'] = $this->Session->read('evaluation.error_list');
		$check_again_data['Problem_id'] = $this->Session->read('evaluation.Problem_id');
		$this->set('check_again_data',$check_again_data);
		debug($check_again_data);
	}
	// 評価履歴の一覧を表示
	public function show_evaluation_history(){
		// $api_urlは後に定数化
		$api_url = 'evaluateComments/index.json';
		$eval_record = $this->get_api_data($api_url,'user_id=7');
		$arrange_eval_data = $this->Evaluate->eval_record_arrange($eval_record);
		$this->set('arrange_eval_data',$arrange_eval_data);
	}
	// 作問者に対しての評価機能
	public function notice_evaluation(){
		$this->Session->destroy();
		// user_idのパラメータは後ほど変更
		$problem_api_pram = 'kentei_id=1&employ=0&user_id=12&item=100&public_flag=0';
		// $api_urlは後に定数化
		$api_url = 'problems/index.json';
		$problem_api_value = $this->get_api_data($api_url,$problem_api_pram);
		// view用に連想配列の中身を整える
		$arrange_notice_data = $this->Evaluate->arrange_notice_info($problem_api_value);
		if(empty($arrange_notice_data['not_found_flug'])){
			$this->set('notice_data',$arrange_notice_data);
		}else{
			$this->redirect('not_found_data');
		}
	}
	// notice_evaluation()で選択した問題・評価の詳細を見る
	public function confirm_evaluation($problem_id){
		if(!empty($problem_id)){
		  // user_idのパラメータは後ほど変更
			$problem_api_pram = 'kentei_id=1&employ=0&user_id=12&item=100&public_flag=0';
			// $api_urlは後に定数化
			$api_url = 'problems/index.json';
			$problem_api_value = $this->get_api_data($api_url,$problem_api_pram);
			// notice_evaluation()で用いたデータを再現
			$arrange_notice_data = $this->Evaluate->arrange_notice_info($problem_api_value);
			// $api_urlは後に定数化
			$api_url = 'evaluateItems/index.json';
			$evaluate_item = $this->get_api_data($api_url,'kentei_id=1');
			// view用に連想配列の中身を整える
			$arrange_confirm_data = $this->Evaluate->arrange_confirm_info($arrange_notice_data,$problem_id,$evaluate_item);
			$this->Session->write('evaluation.confirm_data',$arrange_confirm_data);
			$this->Session->write('evaluation.problem_id',$problem_id);
			$this->set('confirm_data',$arrange_confirm_data);
		}else{
			$this->redirect('not_found_data');
		}
	}
	// confirm_evaluation()で容認ボタンを押したときの処理
	public function accept_evaluation($evaluate_id){
		$confirm_data = $this->Session->read('evaluation.confirm_data');
		$accept_data['arrange_data'] = $this->Evaluate->arrange_judge_info($confirm_data,$evaluate_id);
		$this->Session->write('evaluation.confirm_data.selected_data',$accept_data['arrange_data']['Evaluate']);
		$this->set('accept_data',$accept_data);
	}
	// confirm_evaluation()で否認ボタンを押したときの処理
	public function deny_evaluation($evaluate_id){
		$confirm_data = $this->Session->read('evaluation.confirm_data');
		$deny_data['arrange_data'] = $this->Evaluate->arrange_judge_info($confirm_data,$evaluate_id);
		$this->Session->write('evaluation.confirm_data.selected_data',$deny_data['arrange_data']['Evaluate']);
		$this->set('deny_data',$deny_data);
	}
	// accept_evaluation()/deny_evaluation()で入力された確認コメントを登録
	public function add_confirm_comment(){
		$confirm_data = $this->request->data;
		$evaluate_id = $confirm_data['Problems']['evaluate_id'];
		$api_pram['confirm_comment'] = $confirm_data['Problems']['confirm_comment'];
		if(!empty($confirm_data['deny'])){
			$api_pram['confirm_flag'] = 3;
		}else if(!empty($confirm_data['accept'])){
			$api_pram['confirm_flag'] = 2;
		}
		$result = $this->put_confirmComments_api($api_pram,$evaluate_id);
		// APIの結果を使ってバリデート
		if(empty($result['error']['code'])){
			$this->Session->delete('evaluation.confirm_data');
			$problem_id = $this->Session->read('evaluation.problem_id');
			$this->redirect(array('action' => 'confirm_evaluation',$problem_id));
		}else{
			$evaluate_id = $this->Session->read('evaluation.confirm_data.selected_data.evaluate_id');
			$this->Session->write('evaluation.selected_data.error_flag',1);
			if(!empty($confirm_data['accept'])){
				$this->Session->setFlash('承認コメントを入力してください');
				$this->redirect(array('action' => 'accept_evaluation',$evaluate_id));
			}elseif(!empty($confirm_data['deny'])){
				$this->Session->setFlash('否認コメントを入力してください');
				$this->redirect(array('action' => 'deny_evaluation',$evaluate_id));
			}
		}
	}
	// どのAPIメソッドを使うかは$urlで判断する
	// $api_pramのパラメータでAPIを叩く
	public function get_api_data($url,$api_pram){
		$api_obj = $this->api_rest('GET',$url,$api_pram,array());
		return $api_obj;
	}
	// パラメータの内容で evaluateComments/add.json API にpostする
	public function post_evaluateComments_api($api_pram){
		$api_result = $this->api_rest('POST','evaluateComments/add.json',null,$api_pram);
		return $api_result;
	}
	// パラメータの内容で evaluateComments/add.json API にpostする
	public function put_confirmComments_api($api_pram,$evaluate_id){
		$api_result = $this->api_rest('PUT','evaluateComments/edit/'.$evaluate_id.'.json',null,$api_pram);
		return $api_result;
	}
	public function not_found_data(){}
}
?>
