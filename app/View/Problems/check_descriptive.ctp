<!-- 記述式問題作成の投稿完了をするページ -->
<?php
	echo "以下の内容で登録してよろしいですか？".$this->Html->tag('br');
	echo "[カテゴリ]：".$category.$this->Html->tag('br');
	echo "[サブカテゴリ]：".$subcategory.$this->Html->tag('br');
	echo "[問題文]：".$default_data['sentence'].$this->Html->tag('br');
	echo "[解答]-".$default_data['right_answer'].$this->Html->tag('br');
	echo "[その他の解答]-".$default_data['another_answer'].$this->Html->tag('br');
	echo "[タグ]：".$default_data['tag'].$this->Html->tag('br');
	echo "[解説]：".$default_data['description'].$this->Html->tag('br').$this->Html->tag('br');
	echo $this->Html->link("編集する", "javascript:history.back();");
	echo $this->Html->tag('br').$this->Html->tag('br');
	echo $this->Html->link('登録する',
	array('controller'=>'Problems','action'=>'record_problem','full_base'=>true,"2")
	);
?>