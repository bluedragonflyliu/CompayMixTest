<?php 
header("content-type:text/html;charset=utf-8");
function customError($errno, $errstr, $errfile, $errline)
{
	echo "<b>错误代码：</b>[${errno}]${errstr}<br />";
	echo "错误代码所在的行：{$errline}文件{$errfile} <br />";
	echo "PHP版本",PHP_VERSION,"(",PHP_OS,"<br />";
}
set_error_handler("customError",E_ALL|E_STRICT);
$a = array('o'=>2,4,6,8);
echo $a[o];
?>