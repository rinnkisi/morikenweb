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
		debug($this->request->data);
		$url = $this->api_rest("POST","logins.json","",$this->request->data);
		debug($url);
	}

	/*
	*  ログイン機能
	*/

	function login(){
		debug($this->request->data);
		if(!empty($this->request->data)){
			$url = $this->api_rest("POST","users.json","",$this->request->data);
			debug($url);
		}
	}
	/*
	*  ユーザ登録機能
	*/
	function add_user(){
		debug($this->request->data);
		$this->set('default',$this->request->data);
		if(!empty($this->request->data)){
			$url = $this->api_rest("POST","users.json","",$this->request->data);
			debug($url);
		}else{
			$this->set('default',array());
		}
	}
}
