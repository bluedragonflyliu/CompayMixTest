<?php 
/**
*测试控制器
*/
class testController extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		echo "测试成功test";
	}
	public function testDb(){
		$modTest 	= $this->model("test"); //实例化test模型
		$databases 	= $modelTest->testDatebases(); //调用testDatabase()方法
		var_dump($databases);
	}
}
?>