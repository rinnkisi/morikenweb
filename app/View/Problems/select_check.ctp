<!-- 四択式問題作成の確認をするページ -->
<?php
	echo $this->Html->script('ConnectedSelect.js');
	echo "以下の内容で登録してもよろしいですか？"."<br /><br />";
	//本文
	echo $this->Form->create('problem_selectdata', array('type'=>'text', 'enctype' => 'multipart/form-data', 'url'=>'/Problems/select_record'));
	echo "[選択式問題作成] *は必須項目です";
	echo "<br /><br />カテゴリ*";
	echo $this->Form->select('category_id',$category_options,
		array('id'=>'category_id','empty'=>'選んでください','selected' => $check_data['category_id']));
	echo "[この投稿で◯ポイント獲得] / サブカテゴリ";
	//連動プルダウン用
	echo $this->Form->select('subcategory_id',$subcategory_options,
		array('id'=>'subcategory_id','empty'=>'選んでください','selected' => $check_data['subcategory_id']));
	echo "<br />(カテゴリがわからないときは「その他」を選択してください)<br />";
	echo "問題文* [ 最大200 文字 ]<br />";
	//paraは<p>タグである
	echo $this->Html->para(null,'',array('id' => 'num'));
	echo $this->Form->textarea('sentence');
	echo "<br />選択肢の設定*<br />";
	echo $this->Html->para(null, "正解選択肢".$this->Form->textarea('right_answer'));
	echo $this->Html->para(null, "誤答選択肢１".$this->Form->textarea('wrong_answer1'));
	echo $this->Html->para(null, "誤答選択肢２".$this->Form->textarea('wrong_answer2'));
	echo $this->Html->para(null, "誤答選択肢３".$this->Form->textarea('wrong_answer3'));
    echo "写真を載せる場合は以下から登録 (200kb以下、JPEG および PNG画像)";
    echo $this->Form->input('',array(
    'type' => 'file',
    'name' => 'image'
	));
    echo "タグ(複数タグは半角「/」で区切り 例:盛岡/岩手/川)";
	echo $this->Form->text('tag');
	echo $this->Html->para(null, "<br />解説* (メモ、参考URL、文献等)".
		$this->Form->textarea('description'));

	echo $this->Html->link('登録する',
	array('controller' => 'Problems','action' => 'select_record', 'full_base' => true));
	echo "<br /><br />";
	echo $this->Html->link('前のページに戻る',
	array('controller' => 'Problems','action' => 'problem_select', 'full_base' => true)
	);
?>
<script>//文字数のjavascript
$(function(){
	$("#problem_selectdataSentence").bind("change keyup",function(){
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
