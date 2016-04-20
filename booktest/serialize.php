<?php 
$pantry = array('sugar' => '2 lbs. ' , 'butter' => '3 sticks');
$fp = fopen('./tmp/pantry', 'w') or die ("can't open pantry");
fputs($fp,serialize($pantry));
fclose($fp);
?>