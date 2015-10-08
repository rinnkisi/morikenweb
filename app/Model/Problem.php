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
    public function validation($url){//エラー処理
        //debug($url['error']['validation']['Problem']);
        if(!empty($url['error'])){
            foreach ($url['error']['validation']['Problem'] as $key => $value) {
                if($value == "category_idを設定してください")
                    $value = "カテゴリーを入力してください。";
                if($value == "sentenceを設定してください")
                    $value = "問題文を入力してください。";
                if($value == "right_answerを設定してください")
                    $value = "正解選択肢を入力してください。";
                if($value == "descriptionを設定してください")
                    $value = "解説を入力してください。";
                if($value == "wrong_answer1を設定してください")
                    $value = "誤答選択肢1を入力してください。";
                if($value == "wrong_answer2を設定してください")
                    $value = "誤答選択肢2を入力してください。";
                if($value == "wrong_answer3を設定してください")
                    $value = "誤答選択肢3を入力してください。";
                if($value == "subcategory_idを設定してください")
                    $value = "サブカテゴリを入力してください。";                $message[$key] = $value;
            }
            return $message;
        }else{
            return NULL;
        }
    }
}