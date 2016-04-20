<?php 
// $data = file_get_contents("php://input");
$data = $_POST["myList"];
foreach ($data as $key => $value) {
	echo $value."\n";
}

?>