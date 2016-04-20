<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>获取agent应用</title>
</head>
<style type="text/css">
	table{
		width:400px;
	}
	tr{	
		text-align: center;
	}
</style>
<body>
	<?php 
	require_once('./access.php');
	$kv = new SaeKV();

	$ret = $kv->init(); //访问授权应用的数据
	$access_token = $kv->get('access_token');
	$ch = curl_init ();
	// 初始化SaeKV对象

	$url = 'https://qyapi.weixin.qq.com/cgi-bin/agent/list?access_token='.$access_token;
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	$output = curl_exec($ch);
	if (curl_errno($ch)) {
		 print "Error: " . curl_error($ch);
	} else { 
			echo '<pre>';
			$result = json_decode($output, true);
			var_dump($result);
	}
	curl_close($ch);
?>

</body>
</html>
