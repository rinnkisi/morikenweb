<?php
if($this->params['url']['flag'] == 0){//モバイル版
/**ログアウトリダイレクト**/
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ".$domain);

	$htmltmp .- '
	<div data-role="content">
		<ul data-role="listview" data-theme="a" data-inset="true">
		<h1>もりけんログイン</h1>   
	';
	// if($session->check('Message.auth'))$htmltmp .= $session->flash('auth');
		if($session->check('Message.auth'))$htmltmp .= $session->flash('auth');
	$htmltmp .= $form->create('User', array('action' => 'login','target' => '_self'));
	$htmltmp .= $form->input('email');
	$htmltmp .= $form->input('password');
	$htmltmp .= $form->end('login');
	$htmltmp .= '
		<a href="add" data-role="button" data-transition="fade" data-theme="a">新規登録</a>
		<p><a target="_self" href="twitter"><IMG src="http://ipu-is-2001-01.jp/kentei/cake/app/webroot/img/darker.png"></a></p>
		<p><a href="http://ipu-is-2001-01.jp/kentei/cake/users/facebook"><img src="http://ipu-is-2001-01.jp/kentei/cake/app/webroot/img/facebook-connect.png" alt="facebookでログイン"></a> </p>';
	$htmltmp .= '
		</ul>
 	</div>
 	<div data-role="footer" class="ui-bar"> 
  		<a href="#" data-role="button" data-icon="info">マニュアル</a> 
  		<a href="#" data-role="button" data-icon="gear">設定</a>
  		<a href="http://112.78.116.195/kentei/jqm/toppage/hyouka.php" data-role="button" data-icon="info">PC版評価ページ</a> 
 	</div>
 	';
}else{

echo "ログインに失敗しました...";
echo '<a href="../../">もどる</a>';

//PC版
	/*echo '<div id="main">';
	echo $form->create('User', array('action' => 'login','target' => '_self'));
	echo "<div>ユーザー名".$form->text('username',array('value' => ''))."</div>";
    echo "<div>パスワード".$form->password('password',array('value' => ''))."</div>";
 	echo $form->submit('ログイン',array('class' => 'submit'));
//  	echo $form->end();
	//echo '<input type="submit" class="submit" value="送信する" />';
  	echo $form->end();
  	echo "</div>";*/
    /*	
	echo '
	<div id="main">
		<form arget="_self" id="UserLoginForm" method="post" action="/kentei/cake/users/login" accept-charset="utf-8">
    		<div>
        		<label>名前</label><br />
        		<input type="text" class="text" size="35" value="" name="username" />
    		</div> 
    		<div>
        		<label>メールアドレス</label><br />
        		<input type="text" class="text" size="35" value="" name="password" />
        	</div>
    		<div>
        		<input type="submit" class="submit" value="送信する" />
    		</div>
		</form>
	</div>
		';*/
}
?>