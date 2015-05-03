<h3>評価内容確認</h3>

<?php
echo $this->Form->create('Problems',array(
	'type' => 'post',
	'action' => 'evaluate_add_check',
));
?>

<table>
	<?php foreach ($arrange_eval_data as $item_id => $eval_value): ?>
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
	echo $this->Form->submit('確定する');
?>

<?php pr($arrange_eval_data) ?>
