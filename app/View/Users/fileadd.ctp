<?php
echo $form->create('Users', array('type' => 'file'));
echo $form->file('User.item');
echo $form->end('アップロード');
?>