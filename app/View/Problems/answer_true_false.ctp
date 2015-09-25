	<h3>◯×問題</h3>
	<?php
	
	$read_count = $this->Session->read('read_count');
	$read_count++;
	$random = mt_rand(1, 4);

	foreach ($data['response']['Problems'] as $key => $data):
		echo "[".$read_count."] ";
	echo '問題文：'.$data['Problem']['sentence'].$this->Html->tag('br');

	if($random == 1){
		echo 'この問題の答えは['.$data['Problem']['right_answer'].']である。'.$this->Html->tag('br');
		$user_answer = $data['Problem']['right_answer'];
	}

	if($random == 2){
		echo 'この問題の答えは['.$data['Problem']['wrong_answer1'].']である。'.$this->Html->tag('br');
		$user_answer = $data['Problem']['wrong_answer1'];
	}

	if($random == 3){
		echo 'この問題の答えは['.$data['Problem']['wrong_answer2'].']である。'.$this->Html->tag('br');
		$user_answer = $data['Problem']['wrong_answer2'];
	}

	if($random == 4){
		echo 'この問題の答えは['.$data['Problem']['wrong_answer3'].']である。'.$this->Html->tag('br');
		$user_answer = $data['Problem']['wrong_answer4'];
	}

	echo $this->Form->create('answer', array('url' => 'check_answer_true_false'));
	echo $this->Form->hidden('random_number', array('value' => $read_count));
	echo $this->Form->hidden('right_answer', array('value' => $data['Problem']['right_answer']));
	echo $this->Form->hidden('user_answer', array('value' => 'true'));
	echo $this->Form->end('◯');

	echo $this->Form->create('answer', array('url' => 'check_answer_true_false'));
	echo $this->Form->hidden('random_number', array('value' => $read_count));
	echo $this->Form->hidden('right_answer', array('value' => $data['Problem']['right_answer']));
	echo $this->Form->hidden('user_answer', array('value' => 'false'));
	echo $this->Form->end('×').$this->Html->tag('br').$this->Html->tag('br');

	endforeach;

		//debug($data);
	?>