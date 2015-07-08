<?php
echo "問題作成機能";
echo $this->Html->tag('br');
echo $this->Html->link('選択式問題を作成する',
array('controller' => 'Problems', 'action' => 'make_problem', 'full_base' => true,"1"));
echo $this->Html->tag('br');
echo $this->Html->link('一問一答式問題を作成する',
array('controller' => 'Problems', 'action' => 'make_problem', 'full_base' => true,"2"));
