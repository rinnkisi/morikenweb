<?php
echo "問題の詳細".$this->Html->tag('br');
echo "[作成者]：".$view_data['Problem']['user_id'].$this->Html->tag('br');
echo "[作成日時]：".$view_data['Problem']['created'].$this->Html->tag('br');
echo "[最終更新]：".$view_data['Problem']['modified'].$this->Html->tag('br');
echo "[カテゴリ]：".$view_data['Category']['name'].$this->Html->tag('br');
//echo "[サブカテゴリ]：".$view_data['Problem']['subcategory_id'].$this->Html->tag('br');
echo "[解説]：".$view_data['Problem']['description'].$this->Html->tag('br');
echo "[設問]：".$view_data['Problem']['sentence'].$this->Html->tag('br');
echo "[答え]：".$view_data['Problem']['right_answer'].$this->Html->tag('br');
echo "[選択肢1]：".$view_data['Problem']['wrong_answer1'].$this->Html->tag('br');
echo "[選択肢2]：".$view_data['Problem']['wrong_answer2'].$this->Html->tag('br');
echo "[選択肢3]：".$view_data['Problem']['wrong_answer3'].$this->Html->tag('br');
echo $this->Html->tag('br');


echo $this->Html->link("戻る",
		array('controller' => 'problems', 'action' => 'show_problem'));
echo $this->Html->link("戻る",
		array('controller' => 'problems', 'action' => 'show_problem'));
echo $this->Html->link("戻る",
		array('controller' => 'problems', 'action' => 'show_problem'));
