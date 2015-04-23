<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('DebugKit.Toolbar');
    public $helpers = array(
      'Session',
//      'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
//      'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
//      'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
    );

/**
 * request login API
 *
 * @param $method GET or POST or PUT or DELETE
 * @param $uri json file name(Example Users.json, Problems.json)
 * @param $query If GET method, set query or null
 * @param $data data for push to api or null
 * @return $response response data from api
 */
    public function api_rest($method, $uri, $query = null, $data = null){
        $ch = curl_init();
        $basic_url = "http://sakumon.jp/app/LK_API/";
        $options = array(
            CURLOPT_URL => $basic_url.$uri.'?'.$query,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 120, // タイムアウトは2分にしています
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => http_build_query($data), // URLエンコードして application/x-www-form-urlencoded でエンコード。URLエンコードしないとmultipart/form-dataになる
        );
        curl_setopt_array($ch, $options);
        $response = json_decode(curl_exec($ch), true); // 第2引数をtrueにすると連想配列で返ってくる
        curl_close($ch);
        return $response;
    } 
}
