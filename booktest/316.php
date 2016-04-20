<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>表单处理</title>
</head>
<body>
	<?php 
		/*if ($_POST['num'] != strval(floatval($_POST['num']))) {
			print('必须输入数字！');
		}else{
			echo $_POST['num'];
		}*/
		/*if(is_numeric($_POST['num'])){
			echo '是数字';
		} else {
			echo '不是';
		}*/
		echo $_POST['num'],'<br />';
		echo strval(floatval($_POST['num']));
	?>

</body>
</html>