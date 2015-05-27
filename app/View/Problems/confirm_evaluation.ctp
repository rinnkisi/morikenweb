<?php echo "【問題文】 ".$confirm_data['Problem']['sentence'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【正答】 ".$confirm_data['Problem']['right_answer'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢1】 ".$confirm_data['Problem']['wrong_answer1'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢2】 ".$confirm_data['Problem']['wrong_answer2'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【誤答選択肢3】 ".$confirm_data['Problem']['wrong_answer3'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【作成日】 ".$confirm_data['Problem']['created'] ?>
<?php echo $this->html->tag('br') ?>
<?php echo "【更新日】 ".$confirm_data['Problem']['modified'] ?>
<?php echo $this->html->tag('br') ?>

<?php echo $this->html->tag('hr') ?>

<?php foreach($confirm_data['Evaluate'] as $evaluate_num => $evaluate_value): ?>
	<?php echo "【評価者※ID】 ".$evaluate_value['evaluator_id'] ?>
	<?php echo $this->html->tag('br') ?>
	<?php foreach($evaluate_value['evaluate_data'] as $comment_num => $comment_value): ?>
		<?php echo "【評価項目】".$comment_value['evaluate_item_name'] ?>
		<?php echo $this->html->tag('br') ?>
		<?php echo "【コメント内容】".$comment_value['evaluate_comment'] ?>
		<?php echo $this->html->tag('br') ?>
		<?php echo "【投稿日】".$comment_value['created'] ?>
		<?php echo $this->html->tag('br') ?>
	<?php endforeach ;?>
	<?php echo $this->html->tag('hr') ?>
<?php endforeach ;?>

<?php //debug($confirm_data); ?>
