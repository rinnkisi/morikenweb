<!-- 四択式問題作成の投稿完了をするページ -->
<?php
	echo "以下の内容で更新してよろしいですか？".$this->Html->tag('br');
	echo "[カテゴリ]：".$category.$this->Html->tag('br');
	echo "[サブカテゴリ]：".$subcategory.$this->Html->tag('br');
	echo "[問題文]：".$check_data['sentence'].$this->Html->tag('br');
	echo "答え[選択肢1]-".$check_data['right_answer'].$this->Html->tag('br');
	echo "[選択肢２]-".$check_data['wrong_answer1'].$this->Html->tag('br');
	echo "[選択肢３]-".$check_data['wrong_answer2'].$this->Html->tag('br');
	echo "[選択肢４]-".$check_data['wrong_answer3'].$this->Html->tag('br');
	echo "[解説]：".$check_data['description'].$this->Html->tag('br').$this->Html->tag('br');
	echo $this->Html->link("編集する", "javascript:history.back();");
	echo $this->Html->tag('br');
	echo $this->Html->link('更新する',
	array('controller'=>'Problems','action'=>'update','full_base'=>true)
	);
?>