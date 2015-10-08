<!-- ◯×問題の結果表示ページ -->
<?php
//正解数を表示
echo '正解数：'.$score.'/10'.$this->Html->tag('br');
echo $this->Html->tag('br');
//回答者が間違えた問題を表示
echo '----間違えた問題----'.$this->Html->tag('br');
for($i = 1; $i <= 10; $i++){
		//問題情報に不正解とある場合
	if($problem[$i]['answer_flag'] == 0){
		echo '['.$i.']';
		echo '問題文：'.$problem[$i]['sentence'].$this->Html->tag('br');
		echo '提示された選択肢：'.$problem[$i]['showed_answer'].$this->Html->tag('br');
		echo '正しい選択肢：'.$problem[$i]['right_answer'].$this->Html->tag('br');
		echo 'あなたの回答：'.$problem[$i]['user_answer'];
		echo $this->Html->tag('br');
		echo $this->Html->tag('br');
	}
}