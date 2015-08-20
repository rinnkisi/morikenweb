<?php
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */

App::uses('AppController', 'Controller');
//facebook認証
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));

class UsersController extends AppController {
	public $name = 'Users'; //クラス名
	public $components = array('Session');
	/*
	*  ログイン後のトップページ
	*/
	function index(){
		if(!empty($this->Session->read('userdata'))){
			$userdata =$this->Session->read('userdata');
			//debug($userdata);
			$this->set('userdata',$userdata);
		}else{
			$this->redirect(array('action' => 'login'));
		}
		$this->Session->delete('userdata');
	}
	/*
	*  ログイン機能
	*/
	function login(){
		//debug($this->request->data);
		if(!empty($this->request->data)){//値がtrue
			$url = $this->api_rest("POST","logins.json","",$this->request->data);
			if(empty($this->User->errorcheck($url))){//エラーがないときにindexに
				$this->Session->write('userdata',$url['response']['data']);
				//ユーザの情報を持ってくる
				$this->redirect('index');
			}else{
				$this->set('message',$this->User->errorcheck($url));
			}
		}
	}
	/*
	*  ユーザ登録機能
	*/
	function add_user(){
		if(!empty($this->request->data)){
			$url = $this->api_rest("POST","users.json","",$this->request->data);
			if(empty($this->User->validation($url))){
				$this->redirect(array('action' => 'login'));
			}else{
				$this->set('message',$this->User->validation($url));
			}
			//debug($url);
		}
	}
	public function opauthComplete(){
		debug($this->data);
	}
	public function beforeFilter() {
		if($this->params['action'] == 'opauthComplete') {
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}

	public function index2(){}
	public function showdata(){//トップページ
		$facebook = $this->createFacebook(); //セッション切れ対策 (?)
		$myFbData = $this->Session->read('mydata');//facebookのデータ
		//$myFbData_kana = $this->Session->read('fbdata_kana'); //フリガナ
		//pr($myFbData_kana); //フリガナデータ表示
		pr($myFbData);//表示
	}
	public function facebook(){//facebookの認証処理部分
		$this->autoRender = false;
		$this->facebook = $this->createFacebook();
		$user = $this->facebook->getUser();//ユーザ情報取得
		if($user){//認証後
			$me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));//ユーザ情報を日本語で取得
			    $this->Session->write('mydata',$me);//fbデータをセッションに保存
			//フリガナを取得する．
			//$me_kana = $this->facebook->api('/fql?q=SELECT+first_name%2C+sort_first_name%2C+last_name%2C+sort_last_name%2Cname+FROM+user+WHERE+uid+%3D+'.$me['id'].'&locale=ja_JP');//ふりがな
			//if(!empty($me_kana)){//フリガナ設定をしているユーザのみ
			// mb_convert_variables('UTF-8', 'auto', $me_kana);
			// $this->Session->write('fbdata_kana',$me_kana);//フリガナデータをセッションに保存
			//}
		    $this->redirect('showdata');
		}else{//認証前
			$url = $this->facebook->getLoginUrl(array(
			'scope' => 'email,publish_stream,user_birthday'
			,'canvas' => 1,'fbconnect' => 0));
			$this->redirect($url);
		}
	}
	private function createFacebook() {//appID, secretを記述
		return new Facebook(array(
			'appId' => '846453832112018',
			'secret' => 'f1de4e50782bdbe1a95b0fea46158c1d'
		));
	}
	public function fbpost($postData) {//facebookのwallにpostする処理
		$facebook = $this->createFacebook();
		$attachment = array(
			'access_token' => $facebook->getAccessToken(), //access_token入手
			'message' => $postData,
			'name' => "test",
			'link' => "https://twitter.com/rinnkisi",
			'description' => "test",
		);
		$facebook->api('/me/feed', 'POST', $attachment);
	}
}
