<?php
	class Evaluate extends AppModel{
		public $name = 'Evaluate';
		public $useTable = false;

		public $validate = array(
			'1comment' => array(
				'rule' => array('notEmpty'),
				'message' => 'どの部分を改善すべきか記述してください'
			)
		);		

		public function eval_cont_arrange($eval_cont){
			$row_num = 1;
			foreach ($eval_cont['Problems'] as $item_id => $eval_value){
				$arrange_data[$item_id]['row_num'] = $row_num;
				$arrange_data[$item_id]['comment'] = $eval_value['comment'];
				$arrange_data[$item_id]['name'] = $eval_value['name'];
				$arrange_data[$item_id]['check'] = $eval_value['check'];
				if($eval_value['check'] == 0)
					$arrange_data[$item_id]['check_value'] = "合格";
				else if($eval_value['check'] == 1)
					$arrange_data[$item_id]['check_value'] = "修正箇所あり";
				$row_num++;
			}
			return $arrange_data;
		}
		public function eval_record_arrange($eval_cont){
			// $row_num = 1;
			foreach ($eval_cont['response']['EvaluateComments'] as $item_id => $eval_value){
				// $arrange_data[$item_id]['row_num'] = $row_num;
				$arrange_data[$item_id]['eval_item_id'] = $eval_value['EvaluateComment']['evaluate_item_id'];
				$arrange_data[$item_id]['eval_commnent'] = $eval_value['EvaluateComment']['evaluate_comment'];
				$arrange_data[$item_id]['eval_confirm_comment'] = $eval_value['EvaluateComment']['confirm_comment'];
				$arrange_data[$item_id]['eval_confirm_flag'] = $eval_value['EvaluateComment']['confirm_flag'];
				$arrange_data[$item_id]['eval_created'] = $eval_value['EvaluateComment']['created'];

				$arrange_data[$item_id]['prob_sentence'] = $eval_value['Problem']['sentence'];
				$arrange_data[$item_id]['prob_right_answer'] = $eval_value['Problem']['right_answer'];
				$arrange_data[$item_id]['prob_wrong_answer1'] = $eval_value['Problem']['wrong_answer1'];
				$arrange_data[$item_id]['prob_wrong_answer2'] = $eval_value['Problem']['wrong_answer2'];
				$arrange_data[$item_id]['prob_wrong_answer3'] = $eval_value['Problem']['wrong_answer3'];
				$arrange_data[$item_id]['prob_created'] = $eval_value['Problem']['created'];
				$arrange_data[$item_id]['prob_modified'] = $eval_value['Problem']['modified'];
				// $row_num++;
			}
			return $arrange_data;
		}

	}
?>
