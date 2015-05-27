<!-- 四択式問題作成の投稿完了をするページ -->
<?php
	echo "以下の内容で登録してよろしいですか？"."<br />";
	echo "[カテゴリ]：".$category."<br />";
	echo "[サブカテゴリ]：".$subcategory."<br />";
	echo "[問題文]：".$check_data['sentence']."<br />";
	echo "答え[選択肢1]-".$check_data['right_answer']."<br />";
	echo "[選択肢２]-".$check_data['wrong_answer1']."<br />";
	echo "[選択肢３]-".$check_data['wrong_answer2']."<br />";
	echo "[選択肢４]-".$check_data['wrong_answer3']."<br />";
	echo "";
	echo "[タグ]：".$check_data['tag']."<br />";
	echo "[解説]：".$check_data['description']."<br /><br />";
	echo $this->Html->link("編集する", "javascript:history.back();");
	echo "<br /><br />";
	echo $this->Html->link('登録する',
	array('controller'=>'Problems','action'=>'problem_record','full_base'=>true)
	);
?>