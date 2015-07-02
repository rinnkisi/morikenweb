<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link rel="stylesheet" href="../flexslider.css" type="text/css" />
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" charset="utf-8">
	$(window).load(function() {
	$('.flexslider').flexslider();
	$('.flexslider').css('width', '600');
	  $('.flexslider').css('height', '350');
	  $('.flexslider .slides li img').css('width', '600');
	  $('.flexslider .slides li img').css('height', '350');
	});
	</script>

</head>
<body>
	<div id="container">
		<div id="header">
			<div class="header_weaper">
				<h1>もりけんwebクイズ</h1>
				<div class="header_l01">
					<a href="#">HOME</a>
				</div>
				<div class="header_l01">
					<a href="#">模擬テスト</a>
					<!-- <a href="#"><img src=./img/head2.png style="border:solid 5px #fff"></a> -->
				</div>
				<div class="header_l01">
					<a href="#">作問</a>
					<!-- <a href="#"><img src=./img/head3.png style="border:solid 5px #fff"></a> -->
				</div>
				<div class="header_r02">
					<a href="#">評価</a>
					<!-- <a href="#"><img src=./img/head4.png style="border:solid 5px #fff"></a> -->
				</div>
				<div class="header_r01">
					<a href="#">ランキング</a>
					<!-- <a href="#"><img src=./img/head5.png style="border:solid 5px #fff"></a> -->
				</div>
			</div>
			<div class="header_color"></div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<div id="footer_weaper">
				<div class="footer_top">
					<ul>
						<li><a href="#">HOME</a></li>|
						<li><a href="#">模擬テスト</a></li>|
						<li><a href="#">問題を作成</a></li>|
						<li><a href="#">問題を評価</a></li>|
						<li><a href="#">ランキング</a></li>
					</ul>
				</div>
				<div class="footer_main_l">
					もりけんwebクイズ
				</div>
				<div class="footer_main_r">
					<ul>
						<li>主催：盛岡商工会議所</li>
						<li>開発：岩手県立大学ソフトウェア情報学部IS(佐々木)研</li>
					</ul>
				</div>
				<div class="footer_main_r02">
					<ul>
					<li>TEL:019-624-5880</li>
					<li>FAX:019-654-1588</li>
					<li>E-mail:aaa@aaa.com</li>
				</ul>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
