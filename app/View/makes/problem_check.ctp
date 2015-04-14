<h3>問題の詳細</h3>
<ul id="makeqcheck">
<?php
	
	echo $kentei->detail($data,$categoryName,$subcategoryName,$image);

	echo "<li class='qcheck2'>\n";
	if(empty($data['Problem']['validityFlag'])){	//未投稿問題の場合は編集とかが可能　validityFlag=0
		echo  $form->create(null,array('type' => 'post', 'action' => 'update')) . "\n";//編集
		echo  $form->hidden('Problem.id',array('value' => $data['Problem']['id'])) . "\n";
		echo  $form->hidden('Problem.categoryId',array('value' => $data['Problem']['categoryId'])) . "\n";
		echo  $form->hidden('Problem.subcategoryId',array('value' => $data['Problem']['subcategoryId'])) . "\n";
		echo $form->submit(' ', array('class' => 'doedit'));
    	echo  $form->end() . "\n";
		
		echo  $form->create(null,array('type' => 'post', 'action' => 'update')) . "\n";//問題の投稿
		echo  $form->hidden('Problem.id',array('value' => $data['Problem']['id'])) . "\n";
		echo  $form->hidden('Problem.categoryId',array('value' => $data['Problem']['categoryId'])) . "\n";
		echo  $form->hidden('Problem.subcategoryId',array('value' => $data['Problem']['subcategoryId'])) . "\n";
		echo  $form->hidden('Problem.validityFlag',array('value' => $data['Problem']['validityFlag'])) . "\n";
		echo $form->submit(' ', array('class' => 'dopost'));
    	echo  $form->end() . "\n";
	}
	
	if($flag == 'on'){
		echo  $form->create(null,array('type' => 'post', 'action' => 'update')) . "\n";//編集
		echo  $form->hidden('Problem.id',array('value' => $data['Problem']['id'])) . "\n";
		echo  $form->hidden('Problem.categoryId',array('value' => $data['Problem']['categoryId'])) . "\n";
		echo  $form->hidden('Problem.subcategoryId',array('value' => $data['Problem']['subcategoryId'])) . "\n";
		echo $form->submit(' ', array('class' => 'doedit'));
    	echo  $form->end() . "\n";
	}
	
	echo "</li>\n"; //end of li.qcheck2

	if(!empty($diff)){//過去の変更があれば

		echo "<li class='qcheck3'>\n";
		//echo '<div id="scroll">';
		echo "<hr>変更履歴<br />";
		foreach ($diff as $key => $value) {
			$tmp = $html->link( //<a>
						$value['ProblemDifference']['created'], //表示テキスト
						"../kentei_public_evaluates/diffCheck?id=".$value['ProblemDifference']['id'], //リンクURL
						array('class' => 'connect') //属性
						//"よろしいか"  //確認メッセージ
						);
			echo $html->para('',$tmp); //<p>
		}
		//echo '</div>';
		echo "</li>\n"; //end of li.qcheck3
	}
?>
</ul>

<a id="back" href="show"><img src="../img/kentei_public_answers/back.png" alt="戻る"></a>
