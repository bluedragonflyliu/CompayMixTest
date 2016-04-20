<?php 
	header('content-type:text/html;charset=utf-8');
	$favorite_foods = array(1=> 'artichokes', 'bread', 'cauliflower', 'deviled eggs');
	$food = 'cauliflower';
	$position = array_search($food, $favorite_foods);
	echo $position.'<hr />';
	function escape_data(&$value, $key){
		$value = htmlentities($value, ENT_QUOTES);
	}
	$names = array('firstname'=>'Baba', 'lastname'=>"O'Riley");
	array_walk ($names ,'escape_data');
	foreach ($names as $name) {
		print "$name\n";
	}
?>