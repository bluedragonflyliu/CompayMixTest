<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
		$pattern  =  '/(win)/i';
		$str = 'wind win the window and the window break windows say the wind have win';
		echo preg_replace($pattern, 'doo' ,$str);

	?>
</body>
</html>