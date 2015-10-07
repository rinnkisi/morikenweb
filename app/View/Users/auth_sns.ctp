<?php
if(!empty($twitter_id))
{
    echo "twitter接続中";
    echo $this->Html->link("twitter接続を解除",array('controller'=>'users','action'=>'sns_auth_delete',$twitter_id));
}
else
{
    echo $this->Html->link("twitter接続",array('controller'=>'auth','action'=>'twitter'));

}
echo $this->Html->tag('br');
if(!empty($facebook_id))
{
    echo "facebook接続中";
    echo $this->Html->link("facebook接続を解除",array('controller'=>'users','action'=>'sns_auth_delete',$facebook_id));
}
else
{
    echo $this->Html->link("facebook接続",array('action'=>'facebook'));
}
