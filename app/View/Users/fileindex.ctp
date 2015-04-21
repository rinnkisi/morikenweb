<?php
foreach ($result as $value) {
	echo "<h3>元の画像</h3>";
	echo $upload->image($value, 'User.item');
	echo "<h3>サムネイル</h3>";
	echo $upload->image($value, 'User.item', array('style' => 'thumb'));
	echo "<hr />";
}
?>