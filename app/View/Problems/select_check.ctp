<!-- 四択式問題作成の確認をするページ -->
<?php
	echo "以下の内容で登録してもよろしいですか？"."<br /><br />";
	foreach($check_data as $key =>$value){
		echo $value."<br />";
	}
	echo "[カテゴリ]：".$check_data['category_id']."<br />";
	echo "[サブカテゴリ]：".$check_data['subcategory_id']."<br />";
	echo "[問題文]：".$check_data['sentence']."<br />";
	echo "答え[選択肢1]-".$check_data['right_answer']."<br />";
	echo "[選択肢２]-".$check_data['wrong_answer1']."<br />";
	echo "[選択肢３]-".$check_data['wrong_answer2']."<br />";
	echo "[選択肢４]-".$check_data['wrong_answer3']."<br />";
	echo "[タグ]：".$check_data['tag']."<br />";
	echo "[解説]：".$check_data['description']."<br /><br />";
	echo $this->Html->link('登録する',
	array('controller' => 'Problems', 'action' => 'select_completed', 'full_base' => true)
	);
	echo "<br /><br />";
	echo $this->Html->link('前のページに戻る',
	array('controller' => 'Problems', 'action' => 'problem_select', 'full_base' => true)
	);

