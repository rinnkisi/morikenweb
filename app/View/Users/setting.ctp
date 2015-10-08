<?php

echo $this->Html->image("users/plugTwitter.png", array('alt' => 'Twitter連携')). $this->Html->tag('br');
if(!empty($twitter_id))
{
    echo $this->Html->image("users/connect.png", array('alt' => 'twitter連携'));
    echo $this->Html->link("twitter接続を解除",array('controller'=>'users','action'=>'sns_auth_delete',$twitter_id));
}
else
{
    echo $this->Html->image("users/disconnect.png", array('alt' => 'twitter連携'));
    echo $this->Html->link("twitter接続",array('controller'=>'auth','action'=>'twitter'));

}
echo $this->Html->tag('br'). $this->Html->image("users/plugFacebook.png", array('alt' => 'Facebook連携'));
echo $this->Html->tag('br');
if(!empty($facebook_id))
{
    echo $this->Html->image("users/connect.png", array('alt' => 'facebook連携'));
    echo $this->Html->link("facebook接続を解除",array('controller'=>'users','action'=>'sns_auth_delete',$facebook_id));
}
else
{
    echo $this->Html->image("users/disconnect.png", array('alt' => 'facebook連携'));
    echo $this->Html->link("facebook接続",array('action'=>'facebook'));
}
