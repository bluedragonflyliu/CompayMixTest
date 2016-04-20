<?php 
class person{
	public $name;
	public $gender;
	public function say(){
		echo $this->name,'--is--',$this->gender,'<br>';
	}
	public function __set($name,$value){
		echo "Setting $name to $value <br />";
		$this->$name = $value;
	}

	public function __get($name){
		if(!isset($this->$name)){
			echo '未设置';
			$this->$name = "正在设置默认值";
		}
		return $this->$name;
	}
}
$student = new person();
$student->name = "tom";
$student->gender = 'male';
$student->age=24;

$reflect = new ReflectionObject($student);
//获得对象的属性列表
$props = $reflect->getProperties();
foreach ($props as $prop) {
	print $prop->getName() .'<br>';
}

//获取对象的方法列表
$m = $reflect->getMethods();
foreach ($m as $prop) {
	print $prop->getName() .'<br>';
}

//不用反射API，使用class函数，返回对象属性的关联数组以及更多的信息；
//返回对象属性的关联数组
var_dump(get_object_vars($student));
//返回由类的方法名组成的数组
var_dump(get_class_vars(get_class($student)));
var_dump(get_class_methods(get_class($student)));

// 假如这个对象是从其他的页面传过来的，通过get_class知道它属于那个类

echo get_class($student);
//但是api的反射功能更强大，甚至能还原这个类的原型，包括方法的访问权限

$obj = new ReflectionClass('person');
$className = $obj->getName();
$Methods = $Properties = array();
foreach ($obj ->getProperties() as $v) {
	$Properties[$v->getName()]=$v;
}
foreach ($obj ->getMethods() as $v) {
	$Methods[$v->getName()]=$v;
}
echo '<hr />';
echo "class {$className} {<br />";
is_array($Properties) && ksort($Properties);
echo '<pre>';
foreach ($Properties as $key => $value) {
	
	//echo $value->isPublic()?'public':'',$value->isPrivate()?'private':'',$value->isProtected()?'protected':'',
	//$value->isStatic()?'static':'',$key,'&nbsp;&nbsp;',$value;
	echo $value;
	echo '<br>}';
}
echo '<br>**';
is_array($Methods) && ksort($Methods);
foreach ($Methods as $key => $value) {
	echo 'funtion ',$key,'(){<br />',$value,'<br>}';
}
echo '</pre>';
?>