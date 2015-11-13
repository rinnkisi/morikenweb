
<div class = "setting-margin">
<?php
    echo $this->Html->image("users/settingPartitionV.png", array('alt' => '縦線'));
?>
</div>
<div class = "setting-right">
    <p>
<?php
    echo $this->Html->image("users/plugTwitter.png", array('alt' => 'Twitterと連携'));
?>
    </p>
    <p>
<?php
    if(!empty($twitter_id))
    {
        echo $this->Html->image("users/connect.png", array('alt' => 'Twitter連携'));
        echo $this->Html->link("Twitter接続を解除", array('controller' => 'users', 'action' => 'sns_auth_delete', $twitter_id));
        echo $this->Form->create('User', array('type' => 'post', 'controller' => 'User', 'action' => 'twitter_post'));
        echo $this->Form->text('User.text');
        echo $this->Form->submit('送信');
    }
    else
    {
        echo $this->Html->image("users/disconnect.png", array('alt' => 'Twitter連携'));
        echo $this->Html->link("Twitterに接続", array('controller' => 'users', 'action' => 'twitter_auth'));
    }
?>
    </p>
    <p>
<?php
    echo $this->Html->image("users/settingPartitionH.png", array('alt' => '横線'));
    echo $this->Html->image("users/plugFacebook.png", array('alt' => 'Facebookと連携'));
?>
    </p>
    <p>
<?php
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
    echo $this->Html->tag('br').$this->Html->tag('br');
?>
    </p>
</div>
