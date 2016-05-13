<?php 
/**
*核心控制器
*/
class controller{
	public function __construct(){
		header('Content-type:text/html;charset=utf-8');
	}
	/**
	*@param string $model 模型名称
	*
	*/
	final protected function model($model) {
		if(empty($model)){
			trigger_error('不能实例化空模型');
		}
		$model_name = $model.'Model';
		return new $model_name;
	}

	/**
	* 加载类库
	*@param string $lib 类库名
	*@param Bool $my 如果false默认加载系统自动加载的类库， 如果为true则加载非自动加载类库
	*@return type
	*/
	final protected function load($lib, $auto = true){
		if(empty($lib)){
			trigger_error('加载类库名不能为空');
		} else if($auto === true) {
			return Application::$_lib[$lib];
		} else if($auto === false){
			return Application::newLib($Lib);
		}
	}

	/**
	*加载系统配置，默认为系统配置$CONFIG['system'][$config]
	*@param string $config 配置名
	*
	*/
	final protected function config($config){
		return Application::$_config[$config];
	}

	/**
	*加载模板文件
	*@param string $path 模板路径
	*@return string 模板字符串
	*/
	final protected function showTemplate($path,$data = array()){
		$temple = $this->load('template');
		$template->init($path,$data);
	
		$template->outPut();
	}
}

?>