<?php

class ProblemsController extends AppController {
    public $name = 'Problems'; //クラス名
    public $components = array('Session');//componetsのsessionを用いる
    function make_problem($type = null){//初期は選択式作問入力
        $this->set('kentei_id','1');
        //Webの場合は１を代入する
        $category_api_pram = 'kentei_id=1';
        //api_rest($method, $uri, $query = null, $data = null)
        $this->request->data = $this->Session->read('check_data');
        //カテゴリーAPIを使用,dataに送るのは空の配列
        $categories = $this->api_rest("GET","categories/index.json",$category_api_pram,array());
        //カテゴリをわかりやすくするためにモデルで処理、セッション管理
        $this->Session->write('category_options',$this->Problem->category_sort($categories));
        $this->Session->write('subcategory_options',$this->Problem->subcategory_sort($categories));
        $this->set('category_options',$this->Session->read('category_options'));
        $this->set('subcategory_options',$this->Session->read('subcategory_options'));
        //typeを追加する。１は選択式問題。初期は選択式問題
        if($type == 1 || $type == null){
            $this->Session->write('type','1');
            $this->set('type','1');
            $this->render('select_problem');
        }else{
            $this->Session->write('type',$type);
            $this->set('type',$type);
            $this->render('descriptive_problem');
        }
    }
    function check_problem(){
        //問題の確認用ページ
        $check_data = $this->request->data['problem_data'];
        //セッション書き込み
        $this->Session->write('check_data',$check_data);
        $this->set('check_data',$check_data);
        $category_data=$this->Session->read('category_options');
        $subcategory_data=$this->Session->read('subcategory_options');
        //debug($category_data[$check_data['category_id']]);
        $category_id=$check_data['category_id'];
        $this->set('category_id',$category_id);
        //カテゴリが入力されていない場合の条件文
        if(!empty($category_data[$category_id])){//カテゴリが空でないとき
            $this->set('category',$category_data[$category_id]);
            if(!($check_data['subcategory_id'] == '')){//サブカテゴリが空でないとき
                //debug($subcategory_data[$category_id]);
                $this->set('subcategory_id',$check_data['subcategory_id']);
                $this->set('subcategory',$subcategory_data[$category_id][$check_data['subcategory_id']]);
            }else{
                $this->set('subcategory',"");
            }
        }else{
            $this->set('category',"");
            $this->set('subcategory',"");
        }
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
        if("1"== $check_data['type']){//適切なviewをレンダー
            $this->render('check_select');
        }else{
            $this->render('check_descriptive');
        }
    }
    function record_problem(){
        //選択問題の登録用ページ
        //セッションデータを呼び出し
        if(!empty($this->Session->read('check_data'))){
            $record_data=$this->Session->read('check_data');
            //query は送らないので空にしている
            //前にカテゴリーidを足していたものを元に戻す処理
            debug($record_data);
            //$tmp=$this->Problem->validation_category($record_data);

            if(!empty($record_data['category_id'])){//category_idを戻す処理
                $record_data['category_id'] = $record_data['category_id'];
            }
            $url = $this->api_rest("POST","problems/add.json","",$record_data);
            //debug($tmp);
            $tmp = $this->Problem->validation($url);
            $this->set('error',$tmp);
            //debug($tmp);
            if(!isset($url['error']) && isset($url['response'])){//エラー処理
                $this->set('record_data',$url['response']['Problem']);
                //問題作成登録にapiにて成功のときのレスポンスデータを送っている
                $this->Session->delete('check_data');//セッションの破棄
                $category = $this->api_rest("GET","categories/index.json","kentei_id=".$record_data['kentei_id'],array());
                $category = $category['response']['Categories'][$record_data['category_id']];
                $this->set('category',$category['Category']['name']);
                if(isset($record_data['subcategory_id'])){
                    $subcategory = $category['Subcategory'][$record_data['subcategory_id']];
                    $this->set('subcategory',$subcategory['name']);
                }else{
                    $this->set('subcategory',"");
                }
            }
            if("1"== $record_data['type']){//適切なviewをレンダー
                $this->render('record_select');
            }else{
                $this->render('record_descriptive');
            }
            //API経由でDBに格納を行う
        }else{
            $this->set('error',array());
            $this->set('category',"");
            $this->set('subcategory',"");
            if("1"== $this->Session->read('type')){
                $this->render('record_select');
            }else{
                $this->render('record_descriptive');
            }
        }
    }
    function show_problem(){
        //問題履歴ページの編集投稿機能
        //未投稿画面
        $show_api_pram = "kentei_id=1&item=100&grade=0&public_flag=0&employ=0";
        //$show_api_pram=$show_api_pram."&user_id=2";
        $url = $this->api_rest("GET","problems/index.json",$show_api_pram,array());
        //debug($url);
        $this->set('show_data',$url['response']['Problems']);
    }
    function view_problem($id= null,$type= null){//問題表示画面
        debug($type);
        $view_api_pram = "kentei_id=1&item=1&grade=0&public_flag=0&employ=0&id=".$id;
        $url = $this->api_rest("GET","problems/index.json",$view_api_pram,array());
        debug($url);
        $view_data=$url['response']['Problems']['0'];
        $this->Session->write('type',$type);
        $this->Session->write('id',$id);
        $this->Session->write('default_data',$view_data);
        $this->set('view_data',$view_data);
        if("1"==$type){
            $this->render('view_select');
        }else if("2"==$type){
            $this->render('view_descriptive');
        }
    }
    function edit_problem(){
        //編集画面
        $this->set('kentei_id','1');
        $category_api_pram = 'kentei_id=1';
        //カテゴリーAPIを使用,dataに送るのは空の配列
        $categories = $this->api_rest("GET","categories/index.json",$category_api_pram,array());
        //カテゴリをわかりやすくするためにモデルで処理、セッション管理
        $this->Session->write('category_options',$this->Problem->category_sort($categories));
        $this->Session->write('subcategory_options',$this->Problem->subcategory_sort($categories));
        $this->set('category_options',$this->Session->read('category_options'));
        $this->set('subcategory_options',$this->Session->read('subcategory_options'));
        $default_data = $this->Session->read('default_data');
        debug($default_data);
        $this->set('default',$this->Session->read('default_data'));
        //typeを追加する。１は選択式問題。初期は選択式問題
        $this->set('type',$this->Session->read('type'));
        $this->render('edit_select');
        //後にフラグ処理
    }
    function edit_check(){
        //選択問題の確認用ページ
        $check_data = $this->request->data['problem_data'];
        //セッション書き込み
        $this->Session->write('check_data',$check_data);
        $this->set('check_data',$check_data);
        $category_data=$this->Session->read('category_options');
        $subcategory_data=$this->Session->read('subcategory_options');
        //debug($category_data[$check_data['category_id']]);
        $category_id=$check_data['category_id'];
        $this->set('category_id',$category_id);
        //カテゴリが入力されていない場合の条件文
        if(!empty($category_data[$category_id])){//カテゴリが空でないとき
            $this->set('category',$category_data[$category_id]);
            if(!($check_data['subcategory_id'] == '')){//サブカテゴリが空でないとき
                //debug($subcategory_data[$category_id]);
                $this->set('subcategory_id',$check_data['subcategory_id']);
                $this->set('subcategory',$subcategory_data[$category_id][$check_data['subcategory_id']]);
            }else{
                $this->set('subcategory',"");
            }
        }else{
            $this->set('category',"");
            $this->set('subcategory',"");
        }
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
        $this->render('edit_selectcheck');
    }
    function update(){
        //更新処理及び更新内容表示
        $url = $this->api_rest("PUT","problems/edit/1.json","",$this->request->data());
        debug($url);
    }
    function post_problem(){
        //投稿画面
    }
}
?>
