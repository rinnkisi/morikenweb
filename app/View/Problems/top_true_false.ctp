<!-- ◯×問題のトップページ -->
<?php
//◯×問題の回答スタートボタン
//過去問取得ページへのリダイレクト
echo $this->Form->create('answer', array('url' => 'get_problems_true_false'));
echo $this->Form->end('start');