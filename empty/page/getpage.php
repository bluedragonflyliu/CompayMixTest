<?php 
	$pdo = new PDO('mysql:host=127.0.0.1; dbname=mytest; port=3306;charset=utf8','root','');
	$page = $_POST['page'];
	if(!empty($page)){
		$skip = 'skip 10';
	} else {
		$skip = '';
	}
	$stmt= $pdo->prepare('select * from pagedata limit 10'.$skip);
	$stmt->execute();
	$info = $stmt->fetchAll();
	echo json_encode($info);
	
?>