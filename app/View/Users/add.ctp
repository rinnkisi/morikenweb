<?php 
if($this->params['url']['flag'] == 0){//モバイル版
	echo '<div data-role="content"><ul data-role="listview" data-theme="a" data-inset="true"><h1>新規登録</h1>';    
	echo $form->create('User',array('action' => 'add'));
	echo $form->input('username');
	echo $form->input('password');
//	echo $form->hidden('User.createTime',array('value' => date( "Y-m-d H:i:s" )));
	echo $form->hidden('User.lectureId',array('value' => '5170b93d962574d617b9abc08e6d8db9'));
	echo $form->end('add');
	echo '</ul></div>';
}else{

print <<< HEAD
<div id="view">
  <div id="pane">
    <img src='../img/kentei_public_answers/signup.png'>
HEAD;

	echo $form->create('User',array('action' => 'add','url' => '/users/add?flag=1')) . "\n";
	echo $form->input('username', array('required' => 'required')) . "\n";
?>
  <div class="input email required">
	<label for='UserEmail'>E-Mail</label>
    
<?php
	echo $form->text('User.email', array('type' => 'email', 'required' => 'required')) . "\n";
?>
  </div>

<?php
	echo $form->input('password', array('required' => 'required')) . "\n";
	//echo $form->password('User.password', array('required' => 'required')) . "\n";
	echo $form->hidden('User.type',array('value' => '0')) . "\n";//0=解答者,1=作問者,2=評価者,3=作問委員会
	echo $form->hidden('User.lectureId',array('value' => '5170b93d962574d617b9abc08e6d8db9')) . "\n";
	echo $form->end(' ') . "\n";

print <<< FOOT
	<a id="back" href="../../index.php"><img src="../img/kentei_public_answers/back.png" alt="戻る"></a>
  </div>
</div>
FOOT;

/*	echo "<img src='/img/signup.png'>\n";
	echo $form->create('User',array('action' => 'add','url' => '/users/add?flag=1')) . "\n";
	echo $form->input('username') . "\n";
	echo $form->input('email') . "\n";
	echo $form->input('password') . "\n";
	echo $form->hidden('User.type',array('value' => '0')) . "\n";//0=解答者,1=作問者,2=評価者,3=作問委員会
//	echo $form->hidden('User.createTime',array('value' => date( "Y-m-d H:i:s" )));
	echo $form->hidden('User.lectureId',array('value' => '5170b93d962574d617b9abc08e6d8db9')) . "\n";
	echo $form->end('新規登録する') . "\n";*/
}
?>

<script type="text/javascript">
$(function(){
	//バリデーションメッセージ
	$.tools.validator.localize("en", {
		":email"	:	"メールアドレスを正しく入力してください",
		":number"	: 	"数値を正しく入力してください",
		"[required]": 	"必須項目です",
	});
	
	//カスタムバリデーション
	$.tools.validator.fn("[maxlength]", function(input, value){
		var max = input.attr("maxlength");
		
		return value.length <= max ? true : {
			en:"字数オーバーです"
		};
	});
	
	//バリデーションを有効に
	$("form").validator({
		message 	: 	"<div><em/></div>",
		position 	: 	"top center",
		offset 		: 	[0, 24]
	});
});
</script>