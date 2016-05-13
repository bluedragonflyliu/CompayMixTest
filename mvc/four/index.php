<?php
define('ROOT_DIR',dirname(__FILE__));
$m = isset($_GET['m']) ? $_GET['m'] : 'index_index';
$a = isset($_GET['a']) ? $_GET['a'] : 'index';
include_once('config/config.php');
include_once('include/function.php');
include_once('config/const.php');
include_once('include/file.php');
function __autoload($class){
	$path = explode('_',$class);
	switch ($path[0]){
		case 'controller':  // 加载控制器
		$classpath = str_replace("controller_","",$class);
		$classpath = str_replace("_",'/',$classpath);
		$classpath = '/controller/'.$classpath.'.class.php';
		break;
		case 'module':
		$classpath = str_replace("module_","",$class);
		$classpath = str_replace("_",'/',$classpath);
		$classpath = '/module/'.$classpath.'.class.php';
		break;
	}
	include_once(ROOT_DIR.$classpath);
}

$controllerName = 'controller_'.$m;
$controller = new $controllerName();
$controller->$a();



?>
