<!-- 問題情報 -->
<?php echo "【問題文】 ".$accept_data['Problem']['sentence'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【正答】 ".$accept_data['Problem']['right_answer'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢1】 ".$accept_data['Problem']['wrong_answer1'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢2】 ".$accept_data['Problem']['wrong_answer2'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢3】 ".$accept_data['Problem']['wrong_answer3'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【作成日】 ".$accept_data['Problem']['created'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【更新日】 ".$accept_data['Problem']['modified'] ?>
<?php echo $this->html->tag('br') ?>

<?php echo $this->html->tag('hr') ?>

<!-- 評価情報 -->
<?php echo "【評価項目】 ".$accept_data['Evaluate']['evaluate_item_name'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【評価コメント】 ".$accept_data['Evaluate']['evaluate_comment'] ?>
<?php echo $this->html->tag('br') ?>

<?php
	echo $this->Form->create('Problems',array(
		'type' => 'post',
		'action' => 'add_confirm_comment',
		// 'action' => 'index'
	));
?>
<?php echo $this->Form->input('confirm_comment',array(
    'type'	=> 'textarea',
    'label'	=> '確認コメントを入力してください'
    ));
?>
<?php echo $this->Form->hidden('evaluate_id',array(
    'value'	=> $accept_data['Evaluate']['evaluate_id'],
    // 'label'	=>
    ));
?>
<?php echo $this->Form->submit('承認',array(
  'name' => 'accept'
  ));
?>

<?php debug($accept_data); ?>
