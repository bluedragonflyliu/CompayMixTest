<?php 

$numbers=['ford'=>100,'att'=>1000,'ibm'=>10];
function pc_rand_weighted($numbers){
	$total = 0;

	foreach ($numbers as $number => $weight) {
		$total +=$weight;
		//echo $total.'<br/>';
		$distribution[$number] = $total;
	}
	//echo '<pre>';
	//var_dump($distribution);
	$rand = mt_rand(0,$total -1);
	foreach ($distribution as $number => $weights) {
		if ($rand < $weights){
			return $number;
			}
		}
		
	}
	$arr=array();
	for($i=0;$i<1110;$i++){
		$aa = pc_rand_weighted($numbers);
		if(array_key_exists($aa, $arr)){
			$arr[$aa] +=1;
		}else{
			$arr[$aa] = 1;
		}
		
	}
	var_dump($arr);