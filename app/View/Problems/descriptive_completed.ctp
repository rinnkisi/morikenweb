<?php
	echo "以下の内容で登録してもよろしいですか？"."<br />";
	echo "[問題文]：".$data['response']['Problem']['sentence']."<br />";

	echo "答え：".$data['response']['Problem']['right_answer']."<br />";

	echo "タグ：".$data['response']['Problem']['tag']."<br />";

	echo $this->Html->link('登録する',
	array('controller' => 'Problems', 'action' => 'descriptive_completed', 'full_base' => true)
	);
	echo "<br />";
	echo $this->Html->link('編集ページに戻る',
	array('controller' => 'Problems', 'action' => 'problem_descriptive', 'full_base' => true)
	);