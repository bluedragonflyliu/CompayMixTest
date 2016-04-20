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
	$url = 'https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token='.$access_token;
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
	?>
	<table border='1' cellspacing='0'>
	<thead>
		<tr>
			<th>ID</th>
			<th>名称</th>
			<th>父级ID</th>
			<th>order</th>
		</tr>
	</thead>
	<tbody>
	<?php
			foreach ($result['department'] as $key => $value) {
				echo '<tr>';
				echo '<td>'.$value['id'].'</td>';
				echo '<td>'.$value['name'].'</td>';
				echo '<td>'.$value['parentid'].'</td>';
				echo '<td>'.$value['order'].'</td>';
				echo '</tr>';
			}
		}
	curl_close($ch);
?>
</tbody>
</table>
</body>
</html>
