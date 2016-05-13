<?php
/* memcache 操作类*/
class cache{
	private $memcache;
	private $prefix;
	public function __construct(){
		global $memcache;
		$this->memcache=memcache_connect('localhost','11211');
		$this->prefix = $memcache['key_prefix'];
	}
	/**
	 * 增加
	 * @param bool $type false:不覆盖 true:覆盖
	 */
	 public function add($key,$value,$type=false){
	 	if($type){
	 		return $this->memcache->set($this->toKey($key),$value,false,24*3600);
	 	}else{
	 		return $this->memcache->add($this->toKey($key),$value,false,24*3600);
	 	}
	 }
	 /**
	  * 获取
	  */
	 public function get($key){
	 	return $this->memcache->get($this->toKey($key),0);
	 }
	 /**
	  * 删除
	  */
	  public function delete($key){
	  	return $this->memcache->delete($this->tokey($key),0);
	  }
	  /**
	   * 替换
	   */
	  public function replace($key,$value){
	   	return $this->memcache->replace($this->toKey($key),$value,false,24*3600);
	   }
	  	 
	/**
	 * 转化为memcache的key
	 */
	public function toKey($key){
		
		return strrev(md5(($this->prefix).$key));
	}
}
/*
$m = new cache();
echo $m->add('select * from index',array('id'=>1,'name'=>'tom'));
echo $m->replace('select * from index',array('id'=>1,'name'=>'jake'));

$a=$m->get('select * from index');
print_r($a);
*/
?>
