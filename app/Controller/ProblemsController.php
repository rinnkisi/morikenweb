<?php

class ProblemsController extends AppController {

        public $name = 'Problems'; //クラス名
        function problem_select(){//選択式作問入力
                //api_rest($method, $uri, $query = null, $data = null)
                //typeを追加する。１は選択式問題。初期は選択式問題
                $this->set('type',"1");
                //Webの場合は１を代入する
                $cate_api_pram = 'kentei_id=1';
                //カテゴリーAPIを使用
                $categories = $this->api_rest("GET","categories/index.json",$cate_api_pram,array());
                foreach ($categories['response']['Categories'] as $key => $value) {
                    $category_select[$key]=$value['Category']['name'];
                    $subcategory_select[]=$value['Subcategory']['name'];
                }
                $this->set('data_category',$category_select);
                $this->set('data_subcategory',$subcategory_select);
        }
        function problem_descriptive(){//記述式作問入力
                //2は記述式問題
                $this->set('type',"2");
        }
        function problem_check(){
                $url = $this->api_rest("POST","problems/add.json","",$this->request->data);
                //API経由でDBに格納を行う
                $this->set('data',$url);
                //問題作成確認にapiにて成功のときのレスポンスデータを送っている
        }
}
?>
