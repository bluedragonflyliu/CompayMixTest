<?php 
	echo phpversion(),'<br/>';
	function count1 ($aa){
		echo '<pre>';
		var_dump($aa);
		echo '<br/>';
	}
	$aa = array(20,10,30,22);
	count1($aa);
	echo (count($aa));
?>