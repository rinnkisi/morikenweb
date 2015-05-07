<?php
	echo $this->Form->create('csv', array( 'type'=>'> text', 'enctype' => 'multipart/form-data', 'url'=>'/makes/problemcheck'));
	echo $this->Form->hidden('kentei_id', array('value'=>'1'));
	//kentei_idにはWebなので１を代入
	echo $this->Form->hidden('user_id', array('value'=>'12'));
	//特にuser_idはその人によって変更しなければいけない。
	echo $this->Form->hidden('grade', array('value'=>'0'));
	//変更余地あり。
	echo $this->Form->hidden('number', array('value'=>'0'));
	echo $this->Form->hidden('public_flag', array('value'=>'0'));
	//オリジナル問題の為初期値を０に設定
	echo $this->Form->hidden('type', array('value'=>"<?php echo $type;?>"));
	//type送信
	echo $this->Form->hidden('category_id', array('value'=>"1"));
	//カテゴリid送信
	echo $this->Form->hidden('item', array('value'=>"1"));
	//item送信
	echo "[選択式問題作成] *は必須項目です";
	echo $this->Html->link('記述式問題作成に切り替え',
		array('controller' => 'Problems', 'action' => 'make1', 'full_base' => true)
	);
	echo "</br>カテゴリ*";
	/*
	<select name="category" required="requied">
		<option value=""></option>
		<option value="選択肢2">選択肢2</option>
		<option value="選択肢3">選択肢3</option>
	</select>
	*/
	var_dump($data_category);
	echo "[この投稿で◯ポイント獲得] / サブカテゴリ";
	echo $this->Form->input('カテゴリ', array(
		'name' =>'category',
	    'options' => array(1, 2, 3, 4, 5),
	    'empty' => ''
	));
	echo $this->Form->input('サブカテゴリ', array(
		'name' =>'subcategory',
	    'options' => array(1, 2, 3, 4, 5),
	    'empty' => ''
	));
	echo "</br>(カテゴリがわからないときは「その他」を選択してください)</br>";
	echo "問題文* [ 最大70 文字 ]</br>";
	echo $this->Form->textarea('sentence');
	echo "</br></br>選択肢の設定*</br></br>";
	echo $this->Html->para(null, "正解選択肢１".$this->Form->textarea('right_answer'));
	echo $this->Html->para(null, "誤答選択肢１".$this->Form->textarea('wrong_answer1'));
	echo $this->Html->para(null, "誤答選択肢２".$this->Form->textarea('wrong_answer2'));
	echo $this->Html->para(null, "誤答選択肢３".$this->Form->textarea('wrong_answer3'));
    echo "写真を載せる場合は以下から登録 (200kb以下、JPEG および PNG画像)";
    echo $this->Html->image('cake_logo.png', array('alt' => 'CakePHP'));
    echo $this->Form->input('',array(
    'type' => 'file',
    'name' => 'image'
	));
    echo "タグ(複数タグは半角「/」で区切り 例:盛岡/岩手/川)";
	echo $this->Form->text('tag');
	echo $this->Html->para(null, "</br>解説* (メモ、参考URL、文献等)".$this->Form->textarea('description'));
    echo $this->Form->submit(('この内容で送信する'));
    echo $this->Form->end();
    echo "</br>";
	echo $this->Html->link('戻る',
		array('controller' => 'Problems', 'action' => 'top', 'full_base' => true)
	);
?>