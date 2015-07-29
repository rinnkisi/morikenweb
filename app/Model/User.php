<?php
App::uses('AppModel', 'Model');
class User extends AppModel{
  public $useTable = false;
  public $validate = array(
    'username' => array(
      array(
        'rule' => 'isUnique', //重複禁止
        'message' => '既に使用されている名前です。'
      ),
      array(
        'rule' => 'alphaNumeric', //半角英数字のみ
        'message' => '名前は半角英数字にしてください。'
      ),
      array(
        'rule' => array('between', 2, 32), //2～32文字
        'message' => '名前は2文字以上32文字以内にしてください。'
      )
    ),
    'email' => array(
      array(
        'rule' =>'alphaNumeric',
        'message' => 'Eメールアドレスは半角英数字にしてください。'
      )
    ),
    'password' => array(
      array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードは半角英数字にしてください。'
      ),
      array(
        'rule' => array('between', 2, 32),
        'message' => 'パスワードは2文字以上32文字以内にしてください。'
      )
    ),
  );
  public function validation($url){
    //debug($url);
    if(!empty($url['error'])){
      if($url['error']['validation']['User']['email']=='email')
        $message = "メールアドレスを正しく入力してください。";
        return $message;
    }
    return NULL;//エラーがないならnullを返す
  }
  public function errorcheck($url){
    if(!empty($url['error'])){
      return $url['error']['message'];
    }
    return NULL;//エラーがないならnullを返す
  }
  public function update($twitter_data){
      //twitterと上手く連携して、ユーザ登録、更新ができる関数
     $user_data = $this->find('first', array('conditions' => array('twitter_id' => $twitter_data['twitter_id'])));
     if ($user_data) {//twitterアカウントが登録してある場合
         $twitter_data['id'] = $user_data['User']['id'];
         $twitter_data['username'] = $user_data['User']['username'];//既に利用しているユーザー名で登録 twitterのスクリーンネーム上書き阻止
     }
     $this->save(Array("User" => $twitter_data));
 }
}
