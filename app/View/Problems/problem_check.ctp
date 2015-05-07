<!-- 四択式問題作成のチェックをするページ -->
以下の内容で登録しました
</BR>
<?php
if($data['response']['Problem']['type']==1){
//選択式問題の時
?>
	[問題文]： <?php echo $data['response']['Problem']['sentence'];?>
	</BR>
	答え[選択肢１]-<?php echo $data['response']['Problem']['right_answer'];?>
	</BR>
	[選択肢２]-<?php echo $data['response']['Problem']['wrong_answer1'];?>
	</BR>
	[選択肢３]-<?php echo $data['response']['Problem']['wrong_answer2'];?>
	</BR>
	[選択肢４]-<?php echo $data['response']['Problem']['wrong_answer3'];?>
	</BR>
	タグ：<?php echo $data['response']['Problem']['tag'];?>
	</BR>
	<a href="make4">戻る</a>
<?php
}else{//記述式問題の場合の時(typeが２の時)
?>
	[問題文]： <?php echo $data['response']['Problem']['sentence'];?>
	</BR>
	答え：<?php echo $data['response']['Problem']['right_answer'];?>
	</BR>
	タグ：<?php echo $data['response']['Problem']['tag'];?>
	</BR>
	<a href="make1">戻る</a>
<?php

}
?>

