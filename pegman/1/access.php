<?php 

//******************

$corpId = "wxa8d6419df2e03d86";
$Secret = '9b0Yq02vDmxT_uJvD_0fGjNx9rlnoVe728-VOJDz0eFn-7lR4go3iNaGGHfDdwV5';
$kv = new SaeKV();

// 初始化SaeKV对象
$ret = $kv->init(); //访问授权应用的数据

$begin_time = $kv->get('begin_time');

if(empty($access_token) || (time()+30-$begin_time) > 7200) {
	$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . $corpId . "&corpsecret=" .$Secret;
	$ch  = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);

	if (curl_errno($ch)) 
	{ 
	    print "Error: " . curl_error($ch); 
	} else { 
	    // Show me the result 
		$result 	  = json_decode($output, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
		$access_token = $result['access_token'];
		$begin_time	  =	time();
		$expires	  = $result['expires_in'];
		$kv ->set('begin_time',$begin_time);
		// 更新key-value
		$ret = $kv->set('access_token', $access_token);
		echo ($access_token).'<br />';
	} 
	curl_close($ch);
} else {
	$access_token = $kv->get('access_token');
	echo ($access_token).'<br />';
}
 
//******************

?>