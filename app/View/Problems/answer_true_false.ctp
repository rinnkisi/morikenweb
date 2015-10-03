<!-- ◯×問題の問題回答ページ -->
<h3>◯×問題</h3>

<?php
echo "[".$show_count."] ";
echo '問題文：'.$problem[$show_count]['sentence'].$this->Html->tag('br');
echo '乱数：'.$random.$this->Html->tag('br'); //提示している選択肢の確認のために表示
echo 'この問題の答えは['.$problem[$show_count]['showed_answer'].']である。'.$this->Html->tag('br'); //選択肢を提示

//提示された選択肢が正しい場合は◯を、間違っている場合は×を選択
//◯ボタン
echo $this->Form->create('answer', array('url' => 'check_answer_true_false'));
echo $this->Form->hidden('random', array('value' => $random));
echo $this->Form->hidden('user_answer', array('value' => '◯'));
echo $this->Form->end('◯');

//×ボタン
echo $this->Form->create('answer', array('url' => 'check_answer_true_false'));
echo $this->Form->hidden('random', array('value' => $random));
echo $this->Form->hidden('user_answer', array('value' => '×'));
echo $this->Form->end('×').$this->Html->tag('br').$this->Html->tag('br');
?>