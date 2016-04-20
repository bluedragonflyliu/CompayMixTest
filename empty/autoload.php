<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
	header("content-type:text/html;charset=utf-8");
	if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('june_autoloader', true, true);
    } else {
        spl_autoload_register('june_autoloader');
    }
} else {
    function __autoload($classname)
    {
        june_autoloader($classname);
    }
}

function june_autoloader($classname){
	$class =$classname.".class.php";
    require_once($class);
}

//$foo = new Foo(new Demo('zhangsan',10));
$demo = new Demo('zhangsan',10);
$demo->doSomeThing();
//var_dump(is_callable(array($foo,'doSomeThing'),true));
/*class Instance {
    public $id;

    protected function __construct($id) {
        $this->id = $id;
    }

    public static function of($id) {
    	return new static($id);
    }
    
}
$aa =Instance::of('zhangsan');
var_dump($aa);*/
/*class AnotherClass { 
	public $aa = 'zhangsan';
	public $bb = 134;
   public function __construct($aa='aa',$bb) { 
   		$this->aa = $aa;
   		$this->bb = $bb;
   } 

   function funcB() { 
   		$ret = $this->aa.$this->bb;
   		return $ret;
   } 

} 
$class = new ReflectionClass('Demo');
 
$aclass = $class->newInstanceArgs(['zhangsan',33]);
 
$str = $aclass->doSomeThing();
echo $str;*/
?>	

<select class="car">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="fiat">Fiat</option>
<option value="audi">Audi</option>
</select>
	<script type="text/javascript" src="../bootstrap/bootstrap/js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript">
		$('.car').change(function(){
			var avalue  = $(this).find('option:selected').val();
			alert(avalue);
		});
	</script>
</body>
</html>
