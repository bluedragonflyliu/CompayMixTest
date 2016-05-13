<?php
$db = array(
		'host'=>'localhost',
		'user'=>'root',
		'password'=>'',
		'database'=>'mytest'
);

$smartyconf = array(
		'template_dir'=>ROOT_DIR.'/templates/',
		'compile_dir' =>ROOT_DIR.'/cache/templates_c/',
		'cache_dir'   =>ROOT_DIR.'/cache/html_cache/',
		'cache'       => true,   // 无缓存
		'debugging'   =>false,
		'left_delimiter' =>'<!--{',
		'right_delimiter'=>'}-->'
	);
	
	// 配置静态化  controller类名=>方法名
$static = array(
		'index_index'=>array('index'),
);
$cache = array(
		'cache_life'=>10         // 静态化存在时间 单位  秒
);
$memcache = array(
		'host'=>'localhost',
		'key_prefix' =>'',
)	
	
?>