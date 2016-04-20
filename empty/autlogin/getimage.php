<?php 
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=mytest;charset=utf8;port=3306','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception  异常模式模式
    $stmt=$pdo->prepare('select * from imagedata where id = 0');
    $stmt->execute();
    $data =$stmt-> fetch();
    Header( "Content-type: image/jpg");
    echo ($data[2]);

?>