<?php
class ProblemsController extends AppController{
	public $name = "Problems";
	public $uses = array('Evaluate');
	public function index(){
		$this->set('test',$this->request->data);
		// $this->set('test',"test");
	}
	// ユーザが作問した問題を一覧表示
	public function show_evaluation_problem(){
		// 非公開問題
		$priv_api_pram = 'kentei_id=1&employ=0&public_flag=0&category_id=0&item=100';
		$show_obj['priv'] = $this->api_rest('GET','problems/index.json',$priv_api_pram,array());
		// 公開問題
		$publ_api_pram = 'kentei_id=1&employ=0&public_flag=1&category_id=0&item=100';
		$show_obj['publ'] = $this->api_rest('GET','problems/index.json',$publ_api_pram,array());
		$this->set('data',$show_obj);
	}
	// 選択した問題への評価とコメント
	public function check_evaluation_problem($id){ //making question ID
		// 選択した問題のID
		$check_obj['problem_id'] = $id;
		// 評価項目呼び出し
		$check_obj['evaluate_items'] = $this->api_rest('GET','evaluateItems/index.json','kentei_id=1',array());
		$this->set('data',$check_obj);
	}
	// 登録前に評価・コメントの内容を確認
	public function precheck_evaluation_problem(){
		$eval_cont = $this->request->data;
		$arrange_eval_data['Problems'] = $this->Evaluate->eval_cont_arrange($eval_cont);
		$arrange_eval_data['Problem_info']['id'] = $eval_cont['Problem_info']['id'];
		$this->set('arrange_eval_data',$arrange_eval_data);
	}
	// 評価登録機能
	public function add_evaluation_problem(){
		// ログイン機能とは未連結、ユーザIDはダミー
		$eval_data = $this->request->data;
		foreach ($eval_data['Problems'] as $eval_id => $eval_value) {
			// user_idは、後でログイン機能から受け取る
			$add_api_pram[$eval_id]['evaluate_item_id'] = $eval_id;
			$add_api_pram[$eval_id]['problem_id'] = $eval_data['Problem_info']['id'];
			$add_api_pram[$eval_id]['user_id'] = 12;
			$add_api_pram[$eval_id]['evaluate_comment'] = $eval_value['comment'];

			$result[$eval_id] = $this->api_rest('POST','evaluateComments/add.json',null,$add_api_pram[$eval_id]);
		}
		// $this->set('data',$add_api_pram);
		// $this->set('data',$result);
		// $this->redirect('show_evaluation_problem');
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
		// $this->set('data',$error_list);
	}

	// add_ecaluatetion_problemからerror_listを受け渡し、コメントを催促・入力したい
	public function precheck_again_evaluation_problem(){
		// $this->set('data',$error_list);
	}
	// error_listにある評価項目に対してのコメントを再登録したい
	public function add_again_evaluation_problem(){
	}


	// 評価履歴表示
	public function show_evaluation_history(){
		$eval_record = $this->api_rest('GET','evaluateComments/index.json','user_id=7',array());
		$arrange_eval_data = $this->Evaluate->eval_record_arrange($eval_record);
		// $this->set('arrange_eval_data',$arrange_eval_data);
		$this->set('arrange_eval_data',$arrange_eval_data);
	}

	// 作問者に対しての評価機能
	public function notice_evaluation(){
		// user_idのパラメータは後ほど変更
		$problem_api_pram = 'kentei_id=1&employ=0&user_id=6&item=100&public_flag=1';
		$problem_api_value = $this->api_rest('GET','problems/index.json',$problem_api_pram,array());
		// view用に連想配列の中身を整える
		$arrange_notice_data = $this->Evaluate->arrange_notice($problem_api_value);
		if(empty($arrange_notice_data['not_found_flug'])){
			$this->set('notice_data',$arrange_notice_data);
		}else{
			$this->redirect('not_found_data');
		}
	}

	public function confirm_evaluation($problem_id){
		if(!empty($problem_id)){
			// user_idのパラメータは後ほど変更
			$problem_api_pram = 'kentei_id=1&employ=0&user_id=6&item=100&public_flag=1';
			$problem_api_value = $this->api_rest('GET','problems/index.json',$problem_api_pram,array());
			$arrange_notice_data = $this->Evaluate->arrange_notice($problem_api_value);

			$evaluate_item = $this->api_rest('GET','evaluateItems/index.json','kentei_id=1',array());

			// view用に連想配列の中身を整える
			$arrange_confirm_data = $this->Evaluate->arrange_confirm($arrange_notice_data,$problem_id,$evaluate_item);
			$this->set('confirm_data',$arrange_confirm_data);
			// $this->set('data',$problem_id);
		}else{
			$this->redirect('not_found_data');
		}
	}


	public function not_found_data(){
	}
}
?>
