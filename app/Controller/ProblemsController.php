<?php
class ProblemsController extends AppController{
	public $name = "Problems";
	public $uses = array('Evaluate');
	public function index(){
		// $problem_api_pram = 'kentei_id=1&employ=0&user_id=12&item=100&public_flag=0';
		// $api_url = 'problems/index.json';
		// $problem_api_value = $this->get_api_data($api_url,$problem_api_pram);
		// // view用に連想配列の中身を整える
		// // $arrange_notice_data = $this->Evaluate->arrange_notice_info($problem_api_value);
		// // if(empty($arrange_notice_data['not_found_flug'])){
		// // 	$this->set('notice_data',$arrange_notice_data);
		// // }else{
		// // 	$this->redirect('not_found_data');
		// // }
		// 	$this->set('test',$problem_api_value);
	}
	// ユーザが作問した問題を一覧表示
	public function show_evaluation_problem(){
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
		foreach ($eval_data['Problems'] as $eval_id => $eval_value) {
			// user_idは、後でログイン機能から受け取る
			$add_api_pram[$eval_id]['evaluate_item_id'] = $eval_id;
			$add_api_pram[$eval_id]['problem_id'] = $eval_data['Problem_info']['id'];
			$add_api_pram[$eval_id]['user_id'] = 7;
			$add_api_pram[$eval_id]['evaluate_comment'] = $eval_value['comment'];
			$result[$eval_id] = $this->post_evaluateComments_api($add_api_pram[$eval_id]);
		}
		foreach($result as $evaluate_item_id => $evaluate_value){
			if(!empty($evaluate_value['error']['code'])){
				$error_list[] = $evaluate_item_id;
			}
		}
		if(!empty($error_list)){
			$this->redirect(array('action' => 'precheck_again_evaluation_problem',$error_list));
		}else{
			$this->redirect('show_evaluation_problem');
		}
	}

	// add_ecaluatetion_problemからerror_listを受け渡し、コメントを催促・入力したい
	public function precheck_again_evaluation_problem(){
		// $this->set('data',$error_list);
	}
	// error_listにある評価項目に対してのコメントを再登録したい
	public function add_again_evaluation_problem(){
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
			$this->Session->write('confirm_data',$arrange_confirm_data);
			$this->set('confirm_data',$arrange_confirm_data);
		}else{
			$this->redirect('not_found_data');
		}
	}
	// confirm_evaluation()で容認ボタンを押したときの処理
	public function accept_evaluation($evaluate_id){
		$confirm_data = $this->Session->read('confirm_data');
		$arrange_accept_data = $this->Evaluate->arrange_judge_info($confirm_data,$evaluate_id);
		$this->set('accept_data',$arrange_accept_data);
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
	public function not_found_data(){}
}
?>
