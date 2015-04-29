<?php

class MakesController extends AppController {

        public $name = 'Makes'; //クラス名
        function make4(){//選択式作問入力
                //api_rest($method, $uri, $query = null, $data = null)
                //typeを追加する。１は選択式問題。初期は選択式問題
                $this->set('type',"1");
        }
        function make1(){//記述式作問入力
            //APIができたら差し替える
                //2は記述式問題
                $this->set('type',"2");
        }
        function makecheck(){
                $url = $this->api_rest("POST","problems/add.json","",$this->request->data);
                //API経由でDBに格納を行う
                $this->set('data',$url);
                //問題作成確認にapiにて成功のときのレスポンスデータを送っている
        }
}
?>
