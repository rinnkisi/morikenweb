<?php
class ProblemsController extends AppController{
    public $name = 'Problems';
    public $uses = array('Evaluate','Problem');
    public $components = array('Session');
    public function index(){
    }
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
        if("1"== $default_data['type']){
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
    // ユーザが作問した問題を一覧表示
    public function show_evaluation_problem(){
        $this->Session->destroy();
        // $api_urlは後に定数化
        $api_url = 'problems/index.json';
        // 非公開問題
        $priv_api_pram = 'kentei_id=1&employ=0&public_flag=0&category_id=0&item=100';
        $show_obj['priv'] = $this->get_api_data($api_url,$priv_api_pram);
        // 公開問題
        $publ_api_pram = 'kentei_id=1&employ=0&public_flag=1&category_id=0&item=100';
        $show_obj['publ'] = $this->get_api_data($api_url,$publ_api_pram);
        $this->set('show_obj',$show_obj);
    }
    // 選択した問題への評価とコメント
    public function check_evaluation_problem($id){ //making question ID
        // 選択した問題のID
        $check_obj['problem_id'] = $id;
        // 評価項目呼び出し
        // $api_urlは後に定数化
        $api_url = 'evaluateItems/index.json';
        $check_obj['evaluate_items'] = $this->get_api_data($api_url,'kentei_id=1');
        $this->set('data',$check_obj);
    }
    // 登録前に評価・コメントの内容を確認
    public function precheck_evaluation_problem(){
        $eval_cont = $this->request->data;
        $arrange_eval_data['Problems'] = $this->Evaluate->eval_cont_arrange($eval_cont);
        $arrange_eval_data['Problem_info']['id'] = $eval_cont['Problem_info']['id'];
        $this->set('arrange_eval_data',$arrange_eval_data);
    }
    // 評価登録機能'kentei_id=1'
    public function add_evaluation_problem(){
        // ログイン機能とは未連結、ユーザIDはダミー
        $eval_data = $this->request->data;
        // debug($eval_data);
        foreach ($eval_data['Problems'] as $eval_id => $eval_value){
            // user_idは、後でログイン機能から受け取る
            $add_api_pram[$eval_id]['evaluate_item_id'] = $eval_id;
            $add_api_pram[$eval_id]['problem_id'] = $eval_data['Problem_info']['id'];
            $add_api_pram[$eval_id]['user_id'] = 7;
            $add_api_pram[$eval_id]['evaluate_comment'] = $eval_value['comment'];
            if($eval_value['check'] == 1)
                $result[$eval_id] = $this->post_evaluateComments_api($add_api_pram[$eval_id]);
        }

        if(!empty($result)){
            foreach($result as $evaluate_result_id => $evaluate_result_value){
                if(!empty($evaluate_result_value['error']['code'])){
                    foreach ($eval_data['Problems'] as $evaluate_id => $evaluate_value){
                        if($evaluate_result_id == $evaluate_id)
                            $error_list[$evaluate_result_id] = $evaluate_value['name'];
                    }
                }
            }
        }else{
            $this->redirect('show_evaluation_problem');
        }
        if(!empty($error_list)){
            $this->Session->write('evaluation.error_list',$error_list);
            $this->Session->write('evaluation.Problem_id',$eval_data['Problem_info']['id']);
            $this->redirect('check_again_evaluation_problem');
            // $this->check_again_evaluation_problem($error_list);
        }else{
            $this->redirect('show_evaluation_problem');
        }
    }
    // add_ecaluatetion_problemからerror_listを受け渡し、コメントを催促・入力
    public function check_again_evaluation_problem(){
        $check_again_data['error_list'] = $this->Session->read('evaluation.error_list');
        $check_again_data['Problem_id'] = $this->Session->read('evaluation.Problem_id');
        $this->set('check_again_data',$check_again_data);
        debug($check_again_data);
    }
    // 評価履歴の一覧を表示
    public function show_evaluation_history(){
        // $api_urlは後に定数化
        $api_url = 'evaluateComments/index.json';
        $eval_record = $this->get_api_data($api_url,'user_id=7');
        $arrange_eval_data = $this->Evaluate->eval_record_arrange($eval_record);
        $this->set('arrange_eval_data',$arrange_eval_data);
    }
    // 作問者に対しての評価機能
    public function notice_evaluation(){
        $this->Session->destroy();
        // user_idのパラメータは後ほど変更
        $problem_api_pram = 'kentei_id=1&employ=0&user_id=12&item=100&public_flag=0';
        // $api_urlは後に定数化
        $api_url = 'problems/index.json';
        $problem_api_value = $this->get_api_data($api_url,$problem_api_pram);
        // view用に連想配列の中身を整える
        $arrange_notice_data = $this->Evaluate->arrange_notice_info($problem_api_value);
        if(empty($arrange_notice_data['not_found_flug'])){
            $this->set('notice_data',$arrange_notice_data);
        }else{
            $this->redirect('not_found_data');
        }
    }
    // notice_evaluation()で選択した問題・評価の詳細を見る
    public function confirm_evaluation($problem_id){
        if(!empty($problem_id)){
          // user_idのパラメータは後ほど変更
            $problem_api_pram = 'kentei_id=1&employ=0&user_id=12&item=100&public_flag=0';
            // $api_urlは後に定数化
            $api_url = 'problems/index.json';
            $problem_api_value = $this->get_api_data($api_url,$problem_api_pram);
            // notice_evaluation()で用いたデータを再現
            $arrange_notice_data = $this->Evaluate->arrange_notice_info($problem_api_value);
            // $api_urlは後に定数化
            $api_url = 'evaluateItems/index.json';
            $evaluate_item = $this->get_api_data($api_url,'kentei_id=1');
            // view用に連想配列の中身を整える
            $arrange_confirm_data = $this->Evaluate->arrange_confirm_info($arrange_notice_data,$problem_id,$evaluate_item);
            $this->Session->write('evaluation.confirm_data',$arrange_confirm_data);
            $this->Session->write('evaluation.problem_id',$problem_id);
            $this->set('confirm_data',$arrange_confirm_data);
        }else{
            $this->redirect('not_found_data');
        }
    }
    // confirm_evaluation()で容認ボタンを押したときの処理
    public function accept_evaluation($evaluate_id){
        $confirm_data = $this->Session->read('evaluation.confirm_data');
        $accept_data['arrange_data'] = $this->Evaluate->arrange_judge_info($confirm_data,$evaluate_id);
        $this->Session->write('evaluation.confirm_data.selected_data',$accept_data['arrange_data']['Evaluate']);
        $this->set('accept_data',$accept_data);
    }
    // confirm_evaluation()で否認ボタンを押したときの処理
    public function deny_evaluation($evaluate_id){
        $confirm_data = $this->Session->read('evaluation.confirm_data');
        $deny_data['arrange_data'] = $this->Evaluate->arrange_judge_info($confirm_data,$evaluate_id);
        $this->Session->write('evaluation.confirm_data.selected_data',$deny_data['arrange_data']['Evaluate']);
        $this->set('deny_data',$deny_data);
    }
    // accept_evaluation()/deny_evaluation()で入力された確認コメントを登録
    public function add_confirm_comment(){
        $confirm_data = $this->request->data;
        $evaluate_id = $confirm_data['Problems']['evaluate_id'];
        $api_pram['confirm_comment'] = $confirm_data['Problems']['confirm_comment'];
        if(!empty($confirm_data['deny'])){
            $api_pram['confirm_flag'] = 3;
        }else if(!empty($confirm_data['accept'])){
            $api_pram['confirm_flag'] = 2;
        }
        $result = $this->put_confirmComments_api($api_pram,$evaluate_id);
        // APIの結果を使ってバリデート
        if(empty($result['error']['code'])){
            $this->Session->delete('evaluation.confirm_data');
            $problem_id = $this->Session->read('evaluation.problem_id');
            $this->redirect(array('action' => 'confirm_evaluation',$problem_id));
        }else{
            $evaluate_id = $this->Session->read('evaluation.confirm_data.selected_data.evaluate_id');
            $this->Session->write('evaluation.selected_data.error_flag',1);
            if(!empty($confirm_data['accept'])){
                $this->Session->setFlash('承認コメントを入力してください');
                $this->redirect(array('action' => 'accept_evaluation',$evaluate_id));
            }elseif(!empty($confirm_data['deny'])){
                $this->Session->setFlash('否認コメントを入力してください');
                $this->redirect(array('action' => 'deny_evaluation',$evaluate_id));
            }
        }
    }
    // どのAPIメソッドを使うかは$urlで判断する
    // $api_pramのパラメータでAPIを叩く
    public function get_api_data($url,$api_pram){
        $api_obj = $this->api_rest('GET',$url,$api_pram,array());
        return $api_obj;
    }
    // パラメータの内容で evaluateComments/add.json API にpostする
    public function post_evaluateComments_api($api_pram){
        $api_result = $this->api_rest('POST','evaluateComments/add.json', null ,$api_pram);
        return $api_result;
    }
    // パラメータの内容で evaluateComments/add.json API にpostする
    public function put_confirmComments_api($api_pram,$evaluate_id){
        $api_result = $this->api_rest('PUT','evaluateComments/edit/'.$evaluate_id.'.json',null,$api_pram);
        return $api_result;
    }
    public function not_found_data(){}


//◯×問題のトップページ
    public function top_true_false(){}

//APIを使っての過去問取得関数
    public function get_problems_true_false(){
        $this->Session->delete('score');
        $this->Session->delete('show_count');
        $this->Session->delete('problem');
        $this->Session->delete('get_problems');
        //公開されている過去問10問をAPIを使って取得
        $api_url = 'problems/index.json';
        $api_pram = 'kentei_id=1&item=10&public_flag=1';
        $get_problems = $this->api_rest('GET', $api_url, $api_pram, array());
        //◯×問題の正解数
        $this->Session->write('score', 0);
        //回答チェックページの読み込み回数
        $this->Session->write('show_count', 1);
        //取得した過去問をセッションに代入
        $this->Session->write('get_problems', $get_problems);
        //結果表示の際に必要な問題情報を格納するためのセッション
        $this->Session->write('problem', null);
        //問題回答ページへのリダイレクト
        $this->redirect(array('action' => 'answer_true_false'));
    }

//◯×問題の問題回答ページ
    public function answer_true_false(){
        $show_count = $this->Session->read('show_count');
        $get_problems = $this->Session->read('get_problems');
        $problem = $this->Session->read('problem');
        //提示する選択肢を決定するための乱数を生成し代入
        $random = mt_rand(0, 3);
        //過去問の問題文を問題情報を扱うセッションに代入
        $problem[$show_count]['sentence'] = $get_problems['response']['Problems'][$show_count - 1]['Problem']['sentence'];
        //過去問の正しい選択肢を問題情報を扱うセッションに代入
        $problem[$show_count]['right_answer'] = $get_problems['response']['Problems'][$show_count - 1]['Problem']['right_answer'];
        if($random == 0){
            //過去問の正しい選択肢を問題情報を扱うセッションに代入
            $problem[$show_count]['showed_answer'] = $get_problems['response']['Problems'][$show_count - 1]['Problem']['right_answer'];
        }
        if($random == 1){
            //過去問の誤答選択肢１を問題情報を扱うセッションに代入
            $problem[$show_count]['showed_answer'] = $get_problems['response']['Problems'][$show_count - 1]['Problem']['wrong_answer1'];
        }
        if($random == 2){
            //過去問の誤答選択肢２を問題情報を扱うセッションに代入
            $problem[$show_count]['showed_answer'] = $get_problems['response']['Problems'][$show_count - 1]['Problem']['wrong_answer2'];
        }
        if($random == 3){
            //過去問の誤答選択肢３を問題情報を扱うセッションに代入
            $problem[$show_count]['showed_answer'] = $get_problems['response']['Problems'][$show_count - 1]['Problem']['wrong_answer3'];
        }

        $this->Session->write('problem', $problem);

        $this->set('problem', $problem);
        $this->set('random', $random);
        $this->set('show_count', $show_count);
    }

//◯×問題の回答チェックページ
    public function check_answer_true_false(){
        $show_count = $this->Session->read('show_count');
        $score = $this->Session->read('score');
        $problem = $this->Session->read('problem');

        $problem[$show_count]['user_answer'] = $this->request->data['answer']['user_answer'];
        $random = $this->request->data['answer']['random'];

        //正解の時
        //正解の選択肢が提示されていて回答者が◯を選択した場合
        if($random == 0 && $problem[$show_count]['user_answer'] == '◯'){
            //正解数に１追加
            $score++;
            $this->Session->write('score', $score);
            //１を代入
            $problem[$show_count]['answer_flag'] = 1;
            //誤答選択肢が提示されていて回答者が×を選択した場合
            if($random != 0 && $problem[$show_count]['user_answer'] == '×'){
                $score++;
                $this->Session->write('score', $score);
                $problem[$show_count]['answer_flag'] = 1;
            }
        //不正解の時
        }else{
            //0を代入
            $problem[$show_count]['answer_flag'] = 0;
        }
        $this->Session->write('problem', $problem);
        //ページを読み込んだ回数に１加える
        $show_count++;
        $this->Session->write('show_count', $show_count);
        //ページを読み込んだ回数が10回を超えた場合
        if($show_count > 10 ){
            //◯×問題の結果表示ページへのリダイレクト
            $this->redirect(array('action' => 'show_result_true_false'));
        }
        //問題回答ページへのリダイレクト
        $this->redirect(array('action' => 'answer_true_false'));
    }
    
//◯×問題の結果表示ページ
    public function show_result_true_false(){
        $score = $this->Session->read('score');
        $show_count = $this->Session->read('show_count');
        $problem = $this->Session->read('problem');

        $this->set('score', $score);
        $this->set('show_count', $show_count);
        $this->set('problem', $problem);

        $this->Session->delete('score');
        $this->Session->delete('show_count');
        $this->Session->delete('problem');
        $this->Session->delete('get_problems');
    }
}
?>
