<?php
class EvaluatesController extends AppController{
	public $name = "Evaluates";
	public $uses = array('Hoge','ApiMakingQuestion');
	public function index(){
		$this->redirect('show');
	}
	// ユーザが作問した問題を一覧表示
	public function show(){
		// 後でログインユーザ以外が作問した問題のみ収集するように編集
		$user_id = 7; //テストデータ
		$url = "http://sakumon.jp/app/LK_API/evaluateComments/index.json?user_id=".$user_id;
		$json = file_get_contents($url);
		$obj = json_decode($json);
		$this->set('data',$obj);
		// $test_data = $this->ApiMakingQuestion->find('all');
		// $this->set('test_data',$test_data);
	}

	// showで選択した問題をチェック
	public function problemCheck(){ //making question ID
//	public function problemCheck($id){ //making question ID
		// $this->set('data',$this->ApiMakingQuestion->findById($id));

		//評価項目呼び出し
		$item_url = "http://sakumon.jp/app/LK_API/evaluateItems/index.json?kentei_id=1";
		$item_json = file_get_contents($item_url);
		$obj = json_decode($item_json);
		$this->set('data',$obj);

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