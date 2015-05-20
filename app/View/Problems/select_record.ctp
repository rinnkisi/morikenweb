<!-- 四択式問題作成の投稿完了をするページ -->
<?php
	echo "以下の内容で登録しました"."<br />";
	echo "[問題文]：".$select_record_data['sentence']."<br />";
	echo "答え[選択肢1]-".$select_record_data['right_answer']."<br />";
	echo "[選択肢２]-".$select_record_data['wrong_answer1']."<br />";
	echo "[選択肢３]-".$select_record_data['wrong_answer2']."<br />";
	echo "[選択肢４]-".$select_record_data['wrong_answer3']."<br />";
	echo "[タグ]：".$select_record_data['tag']."<br />";
	echo "[解説]：".$select_record_data['description']."<br /><br />";
	echo $this->Html->link('選択式問題作成ページに戻る',
	array('controller'=>'Problems','action'=>'problem_select','full_base'=>true));
	echo "<br /><br />";
	echo $this->Html->link('トップページに戻る',
	array('controller'=>'Problems','action'=>'top','full_base'=>true)
	);
?>