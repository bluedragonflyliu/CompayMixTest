<?php 
/**
*核心控制器类
*/
class Model{
	protected $db = null;
	final public function __construct(){
		header('Content-type:text/html;charset=utf-8');
		$this->db = $this->load('mysql');
		$config_db = $this->config('db');
		$this->db->init(
			$config_db['db_host'],
			$config_db['db_user'],
			$config_db['db_password'],
			$config_db['db_database'],
			$config_db['db_conn'],
			$config_db['db_charset']
			);
	}

	/**
	*根据表前缀获取表名
	*@param string $table_name 表名
	*/
	final protected function table($table_name){
		$config_db = $this->config('db');
		return $config_db['db_table_prefix'].$table_name;
	}

	/**
	*加载类库
	*@param string $lib 类库名称
	*@param Bool $my 如果false默认加载系统自动自动加载的类库，如果为true则加载自定义类库
	*@return type
	*/
	final protected function load($lib, $my = false) {
		if(empty($lib)){
			trigger_error('加载类库名不能为空');
		} else if($my === false){
			return Application::$_lib[$lib];
		} else if($my === true) {
			return Application::newLib($lib);
		}
	}

	/**
	*加载系统配置，默认为系统配置$CONFIG['system'][$config]
	*@param string $config 配置名
	*/
	final protected function config($config=''){
		return Application::$config[$config];
	}
}
?>