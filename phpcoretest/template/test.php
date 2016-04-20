<?php
	include 'template.php';
	$tpl = new template(array('php_turn'=>true, 'debug'=>true));
	$tpl -> assign('data','hellow world');
	$tpl -> assign('person','cafeCAT');
	$tpl -> assign('pai',3.14);
	$arr = array(1,2,3,4,'hahattt',6);
	$tpl -> assign('b',$arr);
	$tpl -> show('test');

?>