<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		$str = '2015-08-10 10:20:30';
		$time = $create_ts =strtotime(date('Y-m-d',strtotime($str)));
		echo $time;
		echo '<br>';
		echo time();
		echo '<br>';
		echo $time+3600;

	 ?>
</body>
</html>