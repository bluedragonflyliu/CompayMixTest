<?php 
$fp = fopen('./tmp/pantry', 'w');
fputs($fp,addslashes(serialize($a)));
fclose($fp);
$new_cart = unserialize(stripcslashes(file_get_contents('./tmp/pantry')));
$new_cart = unserialize(file_get_contents('./tmp/pantry'));

?>