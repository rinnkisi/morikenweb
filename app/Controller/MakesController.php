<?php

class MakesController extends AppController {

        public $name = 'Makes'; //クラス名
        function make4(){//選択式作問入力
            //APIができたら差し替える
                $type = 1; //初期は1 選択式問題
                $this->set('type',$type);
                $ctInfo = "盛岡の歴史"; //カテゴリ情報
                $this->set('ctInfo',$ctInfo); //0=>選択フォーム用
                $this->set('sbctInfo',"サブカテゴリ"); //連プル
                $ptData = "ポイントに関する情報"; //ポイントに関する情報
                $this->set('rate',1); //ポイントのレート情報
                //api_rest($method, $uri, $query = null, $data = null)
                $name = array("kentei_id"=>1,"user_id"=>1);

                $url = $this->api_rest("POST","problems/add.json","",$name);
                //$url = 'http://sakumon.jp/app/LK_API/evaluateComments/index.json';
                //$url = json_decode($url,true);
                             //APIの実行
                //var_dump($url);
                debug($url);
        }
        function make1(){//記述式作問入力
            //APIができたら差し替える
                $type = 2; //初期は1 選択式問題
                $this->set('type',$type);
                $ctInfo = "盛岡の歴史"; //カテゴリ情報
                $this->set('ctInfo',$ctInfo); //0=>選択フォーム用
                $this->set('sbctInfo',"サブカテゴリ"); //連プル
                $ptData = "ポイントに関する情報"; //ポイントに関する情報
                $this->set('rate',1); //ポイントのレート情報
        }
        function testview(){
            debug($this->request->data);
            $makes=$this->Make->find('all');
            debug($makes);
            $this->Make->save($this->request->data);
        }
}
?>
