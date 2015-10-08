<h3>投稿前に評価内容を確認</h3>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo $this->Form->create('Problems',array(
	'type' => 'post',
	'action' => 'add_evaluation_problem',
	// 'action' => 'index'
));
?>

<table>
	<?php foreach ($arrange_eval_data['Problems'] as $item_id => $eval_value): ?>
		<?php //debug($item_id); ?>
		<?php //debug($eval_value); ?>
	<tr>
		<td rowspan="4">
			<?php echo 'No '.'['.$eval_value['row_num'].'] '; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '評価内容：'.$eval_value['name']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '評価結果：'.$eval_value['check_value']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo 'コメント：'.$eval_value['comment']; ?>
		</td>
	</tr>

	<!-- 登録データ -->
	<?php
	echo $this->Form->hidden("$item_id.name",array(
		'value'	=> $eval_value['name']
		));
	echo $this->Form->hidden("$item_id.check",array(
		'value'	=> $eval_value['check']
		));
	echo $this->Form->hidden("$item_id.comment",array(
		'value'	=> $eval_value['comment']
		));
	?>

	<?php endforeach; ?>

</table>

<?php
	echo $this->Form->input("Problem_info.id",array(
		'type'	=> 'hidden',
		'value'	=> $arrange_eval_data['Problem_info']['id']
		));
	echo $this->Form->submit('確定する');
?>

<?php pr($arrange_eval_data) ?>
