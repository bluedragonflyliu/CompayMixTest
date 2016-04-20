<?php 
    $myfile = $_FILES['myfile'];
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=mytest;charset=utf8;port=3306','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception  异常模式模式
    $fp = fopen($myfile["tmp_name"], 'rb');
    $str = fread($fp,$myfile['size']);

    $stmt = $pdo->prepare("insert into imagedata (filename, filedata) values (:filename,:filedata)"); 
    $arr = array(':filename'=> $myfile['name'], ':filedata'=> $str);
    $stmt->execute($arr);
    fclose($fp);


?>