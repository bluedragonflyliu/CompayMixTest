<?php 

	$dsn = "mysql:host=localhost;dbname=mytest;charset=utf8";
	$user = "root";
	$password = "";
	try{
		$dbh = new PDO($dsn,$user,$password);
	}catch(PDOException $e){
		echo "连接失败".$e->getMessage();
	}
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//warning  警告模式
 	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception  异常模式模式
?>