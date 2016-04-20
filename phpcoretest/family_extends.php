<?php 
header("content-type:text/html;charset=utf-8");
 class person{
 	public $name='Tom';
 	public $gender;
 	static $money=1000;
 	public function __construct(){
 		echo '这里是父类<br/>';
 	}
 	public function say(){
 		echo $this->name.' is '.$this->gender.'<br />';
 	}
 }
 /**
 * 
 */
 class family extends person
 {
 	public $name;
 	public $gender;
 	public $age;
 	static $money = 100000;

 	function __construct()
 	{
 		parent::__construct();
 		echo '这里是子类<br />';
 	}

 	public function say(){
 		parent::say();
 		echo $this->name,"\t is \t",$this->gender,",and is\t",$this->age,'<br/>';
 	}

 	public function cry(){
 		echo parent::$money,'<br />';
 		echo '%>_<%','<br />';
 		echo self::$money,'<br />';
 		echo '(*^__^*)';
 	}
 }
 $poor = new family();
 $poor->name ='Lee';
 $poor->gender = 'famale';
 $poor->age = 25;
 $poor->say();
 $poor->cry();
?>