<?php 
trait Hello{
	public function sayHello(){
		echo "Hello";
	}
}

trait World {
	public function sayworld(){
		echo 'world';
	}
	
}
class MyHelloWorld{
	use Hello,world;
	public function sayExclamationMark(){
		echo '!';
	}

}
$o = new MyHelloWorld();
$o->sayHello();
echo '<br>';
$o->sayworld();
echo '<br>';
$o->sayExclamationMark();
?>