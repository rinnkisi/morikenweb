<h3>非公開問題</h3>
<table>
	<?php $i = 1; ?>
	<?php foreach ($show_obj['publ']['response']['Problems'] as $key => $value): ?>
	<tr>
		<td><?php echo "[".$i."] "; ?></td>
		<td><?php echo $this->Html->link($value['Problem']['sentence'],array('action' => 'check_evaluation_problem',$value['Problem']['id'])); ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
<h3>公開問題</h3>
<table>
	<?php $i = 1; ?>
	<?php foreach ($show_obj['priv']['response']['Problems'] as $key => $value): ?>
	<tr>
		<td><?php echo "[".$i."] "; ?></td>
		<td><?php echo $this->Html->link($value['Problem']['sentence'],array('action' => 'check_evaluation_problem',$value['Problem']['id'])); ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>

<?php pr($show_obj) ?>
