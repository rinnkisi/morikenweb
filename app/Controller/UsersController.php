<?php
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */

App::uses('AppController', 'Controller');
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
}
