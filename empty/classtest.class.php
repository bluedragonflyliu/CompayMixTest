<?php 
	require_once 'Demo.class.php';
	class ClassTest{
		private static $_inst = null;
		public $demo = null;
		private function __construct(){
			$this->demo = new Demo('lisi',100);
		}

		public static function getInstance () {
			if(! (self::$_inst instanceof self)) {
				self::$_inst = new self;
			} 
			return self::$_inst;
		}
		public static function doSomeThing() {
			
		}
	}
?>