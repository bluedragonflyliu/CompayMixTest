<?php 
/*$shmop_key = ftok(__FILE__,'p');
$shmop_id = shmop_open($shmop_key, "c", 0600, 1233);
$population = shmop_read($shmop_id, 0, 0);
$population += ($births + $immigrants - $deaths - $emigrants);
$shmop_bytes_written = shmop_write($shmop_id, $population, 0);
if($shmop_bytes_written != strlen($population)){
	echo "Can't write the all of: $population \n";
}
shmop_close($shmop_id);*/
$a = 'a';
echo $$a;
?>