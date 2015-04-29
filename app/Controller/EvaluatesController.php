<?php
class EvaluatesController extends AppController{
	public $name = "Evaluates";
	public $uses = array('Hoge','ApiMakingQuestion');
	public function index(){
		$this->redirect('show');
	}
	// ユーザが作問した問題を一覧表示
	public function show(){
		// kentei_id は 1のはずでは…？
		// 非公開問題
		$show_obj['public'] = $this->api_rest('GET','problems/index.json',
			'kentei_id=3&employ=0&public_flag=0&category_id=0&item=100',
			array()
			);
		// 公開問題
		$show_obj['private'] = $this->api_rest('GET','problems/index.json',
			'kentei_id=3&employ=0&public_flag=1&category_id=0&item=100',
			array()
			);
		$this->set('data',$show_obj);
	}
	// showで選択した問題に対して評価とコメント
	public function problemCheck($id){ //making question ID
		// showで押下した問題のID
		$check_obj['problem_id'] = $id;
		//評価項目呼び出し
		$check_obj['evaluate_items'] = $this->api_rest('GET','evaluateItems/index.json','kentei_id=1',array());
		$this->set('data',$check_obj);
	}
	// 登録前に評価・コメントの内容を確認
	public function preCheck(){
		$test = $this->request->data;
		$this->set('data',$test);
	}
	// 評価登録
	public function addCheck(){
		// ユーザIDはダミー
		$problem_id = $this->request->data['problem']['id'];
		foreach ($this->request->data['Evaluate'] as $key => $value) {
			$result = $this->api_rest('POST','evaluateComments/add.json',
			'evaluate_item_id='.$key.'&problem_id='.$problem_id.'&user_id=1'.'&evaluate_comment='.$value['comment'],
			array('http://sakumon.jp/app/LK_API/evaluateComments/add.json&evaluate_item_id='.$key.
			'&problem_id='.$problem_id.
			'&user_id=1'.
			'&evaluate_comment='.$value['comment'])
			);
		}
		$this->set('data',$result);
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