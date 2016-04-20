<?php
$url = "http://localhost/php%20coretest/post_output.php";
$post_data = array(
	"upload" => "@C:/xampp/htdocs/php coretest/test.zip",
	);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec($ch);

var_dump($output);
curl_close($ch);