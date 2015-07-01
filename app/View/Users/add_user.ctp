<?php
//ユーザー登録画面

	echo $this->Form->create('User', array('type'=>'text', 'enctype' => 'multipart/form-data', 'url'=>'/Users/add_user'));
	echo $this->Html->para(null,"ユーザ名".$this->Form->text('username'));
	if(!empty($message))
	echo $message;
	echo $this->Html->para(null,"メールアドレス".$this->Form->text('email'));
	echo $this->Html->para(null,"パスワード".$this->Form->password('password'));
	echo $this->Form->submit(('この内容で送信する'));
  echo $this->Form->end();
  echo $this->Html->tag('br');
	echo $this->Html->link('戻る',
	array('controller' => 'users', 'action' => 'login', 'full_base' => true));

?>
