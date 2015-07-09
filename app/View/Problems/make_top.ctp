<nav id="breadcrumbs">
  <ol>
    <li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_top">
      <a itemprop="url" href="http://localhost/morikenweb/Problems/make_top"><span itemprop="title">top</span></a>
    </li>
    <li itemscope="itemscope" itemtype="http://localhost/morikenweb/Problems/make_top">
      <span itemprop="title">問題を作成</span>
    </li>
  </ol>
</nav>
<div id="sidebar">
  <ul>
    <li><a href="#">問題を作成する</a></li>
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
        問題作成
      </li>
    </ul>
  </h2>
  <hr size="5" color="#B45F04">
  <p class="content-post">
    問題を作成することができます<?php echo $this->Html->tag('br');?>
    問題を作成する際の注意点<?php echo $this->Html->tag('br');?>
    ①・・・・<?php echo $this->Html->tag('br');?>
    ②・・・・<?php echo $this->Html->tag('br');?>
    ③・・・・<?php echo $this->Html->tag('br');?>
  </p>
  <div id="box-select">
    <ul>
    <li><?php echo $this->Html->link('選択式問題',array('controller' => 'Problems', 'action' => 'make_problem', 'full_base' => true,"1"));?></li>
    <li><?php echo $this->Html->link('一問一答式問題',
    array('controller' => 'Problems', 'action' => 'make_problem', 'full_base' => true,"2"));?></li>
    </ul>
  </div>
</div>
