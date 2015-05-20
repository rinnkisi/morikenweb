<?php

class ProblemsController extends AppController {

    public $name = 'Problems'; //クラス名
    function problem_select(){//選択式作問入力
        //api_rest($method, $uri, $query = null, $data = null)
        //typeを追加する。１は選択式問題。初期は選択式問題
        $this->set('type','1');
        //Webの場合は１を代入する
        $this->set('kentei_id','1');
        $category_api_pram = 'kentei_id=1';
        //カテゴリーAPIを使用,dataに送るのは空の配列
        $categories = $this->api_rest("GET","categories/index.json",$category_api_pram,array());
        //カテゴリをわかりやすくするためにモデルで処理
        $category_data = $this->Problem->category_sort($categories);
        $subcategory_data = $this->Problem->subcategory_sort($categories);
        $this->set('category_options',$category_data);
        $this->set('subcategory_options',$subcategory_data);
    }
    function problem_descriptive(){//記述式作問入力
        //2は記述式問題
        $this->set('type',"2");
        $category_api_pram = 'kentei_id=1';
        //カテゴリーAPIを使用
        $categories = $this->api_rest("GET","categories/index.json",$category_api_pram,array());
        foreach ($categories['response']['Categories'] as $key => $value) {
            $category_select[$key]=$value['Category']['name'];
            $subcategory_select[]=$value['Subcategory'];
        }
        $this->set('data_category',$category_select);
        $this->set('data_subcategory',$subcategory_select);
    }
    function select_check(){
        //選択問題の確認用ページ
        $check_tmp=$this->request->data;
        $check_data = $check_tmp['problem_selectdata'];
        //前にカテゴリーidを足していたものを元に戻す処理
        $check_data['category_id'] = $check_data['category_id']-1;
        debug($check_data);
        $this->set('check_data',$check_data);
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
    }
    function descriptive_check(){
        $check=$this->request->data;
        debug($check);
        $this->set($check);

        //API経由でDBに格納を行う
        $this->set('data',$check);
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
    }
    function select_completed(){
        $check=$this->request->data;
        debug($check);
        $this->set($check);
        $url = $this->api_rest("POST","problems/add.json","",$this->request->data['tmp']);
        debug($url);
        //API経由でDBに格納を行う
        $this->set('data',$url);
        //問題作成登録にapiにて成功のときのレスポンスデータを送っている
    }
    function descriptive_completed(){
        $check=$this->request->data;
        debug($check);
        $this->set($check);
        $url = $this->api_rest("POST","problems/add.json","",$this->request->data['tmp']);
        debug($url);
        //API経由でDBに格納を行う
        $this->set('data',$url);
        //問題作成登録にapiにて成功のときのレスポンスデータを送っている
    }
}
?>
