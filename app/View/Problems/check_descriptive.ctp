<!-- 記述式問題作成の投稿完了をするページ -->
<?php
	echo "以下の内容で登録してよろしいですか？"."<br />";
	echo "[カテゴリ]：".$category."<br />";
	echo "[サブカテゴリ]：".$subcategory."<br />";
	echo "[問題文]：".$check_data['sentence']."<br />";
	echo "[解答]-".$check_data['right_answer']."<br />";
	echo "[その他の解答]-".$check_data['another_answer']."<br />";
	echo "[タグ]-".$check_data['tag']."<br />";
	echo "[解説]-".$check_data['description']."<br />";
	echo $this->Html->link("編集する", "javascript:history.back();");
	echo "<br /><br />";
	echo $this->Html->link('登録する',
	array('controller'=>'Problems','action'=>'record_problem','full_base'=>true,"2")
	);
?>