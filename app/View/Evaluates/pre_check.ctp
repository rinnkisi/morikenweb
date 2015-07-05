<h3>評価内容確認</h3>

<?php
echo $this->Form->create('Evaluate',array(
	'type' => 'post',
	'action' => 'addCheck',
));
?>
<table>
	<?php $i = 1; ?>
	<?php foreach ($data['Evaluate'] as $key => $value): ?>
	<tr>
		<td rowspan="4">
			<!-- EvaluatesIDではない -->
			<?php echo "評価項目 "."[".$i."] "; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $value['name'] ?></td>
	</tr>
	<tr>
		<td>
			<?php
			if($value['check'] == 1)
				echo "合格";
			else if($value['check'] == 0)
				echo "不合格";
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			if(!empty($value['comment']))
				echo $value['comment'];
			else
				echo "無記入"; 
			?>
		</td>
	</tr>
	<!-- 登録データ -->
	<?php
	echo $this->Form->hidden("$key.check",array(
		'value'	=> $value['check']
		));
	echo $this->Form->hidden("$key.comment",array(
		'value'	=> $value['comment']
		));
	echo $this->Form->hidden("$key.name",array(
		'value'	=> $value['name']
		));
	?>
	<?php $i++; ?>

	<?php endforeach; ?>

	<?php 
	echo $this->Form->hidden("problem.id",array(
	'value'	=> $data['problem']['id']
	));
	?>


</table>

<?php
	echo $this->Form->submit('確定する');
?>

<?php pr($data); ?>
