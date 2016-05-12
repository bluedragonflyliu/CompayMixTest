<?php
/**
*URL 处理类
*/
final class Route{
	public $url_query;
	public $url_type;
	public $route_url = array();

	public function __construct(){
		$this->url_query = parse_url($_SERVER['REQUEST_URI']);
	}
	/**
	* 设置URL类型
	*@access public 
	*/

	public function setUrlType($url_type = 2){
		if($url_type > 0 && $url_type<3){
			$this->url_type = $url_type;
		} else {
			trigger_error("指定的URL模式不存在！");
		}
	}

	/**
	*获取数组形式的URL
	*@access  public 
	*/
	public function getUrlArray(){
		$this->makeUrl();
		return $this->route_url;
	}

	public function makeUrl(){
		switch ($this->url_type) {
			case 1:
				$this->queryToArray();
				break;
			case 2:
				$this->pathinfoToArray();
				break;
			default:
				break;
		}

	}

	/**
	*将query形式的url转化为数组
	*@access public 
	*/

	public function queryToArray(){
		$arr = !empty($this->url_query['query'])?explode('&', $this->url_query['query']):array();
		$array = $tmp =array();
		if(count($arr)>0){
			foreach ($arr as $item) {
				$tmp = explode('=', $item);
				$array[$tmp[0]] = $tmp[1];
			}

			if(isset($array['app'])){
				$this->route_url['app']= $array['app'];
				unset($arrayp['app']);
			}
			if(isset($array['controller'])){
				$this->route_url['controller'] = $array['controller'];
				unset($array['controller']);
			}
			if(isset($array['action'])){
				$this->route_url['action'] = $array['action'];
				unset($array['action']);
			}
			if(count($array)>0){
				$this->route_url['params'] = $array;
			}
		} else {
			$this->route_url = array();
		}
	}

	/**
	*将PATH_INFO的URL形式转化为数组
	*@access public 
	*/
	public function pathinfoToArray(){
		
	}
}
?>