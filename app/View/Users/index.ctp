<?php
    //ログインが成功したらここにくる
    echo $userdata['username']."さん、いらっしゃい";
    echo $this->Html->tag('br');
    echo "IDは".$userdata['id']."です。";
