<!-- 記述式問題作成の投稿完了をするページ -->
<?php
	if(!empty($record_data) && $error == 1){
		echo "以下の内容で登録しました<br />";
		echo "[カテゴリ]：".$category.$this->Html->tag('br');
		echo "[サブカテゴリ]：".$subcategory.$this->Html->tag('br');
		echo "[問題文]：".$record_data['sentence'].$this->Html->tag('br');
		echo "[解答]-".$record_data['right_answer'].$this->Html->tag('br');
		echo "[その他の解答]-".$record_data['another_answer'].$this->Html->tag('br');
		echo "[タグ]-".$record_data['tag'].$this->Html->tag('br');
		echo "[解説]：".$record_data['description'].$this->Html->tag('br').$this->Html->tag('br');
		echo $this->Html->link('記述式問題作成ページに戻る',
			array('controller'=>'Problems','action'=>'problem_makes','full_base'=>true,"2"));
		echo $this->Html->tag('br').$this->Html->tag('br');
	}else{
				foreach($error as $value){
			echo $value.$this->Html->tag('br');
		}
		echo "登録できませんでした".$this->Html->tag('br');
		echo "編集ページに戻って入力を確認してください".$this->Html->tag('br');
		echo $this->Html->link('編集ページに戻る',"javascript:history.go(-2);");
		echo $this->Html->tag('br').$this->Html->tag('br');
	}
	echo $this->Html->link('トップページに戻る',
	array('controller'=>'Problems','action'=>'top','full_base'=>true)
	);
?>