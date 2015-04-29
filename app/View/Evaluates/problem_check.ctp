<h3>問題の評価：YESの項目にチェック</h3>
<!-- 以下評価項目の内容については後に検討 -->
<?php
	echo $this->Form->create('Evaluate',array(
		'type' => 'post',
		'action' => 'preCheck',
	));
	// 評価項目とチェック・コメントフォームのリスト
	foreach ($data['evaluate_items']['response']['EvaluateItems'] as $key => $value) {
		// 評価項目に対してチェック
		$EvaluateItem_id = $value['EvaluateItem']['id'];
		echo $this->Form->input("$EvaluateItem_id.check"
			,array(
				'type'	=> 'checkbox',
				'label'	=> $value['EvaluateItem']['name'],
				'div'	=> false
				));
		// 評価項目に対してコメント
		echo $this->Form->input("$EvaluateItem_id.comment",array(
				'type'	=> 'textarea',
				'label'	=> false
				));
		// 評価項目
		echo $this->Form->input("$EvaluateItem_id.name",
			array(
				'type'	=> 'hidden',
				'value'	=> $value['EvaluateItem']['name']
				));
		echo "<hr />";
	}
	echo $this->Form->input("problem.id",array(
		'type'	=> 'hidden',
		'value'	=> $data['problem_id']
		));
	echo $this->Form->submit('評価する');
?>

<?php pr($data)?>
