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
		echo "以下の内容で登録しました<br />";
		echo "[カテゴリ]：".$category.$this->Html->tag('br');
		//echo "[サブカテゴリ]：".$subcategory.$this->Html->tag('br');
		echo "[問題文]：".$record_data['sentence'].$this->Html->tag('br');
		echo "答え[選択肢1]-".$record_data['right_answer'].$this->Html->tag('br');
		echo "[選択肢２]-".$record_data['wrong_answer1'].$this->Html->tag('br');
		echo "[選択肢３]-".$record_data['wrong_answer2'].$this->Html->tag('br');
		echo "[選択肢４]-".$record_data['wrong_answer3'].$this->Html->tag('br');
		//echo "[タグ]：".$record_data['tag'].$this->Html->tag('br');
		echo "[解説]：".$record_data['description'].$this->Html->tag('br');
		echo $this->Html->link('選択式問題作成ページに戻る',
			array('controller'=>'Problems','action'=>'make_problem','full_base'=>true,"1"));
		echo $this->Html->tag('br');
	echo $this->Html->link('トップページに戻る',
	array('controller'=>'Problems','action'=>'top','full_base'=>true)
	);
?>
<div id="box-select">
	<ul>
	<li><?php echo $this->Html->link('選択式問題作成ページに戻る',
		array('controller'=>'Problems','action'=>'make_problem','full_base'=>true,"1"));?></li>
	<li><?php echo $this->Html->link('トップページに戻る',
	array('controller'=>'Problems','action'=>'make_top','full_base'=>true));?></li>
	</ul>
</div>
</div>
