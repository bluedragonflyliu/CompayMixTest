<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>foreach 引用</title>
</head>
<body>
	<?php 
		$arr = array('zhangsan','lisi','wangwu','maliu');
		foreach ($arr as  &$value) {
			$value .=1;
		}
		echo '<pre>';
		var_dump($arr);
	?>
</body>
</html>