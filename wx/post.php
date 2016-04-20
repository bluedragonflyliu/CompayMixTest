<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>post</title>
</head>
<body>
	<?php 
		echo  file_get_contents("php://input");
	?>
</body>
</html>
