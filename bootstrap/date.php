<?php 
	/*$gte = strtotime(date('Ymd'));
	$lte = $gte+24*3600-1;
	echo $gte;
	echo '<br/>';
	echo $lte;
	echo '<br/>';
	echo ($lte-$gte+1)/3600;*/

	$a=array("a"=>"Cat","b"=>"Dog","c"=>"Cat");
	$b=count(array_unique($a));
	var_dump($b);

?>