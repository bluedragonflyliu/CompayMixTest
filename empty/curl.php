<?php 
	$ch = curl_init();
// 2. 设置选项，包括URL
curl_setopt($ch, CURLOPT_URL, "localhost:80/empty/http_range.php");
$http_header =array();
$http_header[] = "Http_Range:bytes=1-4";
//curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
curl_setopt($ch, CURLOPT_RANGE, "1-3/4-7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 3. 执行并获取HTML文档内容
$output = curl_exec($ch);
// 4. 释放curl句柄
curl_close($ch);
echo '<pre>';
var_dump($output);
?>