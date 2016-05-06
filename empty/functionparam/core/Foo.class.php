<?php 
class Foo{
		public $name;
		private $age;
		protected $sex;
		public $Demo;
		public function __construct(){
			//echo 'foo have be build '.$str.'  '.$sex;
			
		}
		public function setAge($age){
			$this->age = $age;
		}
		public function getAge(){
			return $this->age;
		}
		public function doSomething(){
			echo 'foo is ok!';

		}

	}
?>