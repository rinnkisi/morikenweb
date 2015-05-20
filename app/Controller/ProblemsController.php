<?php

class ProblemsController extends AppController {

    public $name = 'Problems'; //クラス名
    public $components = array('Session');//componetsのsessionを用いる
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
        $this->Session->write('category_options',$category_data);
        $this->Session->write('subcategory_options',$subcategory_data);
        $this->set('category_options',$category_data);
        $this->set('subcategory_options',$subcategory_data);
    }
    function problem_descriptive(){//記述式作問入力
        //2は記述式問題
        $this->set('type','2');
        $this->set('kentei_id','1');
        $category_api_pram = 'kentei_id=1';
        //カテゴリーAPIを使用,dataに送るのは空の配列
        $categories = $this->api_rest("GET","categories/index.json",$category_api_pram,array());
        //カテゴリをわかりやすくするためにモデルで処理
        $category_data = $this->Problem->category_sort($categories);
        $subcategory_data = $this->Problem->subcategory_sort($categories);
        $this->Session->write('category_options',$category_data);
        $this->Session->write('subcategory_options',$subcategory_data);
        $this->set('category_options',$category_data);
        $this->set('subcategory_options',$subcategory_data);
    }
    function select_check(){
        //選択問題の確認用ページ
        $check_tmp=$this->request->data;
        $check_data = $check_tmp['problem_selectdata'];
        //前にカテゴリーidを足していたものを元に戻す処理
        $check_data['category_id'] = $check_data['category_id']-1;
        //セッション書き込み
        $this->Session->write('check_data',$check_data);
        debug($check_data);
        $this->set('check_data',$check_data);
        $category_data=$this->Session->read('category_options');
        $subcategory_data=$this->Session->read('subcategory_options');
        $this->set('category_options',$category_data);
        $this->set('subcategory_options',$subcategory_data);
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
    }
    function descriptive_check(){
        //記述問題の確認用ページ
        $check_tmp=$this->request->data;
        $check_data = $check_tmp['problem_descriptivedata'];
        //前にカテゴリーidを足していたものを元に戻す処理
        $check_data['category_id'] = $check_data['category_id']-1;
        //セッション書き込み
        $this->Session->write('check_data',$check_data);
        debug($check_data);
        $this->set('check_data',$check_data);
        $category_data=$this->Session->read('category_options');
        $subcategory_data=$this->Session->read('subcategory_options');
        $this->set('category_options',$category_data);
        $this->set('subcategory_options',$subcategory_data);
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
    }
    function select_record(){
        //選択問題の登録用ページ
        //セッションデータを呼び出し
        $record_data=$this->Session->read('check_data');
        //query は送らないので空にしている
        debug($record_data);        //デバック用
        $url = $this->api_rest("POST","problems/add.json","",$record_data);
        debug($url);
        $this->Session->delete('check_data');
        //API経由でDBに格納を行う
        $this->set('select_record_data',$url['response']['Problem']);
        //問題作成登録にapiにて成功のときのレスポンスデータを送っている
    }
    function descriptive_record(){
        //記述問題の登録用ページ
       //セッションデータを呼び出し
        $record_data=$this->Session->read('check_data');
        //query は送らないので空にしている
        debug($record_data);        //デバック用
        $url = $this->api_rest("POST","problems/add.json","",$record_data);
        debug($url);
        $this->Session->delete('check_data');
        //API経由でDBに格納を行う
        $this->set('descriptive_record_data',$url['response']['Problem']);
        //問題作成登録にapiにて成功のときのレスポンスデータを送っている
    }
}
?>
