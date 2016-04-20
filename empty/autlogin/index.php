<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=mytest;charset=utf8;port=3306','root','');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//warning  警告模式
 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception  异常模式模式
	$stmt = $pdo->prepare("select * from autologin where cookiekey =?");
	$stmt->bindParam(1, $_COOKIE['autologin']);
	try{
		$stmt->execute();
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	$row = $stmt->fetch();
	if(!empty($row)) {
		echo $row['username'];
	} else {
		echo '还未登录|<a href="./login.html">登录</a>';
	}
	
?>
</body>
</html>
