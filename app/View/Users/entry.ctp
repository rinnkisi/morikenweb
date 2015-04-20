<?php
print <<< HEAD
<script type="text/javascript"> 
	window.onload = function(){
		alert("登録が完了しました。入力したユーザ名とパスワードでログインしてください。");
		location.replace("../../index.php");
	}
</script>
<div id="view">
	<div id="pane">
		<img src='../img/kentei_public_answers/signup.png'>
HEAD;
?>
		<h1> 登録完了しました！</h1>
<?php
	print <<< FOOT
	</div>
</div>
FOOT;
?>