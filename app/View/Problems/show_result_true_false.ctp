<?php
	echo $score.'/10'.$this->Html->tag('br');

	echo '----あなたが間違えた問題----'.$this->Html->tag('br');
	for($i = 1; $i <= 10; $i++){
		if($problem[$i]['answer_flag'] == 0){
			echo '['.$i.']';
			echo '問題文：'.$problem[$i]['sentence'].$this->Html->tag('br');
			echo '提示された回答：'.$problem[$i]['showed_answer'].$this->Html->tag('br');
			echo '正解：'.$problem[$i]['right_answer'].$this->Html->tag('br');
			echo 'あなたの回答：'.$problem[$i]['user_answer'];
			echo $this->Html->tag('br');
			echo $this->Html->tag('br');
		}
	}