<?php
	echo $score.'/10'.$this->Html->tag('br');

	echo '----あなたが間違えた問題----'.$this->Html->tag('br');
	for($i = 1; $i <= 10; $i++){
		if($wrong_problem[$i]['check'] == 'wrong'){
			echo '['.$i.']';
			echo '問題文：'.$wrong_problem[$i]['problem_sentence'].$this->Html->tag('br');
			echo '提示された回答：'.$wrong_problem[$i]['showed_answer'].$this->Html->tag('br');
			echo '正解：'.$wrong_problem[$i]['right_answer'].$this->Html->tag('br');
			echo 'あなたの回答：'.$wrong_problem[$i]['user_answer'];
			echo $this->Html->tag('br');
			echo $this->Html->tag('br');
		}
	}