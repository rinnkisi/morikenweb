<?php
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	public $name = 'Users'; //クラス名
	public $components = array('Session');//
/**
 * add method
 *
 */
	function add_user() {
		$url = $this->api_rest("POST","users.json","",$this->request->data);
		debug($url);
	}
}
