<?php

	echo $this->Form->create('User', array('type'=>'text', 'enctype' => 'multipart/form-data', 'url'=>'/Users/add_user'));
	echo $this->Html->para(null,"名前".$this->Form->text('username'));
	echo $this->Html->para(null,"メールアドレス".$this->Form->text('email'));
	echo $this->Html->para(null,"パスワード".$this->Form->password('password'));

	echo $this->Form->hidden('id',array('value'=>'1183'));//初期値は1
	echo $this->Form->submit(('この内容で送信する'));
    echo $this->Form->end();
    echo $this->Html->tag('br');
	echo $this->Html->link('戻る',
	array('controller' => 'users', 'action' => 'top', 'full_base' => true));