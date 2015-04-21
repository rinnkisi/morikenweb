<h3>問題情報</h3>
<!-- ※ID表示　は後ほど修正 -->
<?php echo "[作成日時] xxxxx"?><br />
<?php echo "[更新者] xxxxx" ?><br />
<?php echo "[最終更新] xxxxx" ?><br />
<?php echo "[カテゴリ※ID表示] "; ?><br />
<?php echo "[サブカテゴリ※ID表示] "; ?><br />
<?php echo "[画像] xxxxx" ?><br />
<?php echo "[有効期限] xxxxx" ?><br />
<?php echo "[設問] " ?><br />
<?php echo "[正答] " ?><br />
<?php echo "[誤答１] " ?><br />
<?php echo "[誤答２] " ?><br />
<?php echo "[誤答３] " ?><br />
<?php echo "[解説] "; ?><br />
<?php echo $this->Html->link("【戻る】",array('action' => 'show')); ?>
<hr />
<h3>問題の評価：YESの項目にチェック</h3>
<!-- 以下評価項目の内容については後に検討 -->
<?php
	echo $this->Form->create('Evaluate',array(
		'type' => 'post',
		'action' => 'evaluate',
	));
	foreach ($data->response->EvaluateItems as $key => $value) {
		$checkbox_name = "check".$value->EvaluateItem->id;
		echo $this->Form->input($checkbox_name,array(
			'type' => 'checkbox',
			'label' => $value->EvaluateItem->name,
			'div' => false
		));
		echo "<hr />";
	}
	echo $this->Form->submit('評価する');
?>

<?php// pr($data)?>
