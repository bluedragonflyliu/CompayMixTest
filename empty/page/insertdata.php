<?php 
	/*$con = mysql_connect("127.0.0.1","root","");
	if (!$con)  {
 		die('Could not connect: ' . mysql_error());
  	}

	// Create database
	if (mysql_query("CREATE DATABASE  IF NOT EXISTS mytest",$con))  {
  		echo "Database created";
  	} else {
  		echo "Error creating database: " . mysql_error();
  	}

	// Create table in my_db database
	mysql_select_db("mytest", $con);
	$sql = "CREATE TABLE IF NOT EXISTS pagedata (id INT(255) NOT NULL, picname varchar(15) NOT NULL,PRIMARY KEY(id))";
	mysql_query($sql,$con);*/
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=mytest;port=3306;charset=utf8','root','');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception  异常模式模式
	for($i=1;$i<139;$i++){
		$name = 'img ('.$i.').jpg';
		$stmt = $pdo->prepare("insert into pagedata (picname)values(:picname)");
		$stmt->bindValue(':picname',$name);
		$stmt ->execute();
	}

	

?>