<?php
header('content-type:text/html;charset=utf-8');
echo "<pre>\n";
$arr = Array("Arr1","Arr2");
foreach($arr as $array){
 $array = "3" ;
}
print_r( $arr );

echo "\n上面的说明 \$array 是用 值传递 ， 修改 \$array 并没有造成原数组的变化 \n";

foreach($arr as &$array){
 $array = "3" ;
} 
print_r( $arr );

echo "\n上面的说明 \$array 是用 引用传递(传递的是变量的地址) ， 修改 \$array 造成原数组的变化 \n";

echo "\n这就是区别,你可以关注下  php参数传递方式\n";
echo '<hr/>';
function &chhua()
{ 
	static $b="www.jb51.net";//申明一个静态变量 
	$b=$b."WEB开发";
	echo $b;
	return $b;
}   
$a=chhua();//这条语句会输出　$b的值　为“www.jb51.netWEB开发” 
$a="PHP";
echo "<br />";
$a=chhua();//这条语 句会输出　$b的值　为“www.jb51.netWEB开发WEB开发”
echo "<br />";
$a=&chhua();//这条语句会输出　$b的值　为“www.jb51.netWEB开发WEB开发WEB开发”
echo "<br />";
$a="JS";
$a=chhua();//这条语句会输出　$b的值　为"JSWEB开发"
function &test(){
	static $b=0;//申明一个静态变量
	$b=$b+1;
	echo $b;
	return $b;
} 
$a=test();//这条语句会输出　$b的值　为１
$a=5;
$a=test();//这 条语句会输出　$b的值　为2
$a=&test();//这条语句会输出　$b的值　为3
$a=5;
$a=test(); //这条语句会输出　$b的值　为6

 /*
 	$a = test() 虽然说函数定义的时候，是引用返回方式，但是如果采用这种普通形势调用函数，那它的作用也就和普通的函数一样，所以看结果就是1、2

   $a = &test() 这种调用方式就是引用返回，就类似于 $a = &$b ，然后第二句又把$a = 5,那就是等于将变量$b = 5，最后一句得到的6也就很容易理解了！
   */
?>