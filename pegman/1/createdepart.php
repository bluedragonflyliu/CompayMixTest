<?php 
	require_once('./access.php');
	$kv = new SaeKV();
	// 初始化SaeKV对象
	$ret = $kv->init(); //访问授权应用的数据
	$access_token = $kv->get('access_token');
	$url = "https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token=".$access_token;
	
	$data = '{"name":"北京工作站","parentid":"1","order":"5","id":"5"}';
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$output = curl_exec ( $ch );
	if (curl_errno($ch)) {
		 print "Error: " . curl_error($ch);
	} else { 
			$result = json_decode($output, true);
			var_dump($result);
		}
	curl_close($ch);

	

?>