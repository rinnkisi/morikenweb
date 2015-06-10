<?php
	class Ask extends AppModel{
		public $name = 'Ask';
		// public $useTable = false;

public function fksk(){
	return "hoge";
}


		public function test_data(){
			$test_data[0]['user_id'] = "hoge";
			$test_data[0]['sentence'] = "hhhhhhhhooooooooooogggggggggggggeeeeeeeeeee";
			$test_data[0]['right_answer'] = "h";
			$test_data[0]['wrong_answer1'] = "ho";
			$test_data[0]['wrong_answer2'] = "hog";
			$test_data[0]['wrong_answer3'] = "hoge";
			$test_data[0]['description'] = "hogehogehoge";
			$test_data[0]['category_id'] = "盛岡の気候と地理";
			$test_data[0]['subcategory_id'] = "盛岡市内から見える山";
			$test_data[0]['type'] = 1;
			// $test_data[0]['making_date'] = "2011-12-01 21:44:17";
			// $test_data[0]['update_user'] = "fuga";
			// $test_data[0]['last_update'] = "2012-12-01 21:44:17";
			// $test_data[0]['tag'] = "hogehoge";
			// $test_data[0]['expiration'] = "2013-10-16";

			$test_data[1]['user_id'] = "hoge";
			$test_data[1]['sentence'] = "hhhhhhhhooooooooooogggggggggggggeeeeeeeeeee";
			$test_data[1]['right_answer'] = "h";
			$test_data[1]['wrong_answer1'] = "ho";
			$test_data[1]['wrong_answer2'] = "hog";
			$test_data[1]['wrong_answer3'] = "hoge";
			$test_data[1]['description'] = "hogehogehoge";
			$test_data[1]['category_id'] = "盛岡の気候と地理";
			$test_data[1]['subcategory_id'] = "盛岡市内から見える山";
			$test_data[1]['type'] = 1;
			// $test_data[0]['making_date'] = "2011-12-01 21:44:17";
			// $test_data[0]['update_user'] = "fuga";
			// $test_data[0]['last_update'] = "2012-12-01 21:44:17";
			// $test_data[0]['tag'] = "hogehoge";
			// $test_data[0]['expiration'] = "2013-10-16";

			$test_data[2]['user_id'] = "hoge";
			$test_data[2]['sentence'] = "hhhhhhhhooooooooooogggggggggggggeeeeeeeeeee";
			$test_data[2]['right_answer'] = "h";
			$test_data[2]['wrong_answer1'] = "ho";
			$test_data[2]['wrong_answer2'] = "hog";
			$test_data[2]['wrong_answer3'] = "hoge";
			$test_data[2]['description'] = "hogehogehoge";
			$test_data[2]['category_id'] = "盛岡の気候と地理";
			$test_data[2]['subcategory_id'] = "盛岡市内から見える山";
			$test_data[2]['type'] = 1;
			// $test_data[0]['making_date'] = "2011-12-01 21:44:17";
			// $test_data[0]['update_user'] = "fuga";
			// $test_data[0]['last_update'] = "2012-12-01 21:44:17";
			// $test_data[0]['tag'] = "hogehoge";
			// $test_data[0]['expiration'] = "2013-10-16";

			return $test_data;
		}

	}

?>