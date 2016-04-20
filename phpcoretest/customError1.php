<?php 
header("content-type:text/html;charset=utf-8");
function customError($errno, $errstr,$errfile,$errline)
{
	throw new Exception($level .' |'.${errstr});
}
set_error_handler("customError",E_ALL|E_STRICT);
try
{
	$a=5/0;
}
catch(Exception $e)
{
	echo '错误信息：',$e->getMessage();
}

?>