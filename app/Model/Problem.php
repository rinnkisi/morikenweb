<?php
class Problem extends AppModel{
    public $useTable = 'problems';
    public function category_sort($categories){//カテゴリの分類
    	foreach ($categories['response']['Categories'] as $key => $value) {
            //配列の一次元目は+1をする(optgroupがlabel0ではだめなため)
            $category_data[$key+1]=$value['Category']['name'];
        }
        return $category_data;
    }
    public function subcategory_sort($categories){//サブカテゴリの分類
    	foreach ($categories['response']['Categories'] as $key => $value) {
            $subcategory_tmp[]=$value['Subcategory'];
        }
            //サブカテゴリをだしている
        foreach ($subcategory_tmp as $key => $value){
            $subcategories[$key] = $subcategory_tmp[$key];
            foreach ($subcategories[$key] as $i => $v) {
                //配列の一次元目は+1をする(optgroupがlabel0ではだめなため)
                $subcategory_data[$key+1][$i]= $subcategories[$key][$i]['name'];
            }
        }
        return $subcategory_data;
    }
    public function validation_category($record_data){
        if(!$record_data['category_id']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_subcategory($record_data){
        if(!$record_data['subcategory_id']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_sentence($record_data){
        if(!$record_data['sentence']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_right_answer($record_data){
        if(!$record_data['right_answer']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_wrong_answer1($record_data){
        if(!$record_data['wrong_answer1']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_wrong_answer2($record_data){
        if(!$record_data['wrong_answer2']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_wrong_answer3($record_data){
        if(!$record_data['wrong_answer3']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_tag($record_data){
        if(!$record_data['tag']){
            return null;
        }else{
            return 1;
        }
    }
    public function validation_description($record_data){
        if(!$record_data['description']){
            return null;
        }else{
            return 1;
        }
    }
}