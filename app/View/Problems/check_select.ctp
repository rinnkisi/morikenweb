<!-- 四択式問題作成の投稿完了をするページ -->
<nav id="breadcrumbs">
  <ol>
    <li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_top">
      <a itemprop="url" href="http://localhost/morikenweb/Problems/make_top"><span itemprop="title">top</span></a>
    </li>
    <li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_top">
			<a itemprop="url" href="http://localhost/morikenweb/Problems/make_top"><span itemprop="title">問題を作成</span></a>
    </li>
		<li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_problem/1">
			<span itemprop="title">選択式問題</span>
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
	echo "この内容で問題を投稿してもいいですか？".$this->Html->tag('br');
	echo "[カテゴリ]：".$category.$this->Html->tag('br');
	echo "[サブカテゴリ]：".$subcategory.$this->Html->tag('br');
	echo "[問題文]：".$default_data['sentence'].$this->Html->tag('br');
	echo "答え[選択肢1]-".$default_data['right_answer'].$this->Html->tag('br');
	echo "[選択肢２]-".$default_data['wrong_answer1'].$this->Html->tag('br');
	echo "[選択肢３]-".$default_data['wrong_answer2'].$this->Html->tag('br');
	echo "[選択肢４]-".$default_data['wrong_answer3'].$this->Html->tag('br');
	echo "[タグ]：".$default_data['tag'].$this->Html->tag('br');
	echo "[解説]：".$default_data['description'].$this->Html->tag('br').$this->Html->tag('br');

	?>
	<div id="box-select">
		<ul>
		<li><?php echo $this->Html->link("編集する", "javascript:history.back();");?></li>
		<li><?php echo $this->Html->link('登録する',
		array('controller'=>'Problems','action'=>'record_problem','full_base'=>true));?></li>
		</ul>
	</div>
</div>
