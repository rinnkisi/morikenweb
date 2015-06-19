<!-- 問題情報 -->
<?php echo "【問題文】 ".$deny_data['Problem']['sentence'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【正答】 ".$deny_data['Problem']['right_answer'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢1】 ".$deny_data['Problem']['wrong_answer1'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢2】 ".$deny_data['Problem']['wrong_answer2'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢3】 ".$deny_data['Problem']['wrong_answer3'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【作成日】 ".$deny_data['Problem']['created'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【更新日】 ".$deny_data['Problem']['modified'] ?>
<?php echo $this->html->tag('br') ?>

<?php echo $this->html->tag('hr') ?>

<!-- 評価情報 -->
<?php echo "【評価項目】 ".$deny_data['Evaluate']['evaluate_item_name'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【評価コメント】 ".$deny_data['Evaluate']['evaluate_comment'] ?>
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
    'value'	=> $deny_data['Evaluate']['evaluate_id'],
    // 'label'	=>
    ));
?>
<?php
  echo $this->Form->submit('否認',array(
    'name' => 'deny'
  ));
?>

<?php debug($deny_data); ?>
