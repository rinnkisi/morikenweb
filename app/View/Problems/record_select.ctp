<!-- 四択式問題作成の投稿完了をするページ -->
<?php
	if(!empty($record_data)){
		echo "以下の内容で登録しました<br />";
		echo "[カテゴリ]：".$category."<br />";
		echo "[サブカテゴリ]：".$subcategory."<br />";
		echo "[問題文]：".$record_data['sentence']."<br />";
		echo "答え[選択肢1]-".$record_data['right_answer']."<br />";
		echo "[選択肢２]-".$record_data['wrong_answer1']."<br />";
		echo "[選択肢３]-".$record_data['wrong_answer2']."<br />";
		echo "[選択肢４]-".$record_data['wrong_answer3']."<br />";
		echo "[タグ]：".$record_data['tag']."<br />";
		echo "[解説]：".$record_data['description']."<br /><br />";
		echo $this->Html->link('選択式問題作成ページに戻る',
			array('controller'=>'Problems','action'=>'problem_select','full_base'=>true,"1"));
		echo "<br /><br />";
	}else{
		echo "登録できませんでした<br />";
		echo "編集ページに戻って入力を確認してください<br />";
		echo $this->Html->link('編集ページに戻る',"javascript:history.go(-2);");
		echo "<br /><br />";
	}
	echo $this->Html->link('トップページに戻る',
	array('controller'=>'Problems','action'=>'top','full_base'=>true)
	);
?>