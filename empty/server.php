<?php
//http://localhost/empty/server.php?action=admin&name=zhangsan
/*echo $_SERVER['REQUEST_URI'],'<hr/>'; ///empty/server.php?action=admin&name=zhangsan
echo $_SERVER['SERVER_PORT'],'<hr/>'; //80
echo $_SERVER['REQUEST_METHOD'],'<hr/>'; //GET
echo $_SERVER['QUERY_STRING'],'<hr/>'; #查询(query)的字符串。 action=admin&name=zhangsan
echo $_SERVER['SERVER_ADMIN'],'<hr/>'; //#管理员信息
echo $_SERVER['HTTP_X_REWRITE_URL'],'<hr/>';
echo $_SERVER['HTTP_HOST'],'<hr/>';
echo $_SERVER['SERVER_NAME'];
*/
/*class Demo {
	public $cc = 10;
	public $dd = 'Demo';
	public function __construct($cc){
		$this->cc = $cc;
	}
	public function doSomeThing(){
		echo 'when you have saw this word that mean you have created class Demo';
	}
}
class Foo {
	public $aa = 100;
	public $bb = 'hundred';
	public $myDemo = null;
	public function __construct(Demo $myDemo){
		$this->myDemo = $myDemo;
	}
	public function doThis(){
		$this->myDemo->doSomeThing();
	} 
}
Demo::doSomeThing();
echo Demo::$cc;*/

require_once('./classtest.class.php');
$ct = ClassTest::getInstance();
$ct->demo->doSomeThing();
$de = new Demo('liulu',90);
$de->doSomeThing();

?>