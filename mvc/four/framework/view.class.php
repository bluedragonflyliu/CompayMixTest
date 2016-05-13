<?php
include_once(ROOT_DIR.'/framework/smarty/Smarty.class.php');
/*
 * Created on 2011-9-13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class view extends Smarty{
 	
 	public function __construct(){
 		global $smartyconf;
 		$this->template_dir = $smartyconf['template_dir'];
 		$this->compile_dir = $smartyconf['compile_dir'];
 		$this->left_delimiter = $smartyconf['left_delimiter'];
 		$this->right_delimiter = $smartyconf['right_delimiter'];
 		$this->cache_lifetime = 60;
 		$this->cache_dir    = $smartyconf['cache_dir'];
 		$this->caching = 0;
 		 		
 	}
 	public function display($resource_name, $cache_id = null, $compile_id = null){
 		global $m,$a,$static,$cache;  // 当前模块，当前方法，当前需要静态化文件
 		if(array_key_exists($m,$static)){
 			if(in_array($a,$static[$m])){
 				$cache_dir = ROOT_DIR.'/cache/html_cache/'.$m.'-'.$a;
 				if(file_exists($cache_dir) &&
 				 $cache['cache_life']+filemtime($cache_dir)>=time()){
 					include($cache_dir);die;
 				};
 				ob_start();
 				parent::display($resource_name, $cache_id, $compile_id);
 				$str=ob_get_contents();
 				file_put_contents(ROOT_DIR.'/cache/html_cache/'.$m.'-'.$a,$str);
 				ob_end_clean();
 				include($cache_dir);die;
 			}
 		}
 		parent::display($resource_name, $cache_id, $compile_id);
 	}
 }
 
 
 
?>
