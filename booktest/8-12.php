<?php 
header('Content-type:text/html;charset=utf-8');
$browser = get_browser();
echo '<pre>';
var_dump($browser);
if ($browser->frames) {

} else if ($browser->tables){

} else {

}


?>