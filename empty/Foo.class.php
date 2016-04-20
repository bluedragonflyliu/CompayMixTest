<?php 
class Foo{
	public $cc = null;
	
	public function __construct(Demo $demo){
		$this->cc = $demo;
		$this->doSomeThing();
	}

	public function doSomeThing(){
		var_dump($this->cc);
	}
}