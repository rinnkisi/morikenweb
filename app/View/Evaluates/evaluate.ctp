<?php echo "[作成者※ID表示] ".$data['question']['ApiMakingQuestion']['id'] ?><br />
<?php echo "[作成日時] xxxxx"?><br />
<?php echo "[更新者] xxxxx" ?><br />
<?php echo "[最終更新] xxxxx" ?><br />
<?php echo "[カテゴリ※ID表示] ".$data['question']['ApiMakingQuestion']['category_id']; ?><br />
<?php echo "[サブカテゴリ※ID表示] ".$data['question']['ApiMakingQuestion']['subcategory_id']; ?><br />
<?php echo "[画像] xxxxx" ?><br />
<?php echo "[有効期限] xxxxx" ?><br />
<?php echo "[設問] ".$data['question']['ApiMakingQuestion']['sentence']; ?><br />
<?php echo "[正答] ".$data['question']['ApiMakingQuestion']['right_answer']; ?><br />
<?php echo "[誤答１] ".$data['question']['ApiMakingQuestion']['wrong_answer1']; ?><br />
<?php echo "[誤答２] ".$data['question']['ApiMakingQuestion']['wrong_answer2']; ?><br />
<?php echo "[誤答３] ".$data['question']['ApiMakingQuestion']['wrong_answer3']; ?><br />
<?php echo "[解説] ".$data['question']['ApiMakingQuestion']['description']; ?><br />
<hr />
<?php 
	if($data['judge_flg'] = 1){ //良評価
		echo $this->Html->link("【良評価として投稿する】",array('action' => 'contribute','value' => $data['judge_flg']));
		echo $this->Html->link("【編集も可】",array('action' => 'contribute','value' => $data['judge_flg']));
	}else{ //悪評価
		echo $this->Html->link("【悪評価として投稿する】",array('action' => 'contribute','value' => $data['judge_flg']));
	}
?>

<?php pr($data) ?>




