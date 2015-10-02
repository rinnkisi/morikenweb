<h3>◯×問題</h3>
<?php

echo "[".$show_count."] ";
echo '問題文：'.$problem[$show_count]['sentence'].$this->Html->tag('br');
echo '乱数：'.$random.$this->Html->tag('br');
echo 'この問題の答えは['.$problem[$show_count]['showed_answer'].']である。'.$this->Html->tag('br');

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

	//debug($data);
?>