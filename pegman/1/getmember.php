<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>获得部门列表</title>
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
	// 初始化SaeKV对象

	$url = 'https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token='.$access_token.'&department_id=1&fetch_child=1&status=0';
	$ret = $kv->init(); //访问授权应用的数据
	$access_token = $kv->get('access_token');
		$ch = curl_init ();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	if (curl_errno($ch)) {
		 print "Error: " . curl_error($ch);
	} else { 
			$result = json_decode($output, true);
	
			foreach ($result['userlist'] as $key => $value) {
				echo '<pre>';
				var_dump($value);
			}
		}
	curl_close($ch);
?>

</body>
</html>
