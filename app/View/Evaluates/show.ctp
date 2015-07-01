<h3>非公開問題</h3>
<table>
	<?php $i = 1; ?>
	<?php foreach ($data['public']['response']['Problems'] as $key => $value): ?>
	<tr>
		<td><?php echo "[".$i."] "; ?></td>
		<td><?php echo $this->Html->link($value['Problem']['sentence'],array('action' => 'problemCheck',$value['Problem']['id'])); ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
<h3>公開問題</h3>
<table>
	<?php $i = 1; ?>
	<?php foreach ($data['private']['response']['Problems'] as $key => $value): ?>
	<tr>
		<td><?php echo "[".$i."] "; ?></td>
		<td><?php echo $this->Html->link($value['Problem']['sentence'],array('action' => 'problemCheck',$value['Problem']['id'])); ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>

<?php pr($data) ?>