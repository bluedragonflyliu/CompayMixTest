<?php 
header("content-type:text/html;charset=utf-8");
class Account{
	private $user = 1;
	private $pwd = 2;
	public function __set($name, $value){
		echo "Setting $name to $value <br />";
		$this->$name=$value;
	}
	public function __get($name){
		if(!isset($this->$name)) {
			echo "$name 未设置<br/>";
			$this->$name = "正在为你设置默认值";
		}
		return $this->$name;
	}

	public function __call($name, $arguments){
	    switch(count($arguments)){
	        case 2:
	            echo $arguments[0]*$arguments[1];
	            break;
	        case 3:
	            echo array_sum($arguments);
	            break;
	        default:
	            echo '参数不对';
	            break;
	  	}
	}

}
$a = new Account();
echo $a->user.'<br />';
$a->name = 5;
echo $a->name.'<br />';
echo $a->big.'<br />';
 $a->make(5,6);
 $a->make(5,6,8);
 $a->make(8);
?>