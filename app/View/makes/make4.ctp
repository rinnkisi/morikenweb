<?php //echo $this->form($type,$form,$ctInfo,$sbctInfo,$users,null);?>

<div id ="view">
	<?php
	echo $this->Form->create('csv', array( 'type'=>'> text', 'enctype' => 'multipart/form-data', 'url'=>'/makes/make3'));
?>
<input type="hidden" name="ID" value="1"></input>
	[選択式問題作成] *は必須です記述式問題作成に切替</BR>
	カテゴリ*
	<select id="ID" name="データ１" required="requied">
		<option value=""></option>
		<option value="選択肢2">選択肢2</option>
		<option value="選択肢3">選択肢3</option>
	</select>
	[この投稿で
	◯
	ポイント獲得] / サブカテゴリ
	<select id="ID" name="データ" required="requied">
		<option value=""></option>
		<option value="選択肢2">選択肢2</option>
		<option value="選択肢3">選択肢3</option>
	</select>
	</BR>
	(カテゴリがわからないときは「その他」を選択してください)
	</BR>
	問題* [ 最大70 文字 ]
	</BR>
	<textarea id="ProblemSentence" name = "mondai" cols="90" rows="2"></textarea>
	</BR>
選択肢の設定*
	</BR>
	<p>
１<textarea id="ProblemSentence" name = "choice1"rows="2" cols="90"></textarea>
	</p>
	<p>
２<textarea id="ProblemSentence" name = "choice2"rows="2" cols="90"></textarea>
	</p>
	<p>
３<textarea id="ProblemSentence" name = "choice3"rows="2" cols="90"></textarea>
	</p>
	<p>
４<textarea id="ProblemSentence" name = "choice4"rows="2" cols="90"></textarea>
	</p>
正解番号*
<select id="ProblemAnswerChoice" name="answerChoice" required="required">
    <option value=""></option>
    <option value="1">
        1
    </option>
    <option value="2">
        2
    </option>
    <option value="3">
        3
    </option>
    <option value="4">
        4
    </option>
</select>
</BR>
    写真を載せる場合は以下から登録 (200kb以下、JPEG および PNG画像)
<input id="ProblemImage" type="file" name="image"></input>
    タグ(複数タグは半角「/」で区切り 例:盛岡/岩手/川)
<input id="ProblemKeyword" type="text" name="keyword"></input>
問題の有効期限を設定する
<input id="limit" type="checkbox" name="limit"></input>
<select id="ProblemLimitTimeYear" name="data[Problem][limitTime][year]">
    <option value=""></option>
</select>
-
<select id="ProblemLimitTimeMonth" name="data[Problem][limitTime][month]"></select>
-
<select id="ProblemLimitTimeDay" name="data[Problem][limitTime][day]"></select>
</BR>
解説* (メモ、参考URL、文献等)
<textarea id="ProblemExplanation" required="required" cols="80" rows="4" name="explanation"></textarea>
<?php
    echo $this->Form->submit( ('この内容で送信する'));
    echo $this->Form->end();
?>
</BR>
<a id="back" href="top"><img src="../img/kentei_public_answers/back.png" /></a>
</div>
