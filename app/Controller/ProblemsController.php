<?php
class ProblemsController extends AppController{
	public $name = "Problems";
	public $uses = array('Evaluate');
	public function index(){
		// $this->redirect('problem_show');
		$this->set('test',$this->request->data);
		// $this->set('test',"test");
	}
	// ユーザが作問した問題を一覧表示
	public function evaluate_problem_show(){
		// 非公開問題
		$priv_api_pram = 'kentei_id=3&employ=0&public_flag=0&category_id=0&item=100';
		$show_obj['priv'] = $this->api_rest('GET','problems/index.json',$priv_api_pram,array());

		// 公開問題
		$publ_api_pram = 'kentei_id=3&employ=0&public_flag=1&category_id=0&item=100';
		$show_obj['publ'] = $this->api_rest('GET','problems/index.json',$publ_api_pram,array());

		$this->set('data',$show_obj);
	}
	// 選択した問題への評価とコメント
	public function evaluate_problem_check($id){ //making question ID
		// 選択した問題のID
		$check_obj['problem_id'] = $id;
		// 評価項目呼び出し
		$check_obj['evaluate_items'] = $this->api_rest('GET','evaluateItems/index.json','kentei_id=1',array());
		$this->set('data',$check_obj);
	}
	// 登録前に評価・コメントの内容を確認
	public function evaluate_pre_check(){
		// $evaluate_content = $this->request->data;
		// $arrange_evaluate_data['Problems'] = $this->Evaluate->evaluate_content_arrange($evaluate_content);
		// $arrange_evaluate_data['Problem_info']['id'] = $evaluate_content['Problem_info']['id'];
		// $this->set('arrange_evaluate_data',$arrange_evaluate_data);

		$eval_cont = $this->request->data;
		$arrange_eval_data['Problems'] = $this->Evaluate->eval_cont_arrange($eval_cont);
		$arrange_eval_data['Problem_info']['id'] = $eval_cont['Problem_info']['id'];
		$this->set('arrange_eval_data',$arrange_eval_data);

		// if($this->Evaluate->validates()){ //エラーがなければ
		// 	$eval_cont = $this->request->data;
		// 	$arrange_eval_data['Problems'] = $this->Evaluate->eval_cont_arrange($eval_cont);
		// 	$arrange_eval_data['Problem_info']['id'] = $eval_cont['Problem_info']['id'];
		// 	$this->set('arrange_eval_data',$arrange_eval_data);
		// }else{
		// 		$this->render('evaluate_problem_check');
		// }

	}
	// 評価登録機能
	public function evaluate_add_check(){
		// ログイン機能とは未連結、ユーザIDはダミー
		$eval_data = $this->request->data;
		foreach ($eval_data['Problems'] as $eval_id => $eval_value) {
			// user_idは、後でログイン機能から受け取る
			$add_api_pram[$eval_id]['evaluate_item_id'] = $eval_id;
			$add_api_pram[$eval_id]['problem_id'] = $eval_data['Problem_info']['id'];
			$add_api_pram[$eval_id]['user_id'] = 7;
			$add_api_pram[$eval_id]['evaluate_comment'] = $eval_value['comment'];

			$result[$eval_id] = $this->api_rest('POST','evaluateComments/add.json',null,$add_api_pram[$eval_id]);
		}
		// $this->set('data',$add_api_pram);
		$this->set('data',$result);
		$this->redirect('evaluate_problem_show');
	}
	// 評価履歴表示
	public function evaluate_history(){
		$eval_record = $this->api_rest('GET','evaluateComments/index.json','user_id=7',array());
		$arrange_eval_data = $this->Evaluate->eval_record_arrange($eval_record);
		// $this->set('arrange_eval_data',$arrange_eval_data);
		$this->set('arrange_eval_data',$arrange_eval_data);
	}


	public function evaluate_notice(){

	}
	public function evaluate_confirm(){

	}




}
?>
