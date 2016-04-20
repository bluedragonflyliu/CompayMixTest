<?php
	function testa(&$test){
		$test++;
		return $test;
	};
	$aa = 2;
	echo testa ($aa);

?>