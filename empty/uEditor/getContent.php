<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>获得UEditor内容</title>
</head>
<body>
	<?php
		date_default_timezone_set("PRC");
		require_once 'conn.php';
		$content = $_POST['content'];
		$time = time();
		$title = '富文本测试'; 
		$content = addslashes($content);
		
		$stmt = $dbh->prepare("insert into news (title,content,cre_time)values(:title,:content,:cre_time)");
		$arr =array(':title'=>$title,':content'=>$content,':cre_time'=>$time);
		$stmt->execute($arr);
		
		//echo '<pre>';
		//var_dump($_POST["input"]);

	 ?>
</body>
</html>