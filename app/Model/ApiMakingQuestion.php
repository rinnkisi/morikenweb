<?php 
	class ApiMakingQuestion extends AppModel{
		public $name = 'ApiMakingQuestion';
		// problem_checkのチェックボックスより問題の良/悪を判断
		function evaluate_judge($data){
		// 評価基準は後々変更
			$count = 0;
			foreach ($data['Evaluate'] as $key => $value) {
				if($value == 1) $count++;
			}
			if($count == 6) $judge_flg = 1;
				else $judge_flg = 0;
			return $judge_flg;
		}
	}
?>
	