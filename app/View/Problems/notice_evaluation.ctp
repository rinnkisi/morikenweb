<?php foreach($notice_data as $row_num => $notice_value): ?>
  <?php foreach($notice_value['EvaluatorIdList'] as $evaluator_num => $evaluator_value): ?>
    <?php echo "評価者ID".$evaluator_value."&nbsp;" ?>
  <?php endforeach ;?>
    <p>の方が評価してくれました！</p>
  <?php
  echo $this->Html->link("問題文：".$notice_value['Problem']['sentence'],array(
    'controller' => 'problems',
    'action' => 'confirm_evaluation',
    $notice_value['Problem']['id']
    )
  );
  ?>
  <?php echo $this->html->tag('br'); ?>
    <?php echo "【最終投日時】".$notice_value['LastCreatedTime']; ?>
  <hr />
<?php endforeach ;?>

<?php echo $this->Html->link('戻る','show_evaluation_problem', array('class' => 'button'));
 ?>

<?php pr($notice_data); ?>
