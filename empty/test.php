<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action='selectform.php' method='post'>
	<?php 
	//var_dump(!isset($aa));
/*	$str = '<?php a is <script> alert("aaa"); //\\ !!##$$%%^^&&**()))<<>>""</script> ?>';

	$str = htmlspecialchars($str);
	echo $str;
	$str2 = "'";
	echo "<br />";
	$str2 = htmlspecialchars($str2);
	echo $str2;*/

	$choices = array('eggs'=>'Eggs Benedict', 'toast'=>'Buttered Toast with Jam','coffee'=> 'piping Hot Coffee');
	foreach ($choices as $key => $choices) {
		echo "<input type='checkbox' name='food[]' value='$key'/>$choices \n";
	}

?>
<input type='checkbox' name='food[]' value='aa'/>apple
<input type='submit' value='提交' />
</form>
</body>
</html>
