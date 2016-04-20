<?php
class Demo{
	public $name= 'zhangsan';
	public $age;
	public function __construct($name, $age){
		$this->name = $name;
		$this->age = $age;
		
	}
	public function doSomeThing(){
	
		echo $this->name.' is '.$this->age.' years old!';
	}

}
?>