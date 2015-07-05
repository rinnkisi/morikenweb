<h3>UserId=7の評価履歴</h3>

<table>
	<?php foreach ($arrange_eval_data as $row_num => $eval_value): ?>
		<?php //debug($item_id); ?>
		<?php //debug($eval_value); ?>
	<tr>
		<td rowspan="13">
			<?php echo 'No'.$row_num; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '問題文：'.$eval_value['prob_sentence']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '正答：'.$eval_value['prob_right_answer']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '誤答選択肢1：'.$eval_value['prob_wrong_answer1']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '誤答選択肢2：'.$eval_value['prob_wrong_answer2']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '誤答選択肢3：'.$eval_value['prob_wrong_answer3']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '問題作成日：'.$eval_value['prob_created']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '最終更新日：'.$eval_value['prob_modified']; ?>
		</td>
	</tr>



	<tr>
		<td>
			<?php echo '評価項目ID：'.$eval_value['eval_item_id']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '評価コメント：'.$eval_value['eval_commnent']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '作問者確認コメント：'.$eval_value['eval_confirm_comment']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '作問者確認状況（flag表示）：'.$eval_value['eval_confirm_flag']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '評価日：'.$eval_value['eval_created']; ?>
		</td>
	</tr>
	<?php endforeach; ?>

</table>


<?php debug($arrange_eval_data); ?>

<!-- ユーザ名、評価項目名、同時呼び出しか、新規APIにて呼び出しか -->