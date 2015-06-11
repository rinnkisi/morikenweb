<?php

echo "問題の詳細".$this->Html->tag('br');
echo "[作成者]".$this->Html->tag('br');
echo "[作成日時]".$this->Html->tag('br');
echo "[更新者]".$this->Html->tag('br');
echo "[最終更新]".$this->Html->tag('br');
echo "[カテゴリ]".$this->Html->tag('br');
echo "[サブカテゴリ]".$this->Html->tag('br');
echo "[タグ]".$this->Html->tag('br');
echo "[解説]".$this->Html->tag('br');
echo "[設問]".$this->Html->tag('br');
echo "[答え]".$this->Html->tag('br');

$this->Html->link("戻る",
		array('controller' => 'problems', 'action' => 'show_problem'));

