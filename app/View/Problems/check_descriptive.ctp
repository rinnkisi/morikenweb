<!-- 記述式問題作成の投稿完了をするページ -->
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
<?php
	echo "この内容で登録してよろしいですか？".$this->Html->tag('br');
	echo "[カテゴリ]：".$category.$this->Html->tag('br');
	echo "[サブカテゴリ]：".$subcategory.$this->Html->tag('br');
	echo "[問題文]：".$default_data['sentence'].$this->Html->tag('br');
	echo "[解答]-".$default_data['right_answer'].$this->Html->tag('br');
	echo "[その他の解答]-".$default_data['another_answer'].$this->Html->tag('br');
	echo "[タグ]：".$default_data['tag'].$this->Html->tag('br');
	echo "[解説]：".$default_data['description'].$this->Html->tag('br').$this->Html->tag('br');
?>
	<div id="box-select">
		<ul>
		<li><?php echo $this->Html->link("編集する", "javascript:history.back();");?></li>
		<li><?php echo $this->Html->link('登録する',
		array('controller'=>'Problems','action'=>'record_problem','full_base'=>true,"2"));?></li>
		</ul>
	</div>
</div>
