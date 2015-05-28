<?php
	echo "ユーザーのIDが入る";
	echo "さんが作問した問題一覧<br />";
	echo "●未投稿　●評価待ち　●調整中　●公開済み<br /><br />";
	echo "未投稿問題</br>";
	echo "";
	foreach ($show_data as $key => $show_data):
	echo "[".$key."]： ".$this->Html->link($show_data['Problem']['sentence'],
		array('controller' => 'problems', 'action' => 'index', $show_data['Problem']['id']));
	echo "<br />";
	endforeach;
?>