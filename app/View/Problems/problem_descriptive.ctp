<?php
		//jsのライブラリを使用
	echo $this->Html->script('ConnectedSelect.js');
	//formをcreate
	echo $this->Form->create('problem_descriptivedata', array('type'=>'text', 'enctype' => 'multipart/form-data', 'url'=>'/Problems/descriptive_check'));
	echo $this->Form->hidden('type', array('value'=>"$type"));
	//type送信
	echo $this->Form->hidden('kentei_id', array('value'=>"$kentei_id"));
	//kentei_idにはWebなので１を代入
	echo $this->Form->hidden('user_id', array('value'=>'12'));
	//特にuser_idはその人によって変更しなければいけない。
	echo $this->Form->hidden('grade', array('value'=>'0'));
	//変更余地あり。
	echo $this->Form->hidden('number', array('value'=>'0'));
	echo $this->Form->hidden('public_flag', array('value'=>'0'));
	//オリジナル問題の為初期値を０に設定
	echo $this->Form->hidden('item', array('value'=>"1"));
	//item送信
	//本文
	echo "[記述式問題作成] *は必須項目です";
	echo $this->Html->link('選択式問題作成に切り替え',
		array('controller'=>'Problems','action'=>'problem_select','full_base'=>true)
	);
	echo "<br /><br />カテゴリ*";
	echo $this->Form->select('category_id',$category_options,
		array('id'=>'category_id','empty'=>'選んでください'));
	echo "[この投稿で◯ポイント獲得] / サブカテゴリ";
	//連動プルダウン用
	echo $this->Form->select('subcategory_id',$subcategory_options,
		array('id'=>'subcategory_id','empty'=>'選んでください'));
	echo "<br />(カテゴリがわからないときは「その他」を選択してください)<br />";
	echo "問題文* [ 最大200 文字 ]<br />";
	//paraは<p>タグである
	echo $this->Html->para(null,'200',array('id' => 'num'));
	echo $this->Form->textarea('sentence');
	echo $this->Html->para(null, "解答*".$this->Form->textarea('right_answer'));
	echo $this->Html->para(null, "その他の解答".$this->Form->textarea('another_answer'));
    echo "写真を載せる場合は以下から登録 (200kb以下、JPEG および PNG画像)";
    echo $this->Form->input('',array(
    'type' => 'file',
    'name' => 'image'
	));
    echo "タグ(複数タグは半角「/」で区切り 例:盛岡/岩手/川)";
	echo $this->Form->text('tag');
	echo $this->Html->para(null, "<br />解説* (メモ、参考URL、文献等)".
		$this->Form->textarea('description'));
    echo $this->Form->submit(('この内容で送信する'));
    echo $this->Form->end();
    echo "<br />";
	echo $this->Html->link('戻る',
	array('controller' => 'Problems', 'action' => 'top', 'full_base' => true)
	);
?>
<script>//文字数のjavascript
$(function(){
	$("#problem_descriptivedataSentence").bind("change keyup",function(){
	var count = $(this).val().length;
	var max = 200;//maxの文字数
		$("#num").text(max-count);
	});
});
</script>
<script type="text/javascript">
//条件付きプルダウン用のライブラリ
ConnectedSelect(['category_id','subcategory_id']);
</script>
