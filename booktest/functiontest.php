<?php 
/*function mean() {
	$sum = 0;
	$size = func_num_args();
	for($i = 0; $i < $size; $i++){
		$sum += func_get_arg($i);
	}
	$average = $sum /$size;
	return $average;
}
$mean = mean(96, 93, 79);
echo $mean;
*/
echo '<pre>';
function &pc_array_find_value($needle, &$haystack){
	foreach ($haystack as $key => $value) {
		if($needle == $value) {
			return $haystack[$key];
		}
	}
}
$minnesota = array('Bob Dylan', 'F. Scott Fitzgerald', 'Prince', 'Charles Schultz');

$prince = & pc_array_find_value('Prince', $minnesota);
$prince = '0(+>';
print_r($minnesota);

function pc_array_find_value2($needle, &$haystack){
	foreach ($haystack as $key => $value) {
		if($needle == $value) {
			return $key;
		}
	}
}
$minnesota = array('Bob Dylan', 'F. Scott Fitzgerald', 'Prince', 'Charles Schultz');

$prince = pc_array_find_value2('Prince', $minnesota);
$minnesota[$prince] = '0(+->';
print_r($minnesota);

echo '<hr />';
$num  =  5 ;
 $location  =  'tree' ;
 
$format  =  'There are %d monkeys in the %s' ;
echo  sprintf ( $format ,  $num ,  $location );
echo '<hr />';
function logf(){
	$date = date(DATE_RSS);
	$args = func_get_args();
	return print "$date: " .call_user_func_array('sprintf',$args)."<br />";

}
logf('<a href="%s">%s</a>','http://developer.baidu.com','baidu developer program');
echo '<hr />';
$dispatch = array(
					'add'		=> 'do_add',
					'commit'	=> 'do_commit',
					'checkout'	=> 'do_checkout',
					'update'	=> 'do_update'
				);
$cmd = (isset($_REQUEST['command'])? $_REQUEST['command']:'');
if (array_key_exists($cmd,$dispatch)) {
	$function = $dispatch[$cmd];
	call_user_func($function);
} else {
	error_log("Unknow command $cmd");
}
function do_add(){
	echo 'function add have triggle';
}
?>