<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>创建tag</title>
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
	$data = '{"tagname": "manger","tagid": id}';
	$url = 'https://qyapi.weixin.qq.com/cgi-bin/tag/create?access_token='.$access_token;
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$output = curl_exec($ch);
	if (curl_errno($ch)) {
		 print "Error: " . curl_error($ch);
	} else { 
			$result = json_decode($output, true);
			var_dump($result);
		}

	$url = 'https://qyapi.weixin.qq.com/cgi-bin/tag/list?access_token='.$access_token;
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$output = curl_exec($ch);
	if (curl_errno($ch)) {
		 print "Error: " . curl_error($ch);
	} else { 
			$result = json_decode($output, true);
			var_dump($result);
	}
	curl_close($ch);
?>

</body>
</html>
