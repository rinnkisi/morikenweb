<?php
	class Evaluate extends AppModel{
		public $name = 'Evaluate';
		public $useTable = false;

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

		public function arrange_notice_info($problem_api_value){
			$problem_row_num = 0;
			foreach($problem_api_value['response']['Problems'] as $notice_value){
				if(!empty($notice_value['EvaluateComment'])){
					$notice_data[$problem_row_num]['Problem'] = $notice_value['Problem'];
					$notice_data[$problem_row_num]['EvaluateComment'] = $notice_value['EvaluateComment'];

					foreach($notice_value['EvaluateComment'] as $evaluate_value){
						$evaluator_id[] = $evaluate_value['user_id'];
						$created_time[] = $evaluate_value['created'];
					}
					$notice_data[$problem_row_num]['EvaluatorIdList'] = array_unique($evaluator_id);
					$notice_data[$problem_row_num]['LastCreatedTime'] = max($created_time);
					$problem_row_num++;
				}
			}
			if(!empty($notice_data)){
				return $notice_data;
			}else{
				$notice_data['not_found_flug'] = 1;
				return $notice_data;
			}
		}

		public function arrange_confirm_info($arrange_notice_data,$problem_id,$evaluate_item){
			foreach($arrange_notice_data as $notice_num => $notice_value){
				// 対象の問題情報を格納
				if($notice_value['Problem']['id'] == $problem_id){
					$confirm_data['Problem']['sentence'] = $notice_value['Problem']['sentence'];
					$confirm_data['Problem']['right_answer'] = $notice_value['Problem']['right_answer'];
					$confirm_data['Problem']['wrong_answer1']	= $notice_value['Problem']['wrong_answer1'];
					$confirm_data['Problem']['wrong_answer2']	= $notice_value['Problem']['wrong_answer2'];
					$confirm_data['Problem']['wrong_answer3']	= $notice_value['Problem']['wrong_answer3'];
					$confirm_data['Problem']['created'] = $notice_value['Problem']['created'];
					$confirm_data['Problem']['modified'] = $notice_value['Problem']['modified'];

					// 評価者ごとに各コメント情報を表示できるように調節
					$row_num = 0;
					foreach($notice_value['EvaluatorIdList'] as $list_num => $list_value){
						foreach($notice_value['EvaluateComment'] as $evaluate_num => $evaluate_value){
							if($evaluate_value['user_id'] == $list_value){
								$confirm_data['Evaluate'][$row_num]['evaluator_id'] = $list_value;
								$confirm_data['Evaluate'][$row_num]['evaluate_data'][$evaluate_num]['evaluate_item_id'] = $evaluate_value['evaluate_item_id'];
								$confirm_data['Evaluate'][$row_num]['evaluate_data'][$evaluate_num]['evaluate_comment'] = $evaluate_value['evaluate_comment'];
								$confirm_data['Evaluate'][$row_num]['evaluate_data'][$evaluate_num]['created'] 					= $evaluate_value['created'];

								foreach($evaluate_item['response']['EvaluateItems'] as $item_num => $item_value){
									if($evaluate_value['evaluate_item_id'] == $item_value['EvaluateItem']['id']){
										$confirm_data['Evaluate'][$row_num]['evaluate_data'][$evaluate_num]['evaluate_item_name'] = $item_value['EvaluateItem']['name'];
									}
								}
							}
						}
						$row_num++;
					}
				}
			}
			return $confirm_data;
		}
	}
?>
