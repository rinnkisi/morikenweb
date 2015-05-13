<!-- 四択式問題作成のチェックをするページ -->
<?php
	echo "以下の内容で登録してもよろしいですか？"."<br />";
	echo "[問題文]：".$data['response']['Problem']['sentence']."<br />";

	echo "答え[選択肢１]-".$data['response']['Problem']['right_answer']."<br />";

	echo "[選択肢２]-".$data['response']['Problem']['wrong_answer1']."<br />";
	echo "[選択肢３]-".$data['response']['Problem']['wrong_answer2']."<br />";
	echo "[選択肢４]-".$data['response']['Problem']['wrong_answer3']."<br />";
	echo "タグ：".$data['response']['Problem']['tag']."<br />";

	echo $this->Html->link('登録する',
	array('controller' => 'Problems', 'action' => 'selsect_completed', 'full_base' => true)
	);
	echo "<br />";
	echo $this->Html->link('編集ページに戻る',
	array('controller' => 'Problems', 'action' => 'problem_select', 'full_base' => true)
	);

