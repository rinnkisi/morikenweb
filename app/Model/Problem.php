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

}