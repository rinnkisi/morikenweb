<div style = "float:left;">
<?php
    echo $this->Html->image("users/settingPartitionV.png", array('alt' => '縦線'));
?>
</div>
<div class = "setting-right" style = "background:black; margin-top:100px">
<?php
    echo $this->Html->image("users/plugTwitter.png", array('alt' => 'Twitter連携')). $this->Html->tag('br');
    if(!empty($twitter_id))
    {
        echo $this->Html->image("users/connect.png", array('alt' => 'Twitter連携'));
        echo $this->Html->link("Twitter接続を解除", array('controller' => 'users', 'action' => 'sns_auth_delete', $twitter_id));
    }
    else
    {
        echo $this->Html->image("users/disconnect.png", array('alt' => 'Twitter連携'));
        echo $this->Html->link("Twitterに接続", array('controller' => 'auth', 'action' => 'twitter'));
    }
    echo $this->Html->tag('br'). $this->Html->image("users/settingPartitionH.png", array('alt' => '横線'));
    echo $this->Html->tag('br'). $this->Html->image("users/plugFacebook.png", array('alt' => 'Facebook連携'));
    echo $this->Html->tag('br');
    if(!empty($facebook_id))
    {
        echo $this->Html->image("users/connect.png", array('alt' => 'Facebook連携'));
        echo $this->Html->link("Facebook接続を解除", array('controller' => 'users', 'action' => 'sns_auth_delete', $facebook_id));
    }
    else
    {
        echo $this->Html->image("users/disconnect.png", array('alt' => 'Facebook連携'));
        echo $this->Html->link("Facebookに接続", array('action' => 'facebook'));
    }
?>
</div>
