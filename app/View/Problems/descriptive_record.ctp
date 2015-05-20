<!-- 四択式問題作成の投稿完了をするページ -->
<?php
	echo "以下の内容で登録しました"."<br />";
	echo "[問題文]：".$descriptive_record_data['sentence']."<br />";
	echo "答え[解答*]-".$descriptive_record_data['right_answer']."<br />";
	echo "[その他の解答]-".$descriptive_record_data['another_answer']."<br />";
	echo "[タグ]：".$descriptive_record_data['tag']."<br />";
	echo "[解説]：".$descriptive_record_data['description']."<br /><br />";
	echo $this->Html->link('選択式問題作成ページに戻る',
	array('controller'=>'Problems','action'=>'problem_descriptive','full_base'=>true));
	echo "<br /><br />";
	echo $this->Html->link('トップページに戻る',
	array('controller'=>'Problems','action'=>'top','full_base'=>true)
	);
?>