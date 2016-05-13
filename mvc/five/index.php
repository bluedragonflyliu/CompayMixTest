<?php
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
error_reporting(E_ALL ^ E_NOTICE);


// 定义路径
define('MVC_PATH', dirname(__FILE__));
define('PLUGIN_PATH', MVC_PATH . '/plugin');
define('SMARTY_PATH', PLUGIN_PATH . '/smarty');
define('APPLICATION_PATH', MVC_PATH . '/application');
define('COMPONENTS_PATH', APPLICATION_PATH . '/components');
define('CONTROLLERS_PATH', APPLICATION_PATH . '/controllers');
define('VIEWS_PATH', APPLICATION_PATH . '/views');
define('CONFIGS_PATH', APPLICATION_PATH . '/configs');
define('LOGS_PATH', APPLICATION_PATH . '/logs');
define('CACHE_PATH', APPLICATION_PATH . '/cache');

require_once COMPONENTS_PATH . '/functions.php';      //加载函数类
require_once COMPONENTS_PATH . '/core.php';           //加载核心类
require_once COMPONENTS_PATH . '/controller.php';    //加载主控制器


/**
 * 过滤特殊符号
 * 该方法在GBK数据表下有漏洞
 */
foreach(array('_REQUEST', '_GET', '_POST', '_COOKIE', '_SERVER') as $value) {
    foreach(${$value} as $k => $v){
        ${$value}[$k] = func::saddslashes($v);
    }
    unset($value);
}


$mod = $_REQUEST['mod'] = !empty($_REQUEST['mod']) ? $_REQUEST['mod'] : 'main';
$act = $_REQUEST['act'] = !empty($_REQUEST['act']) ? $_REQUEST['act'] : 'index';

$controller_file = CONTROLLERS_PATH . '/' . $mod . '.php';
if(!file_exists($controller_file)){
    die('没有找到对应的程序文件');
}
require $controller_file;
$controller = new $mod();
$controller->$act();
?>