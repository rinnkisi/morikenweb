<?php
//ログイントップページ
  if(!empty($message)){
    echo $message;
  }
  echo $this->Form->create('User', array('type'=>'text', 'enctype' => 'multipart/form-data', 'url'=>'/Users/login'));
  echo $this->Html->para('username',"ユーザ名を入力してください".$this->Form->text('username'));
  echo $this->Html->para('password',"パスワードを入力してください".$this->Form->password('password'));
  echo $this->Form->submit(('ログインする'));
  echo $this->Form->end();
  echo $this->Html->tag('br');
  echo $this->Html->link('新規登録はこちら',
	array('controller' => 'Users', 'action' => 'add_user', 'full_base' => true));
