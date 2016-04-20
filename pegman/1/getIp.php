<?php 
	require_once('./access.php');
	$kv = new SaeKV();
	// 初始化SaeKV对象
	$ret = $kv->init(); //访问授权应用的数据
	$access_token = $kv->get('access_token');
	$url = "https://qyapi.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$access_token;
	$ch  = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	if (curl_errno($ch)) 
	{ 
	    print "Error: " . curl_error($ch); 
	} else { 
		$result = json_decode($output, true);
		foreach($result['ip_list'] as $ip){
			echo $ip.'<br/>';
		}
	}
	curl_close($ch);
?>