<nav id="breadcrumbs">
  <ol>
    <li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_top">
      <a itemprop="url" href="http://localhost/morikenweb/Problems/make_top"><span itemprop="title">top</span></a>
    </li>
    <li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_top">
			<a itemprop="url" href="http://localhost/morikenweb/Problems/make_top"><span itemprop="title">問題を作成</span></a>
    </li>
		<li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_problem/2">
			<span itemprop="title">一問一答式問題</span>
		</li>
  </ol>
</nav>
<div id="sidebar">
  <ul>
    <li><a href="http://localhost/morikenweb/Problems/make_top">問題を作成する</a></li>
    <li> <?php echo $this->Html->link('選択式問題',
    array('controller' => 'Problems', 'action' => 'make_problem', 'full_base' => true,"1"));?></li>
    <li><?php echo $this->Html->link('一問一答式問題',
    array('controller' => 'Problems', 'action' => 'make_problem', 'full_base' => true,"2"));?></li>
  </ul>
</div>
<div id="make-content">
	<h2>
		<ul>
			<li>
				一問一答式問題
			</li>
		</ul>
	</h2>
	<hr size="5" color="#B45F04">
<?php
	//formをcreate
	echo $this->Form->create('problem_data', array('type'=>'text', 'enctype' => 'multipart/form-data', 'url'=>'/Problems/check_problem'));
	echo $this->Form->hidden('type', array('value'=>"$type"));
	echo $this->Form->hidden('kentei_id', array('value'=>"$kentei_id"));//初期値は1
	echo $this->Form->hidden('user_id', array('value'=>'12'));//ユーザーによって変更
	echo $this->Form->hidden('grade', array('value'=>'0'));
	echo $this->Form->hidden('number', array('value'=>'0'));
	echo $this->Form->hidden('public_flag', array('value'=>'0'));
	echo $this->Form->hidden('item', array('value'=>"1"));//itmeの数を送信ここでは1
	//本文
	echo "[一問一答式問題作成] *は必須項目です";
	echo $this->Html->tag('br').$this->Html->tag('br');
	if(!empty($error_log)){
		foreach ($error_log as $key => $value) {
			echo $value.$this->Html->tag('br');
		}
	}
	echo $this->Html->tag('br').$this->Html->tag('br')."カテゴリ*";
	echo $this->Form->select('category_id',$category_options,
		array('default'=>$default['category_id'],'id'=>'category_id','empty'=>'選んでください'));
	echo "[この投稿で◯ポイント獲得] / サブカテゴリ";
	//連動プルダウン用
	echo $this->Form->select('subcategory_id',$subcategory_options,
		array('id'=>'subcategory_id','empty'=>'選んでください'));
	echo $this->Html->tag('br')."(カテゴリがわからないときは「その他」を選択してください)".$this->Html->tag('br');
	echo "問題文* [ 最大500 文字 ]".$this->Html->tag('br');
	//paraは<p>タグである
	echo $this->Html->para(null,'500',array('id' => 'num'));
	echo $this->Form->textarea('sentence',array('default'=>$default['sentence']));
	echo $this->Html->para(null, "解答*".$this->Form->textarea('right_answer',array('default'=>$default['right_answer'])));
	echo $this->Html->para(null, "その他の解答".$this->Form->textarea('another_answer',array('default'=>$default['another_answer'])));
  echo "写真を載せる場合は以下から登録 (200kb以下、JPEG および PNG画像)";
  echo $this->Form->input('',array(
    'type' => 'file',
    'name' => 'image'
	));
  echo "タグ(複数タグは半角「/」で区切り 例:盛岡/岩手/川)";
	echo $this->Form->text('tag',array('default'=>$default['tag']));
	echo $this->Html->para(null, $this->Html->tag('br')."解説* (メモ、参考URL、文献等)".
		$this->Form->textarea('description',array('default'=>$default['description'])));
  echo $this->Form->submit(('この内容で送信する'));
  echo $this->Form->end();
  echo $this->Html->tag('br');
	echo $this->Html->link('戻る',
	array('controller' => 'Problems', 'action' => 'make_top', 'full_base' => true)
	);
?>
</div>
<script>//文字数のjavascript
$(function(){
	$("#problem_dataSentence").bind("change keyup",function(){
	var count = $(this).val().length;
	var max = 500;//maxの文字数
		$("#num").text(max-count);
	});
});
</script>
<script type="text/javascript">
//条件付きプルダウン用のライブラリ
ConnectedSelect(['category_id','subcategory_id']);
</script>
