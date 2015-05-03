<?php
class ProblemsController extends AppController{
	public $name = "Problems";
	public $uses = array('Evaluate');
	public function index(){
		$this->redirect('problem_show');
	}
	// ユーザが作問した問題を一覧表示
	public function problem_show(){
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
		$eval_cont = $this->request->data;
		$arrange_eval_data = $this->Evaluate->eval_cont_arrange($eval_cont);
		$this->set('arrange_eval_data',$arrange_eval_data);
	}
	// 評価登録
	public function evaluate_add_check(){
		// ログイン機能とは未連結、ユーザIDはダミー
		// $problem_id = $this->request->data['problem']['id'];
		// foreach ($this->request->data['Evaluate'] as $key => $value) {
		// 	$result = $this->api_rest('POST','evaluateComments/add.json',
		// 	'evaluate_item_id='.$key.'&problem_id='.$problem_id.'&user_id=1'.'&evaluate_comment='.$value['comment'],
		// 	array('http://sakumon.jp/app/LK_API/evaluateComments/add.json&evaluate_item_id='.$key.
		// 	'&problem_id='.$problem_id.
		// 	'&user_id=1'.
		// 	'&evaluate_comment='.$value['comment'])
		// 	);
		// }
		// $this->set('data',$result);
		$this->set('data',$this->request->data);
	}

	public function evaluate(){
		$data['judge_flg'] = $this->ApiMakingQuestion->evaluate_judge($this->request->data);
		$data['question_id'] = $this->request->data['question']['id'];
		$data['question'] = $this->ApiMakingQuestion->findById($data['question_id']);
		$this->set('data',$data);
		// question.id
		// $this->set('data',$this->request->data);
	}
	// // ログインユーザーによる作問
	// public function create(){ 

	// }
	// public function show(){
	// 	$test_data = $this->Hoge->test_data();
	// 	$this->set('test_data',$test_data);
	// }
}
?>

<!--
[1] ログインユーザーが作問した問題を取得
[2] ログインユーザーが作問した位置情報を含む問題を取得
[3] 問題の投稿機能
[4] 問題の編集機能
[5] 問題の評価情報更新機能(良評価/悪評価) 
-->