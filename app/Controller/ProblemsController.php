<?php

class ProblemsController extends AppController {
    public $name = 'Problems'; //クラス名
    public $components = array('Session');//componetsのsessionを用いる
    function make_problem($type = null){//初期は選択式作問入力
        $this->set('kentei_id','1');
        //Webの場合は１を代入する
        $category_api_pram = 'kentei_id=1';
        //api_rest($method, $uri, $query = null, $data = null)
        $this->request->data = $this->Session->read('default_data');
        //カテゴリーAPIを使用,dataに送るのは空の配列
        $categories = $this->api_rest("GET","categories/index.json",$category_api_pram,array());
        //カテゴリをわかりやすくするためにモデルで処理、セッション管理
        $this->Session->write('category_options',$this->Problem->category_sort($categories));
        $this->Session->write('subcategory_options',$this->Problem->subcategory_sort($categories));
        $this->set('category_options',$this->Session->read('category_options'));
        $this->set('subcategory_options',$this->Session->read('subcategory_options'));
        $default_data = $this->Session->read('default_data');
        $this->set('default',$this->Session->read('default_data'));
        //typeを追加する。１は選択式問題。初期は選択式問題
        $this->set('type',$this->Session->read('type'));

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
        $default_data = $this->request->data['problem_data'];
        //セッション書き込み
        $this->Session->write('default_data',$default_data);
        $this->set('default_data',$default_data);
        $category_data=$this->Session->read('category_options');
        $subcategory_data=$this->Session->read('subcategory_options');
        $category_id=$default_data['category_id'];
        $this->set('category_id',$category_id);
        //カテゴリが入力されていない場合の条件文
        if(!empty($category_data[$category_id])){//カテゴリが空でないとき
            $this->set('category',$category_data[$category_id]);
            if(!empty($default_data['subcategory_id'])){//サブカテゴリが空でないとき
                //debug($subcategory_data[$category_id]);
                $this->set('subcategory_id',$default_data['subcategory_id']);
                $this->set('subcategory',$subcategory_data[$category_id][$default_data['subcategory_id']]);
            }else{
                $this->set('subcategory',"");
            }
        }else{
            $this->set('category',"");
            $this->set('subcategory',"");
        }
        //問題作成確認にapiにて成功のときのレスポンスデータを送っている
        if("1"== $default_data['type']){//適切なviewをレンダー
            $this->render('check_select');
        }else{
            $this->render('check_descriptive');
        }
    }
    function record_problem($type=NULL){
        if($this->Session->check('default_data')){
            $record_data=$this->Session->read('default_data');
            $this->set('record_data',$record_data);
            $category_data=$this->Session->read('category_options');
            $subcategory_data=$this->Session->read('subcategory_options');
            $category_id=$record_data['category_id'];
            $category_data[$category_id];
            $url = $this->api_rest("POST","problems/add.json","",$record_data);
            $tmp = $this->Problem->validation($url);
            if(!empty($tmp)){
                $this->set('error_log',$tmp);
                $this->setAction('make_problem',$type);
            }else{
                if($type==2){
                    $this->set('category',$category_data[$category_id]);
                    $this->render('record_descriptive');
                    $this->Session->delete('default_data');
                    //セッションの破棄
                }else{
                    $this->set('category',$category_data[$category_id]);
                    $this->render('record_select');
                    $this->Session->delete('default_data');
                    //セッションの破棄
                }
            }
        }else{
            $this->setAction('make_problem');
        }
    }

}
?>
