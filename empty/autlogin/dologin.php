<?php
	date_default_timezone_set('Asia/Chungking');
	header('Content-type:text/html;charset=utf-8');
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password']; 
	$remember = isset($_POST['remember'])?$_POST['remember']:'';
	$salt = 'love php';
	$pdo = new PDO('mysql:host=localhost;dbname=mytest;charset=utf8;port=3306','root','');
	$stmt = $pdo->prepare("select * from admins where username =? and password =?");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//warning  警告模式
 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception  异常模式模式
	$password = md5($password.$salt);
	$stmt->bindParam(1,$username);
	$stmt->bindParam(2,$password);
	$stmt->execute();
	$row = $stmt->fetch();
	if(empty($row)){
		echo '登录失败！';
		echo '<script>window.location.href="./login.html"</script>';
	} else {
		$id = $row['id']; 
		if(!empty($remember)) {
			$autologin = $username.$id;
			$stmt = $pdo->prepare("insert into autologin (cookiekey,ct_date,username)values(:cookiekey,:ct_date,:username)");
			$arr = array(':cookiekey' => $autologin, ':ct_date'=>time(), ':username'=>$username);
			try{
  				$stmt->execute($arr);
			}catch(PDOException $e){
 				 echo $e->getMessage();
			}
			$id = $pdo->lastInsertId();
			
			if(isset($id)){
				echo $id;
				setcookie('autologin',$autologin,time()+7200,"/");
				$_SESSION['autologin'] = $autologin;
			}
		}
		echo '登录成功！';
		echo '<script>window.location.href="./index.php"</script>';
	}
?>
