<?php 
	/*目录分隔符，是定义php的内置常量。在调试机器上，在windows我们习惯性的使用“\”作为文件分隔符，但是在linux上系统不认识这个标识，于是就要引入这个php内置常量了：DIRECTORY_SEPARATOR*/
	header('content-type:text/html;charset=utf-8');
	define('DS',DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__));
/*	echo $_GET['url'];
	if(empty($_GET['url'])){
		$url = 'items/add';
	}else{

		$url = $_GET['url'];
	}*/
	$url = $_GET['url'];
	require_once(ROOT.DS.'library'.DS.'bootstrap.php');

