<?php
print <<< HEAD
<div id="view">
	<div id="pane">
		<img src='../img/kentei_public_answers/signup.png'>
HEAD;
?>
		<dl class="confirm">
			<dt> ユーザ名 </dt>
			<dd> <?php print $this->Session->read("con.User.username"); ?></dd>
			<dt> メールアドレス </dt>
			<dd> <?php print $this->Session->read("con.User.email"); ?></dd>
			<dt> パスワード </dt>
			<dd> パスワードは表示されません。</dd>
		</dl>
		<?php echo $this->Html->link(__($this->Html->image("kentei_public_answers/back.png", array("alt" => "入力画面に戻る")), true), "/users/add?flag=1", array('escape' => false)); ?>
		<?php echo $this->Html->link(__("登録", true), array('action' => 'add_entry'), array('class' => 'forward'), "登録してよろしいですか？"); ?>
		<?php
		print <<< FOOT
	</div>
</div>
FOOT;
		?>