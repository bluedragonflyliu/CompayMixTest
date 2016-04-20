<?php
$url = "http://localhost/php%20coretest/post_output.php";
//echo phpinfo();
$post_data = array(
		"foo" =>"bar",
		"query"=>"php",
		"action"=>"Submit"
	);
//$post_data= http_build_query($post_data);
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$output=curl_exec($ch);

var_dump($output);
curl_close($ch);
?>