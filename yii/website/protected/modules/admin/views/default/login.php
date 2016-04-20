<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
</head>
<body>
	<?php $form = $this->beginWidget('CActiveForm');?>
	<?php echo $form->textField($loginForm,'username', array('id'=>'username'));?>
	<br />
	<?php echo $form->passwordField($loginForm,'password', array('id'=>'pwd')); ?>
	<br />
	<?php echo $form->passwordField($loginForm,'captcha', array('id'=>'verify')); ?>
	<div id='captcha'>
		<?php
   			 $this->widget('CCaptcha', array('showRefreshButton'=>false, 'clickableImage'=>true, 'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图' ,'style'=>'cursor:pointer' )));

 		?>
	</div>
	<input type='submit' id='sub'value='提交' />
	<?php $form = $this->endWidget();?>
	<ul id='peo'>
		<li class='error'></li>
	</ul>
	<ul id='psd'>
		<li class='error'></li>
	</ul>
	<ul id='ver'>
		<li class='error'><?php echo $form->error($loginForm,'captcha')?></li>
	</ul>
</body>
</html>