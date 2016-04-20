<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
</head>
<body>
	<?php 

		$username = $_POST['username'];
		$password = $_POST['password']; 
		$salt = 'love php';
		$pdo = new PDO('mysql:host=localhost;dbname=mytest;charset=utf8;port=3306','root','');
		$stmt = $pdo->prepare("insert into admins (username,password)values(:username,:password)");
		$arr =array(':username' => $username, ':password' => md5($password.$salt));
		$stmt->execute($arr);
		$id = $pdo->lastInsertId();
		if(!empty($id)){
			header('location:./login.html');
		}
	?>
</body>
</html>