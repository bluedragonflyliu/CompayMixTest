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
	$kv = new SaeKV();

	$ret  = $kv->init(); //访问授权应用的数据
	$data = $kv->get('data');
	echo '<br />';
	$msg  =  $kv->get('msg');
	echo $data;
	echo $msg;
?>
</body>
</html>
