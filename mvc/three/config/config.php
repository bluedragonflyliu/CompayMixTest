<?php
/**
*系统配置文件
*/
$CONFIG['system']['db'] = array(
	'db_host'			=> 'localhost',
	'db_user'			=> 'root',
	'db_password'		=> '',
	'db_database'		=> 'mytest',
	'db_table_prefix'	=> '',
	'db_conn'			=> '',
	);
$CONFIG['system']['lib'] = array(
	'prefix'	=> 'my', //自定义类前缀
	);
$CONFIG['system']['route'] = array(
	'default_controller'	=> 'home',
	'default_action'		=> 'index',
	'url_type'				=> 1 //定义url 形式 1为普通 2 是 路径模式
	);
/*缓存配置*/
$CONFIG['system']['cache'] =array(
	'cache_dir'		=> 'cache', 	//缓存路径，相对于根目录
	'cache_prefix'	=> 'cache_', 	//缓存文件名前缀
	'cache_time'	=> 1800,		//缓存时间默认1800秒
	'cache_mode'	=> 2,			//mode 1 为serlize ， model 2为保存为可执行文件
	);
?>