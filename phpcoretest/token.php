<?php 
define('SECRET',"67%$#ap28");

function m_token(){
	$str = mt_rand(1000,9999);
	$str2 = dechex($_SERVER['REQUEST_TIME']-$str); //dechex();将十进制转化为十六进制
	/*echo 'REQUEST_TIME=',$_SERVER['REQUEST_TIME'],'<hr />';
	echo $str.SECRET,'<hr />';
	echo md5($str.SECRET),'<hr />';
	echo '<hr />***<strong>',substr(md5($str.SECRET),0,10),'</strong><hr/>';
	echo '<font color="red">',$str2,'</font><br />';
	echo $str.substr(md5($str.SECRET),0,10).$str2,'<br />';*/
	return $str.substr(md5($str.SECRET),0,10).$str2;

}
echo m_token();
function v_token($str,$delay=300){
	//$delay表示时间延迟，在不同的程序根据业务来自行修改
	$rs = substr($str,0,4);
	$middle = substr($str,0,14);
	$rs2 = substr($str,14,8);
	/*echo 'middle=',$middle,'<br/>';
	echo 'rs=',$rs,'<hr/>rs2=',$rs2,'<hr />',hexdec($rs2),'<hr />';
	echo '<hr />';
	echo 'REQUEST_TIME=',$_SERVER['REQUEST_TIME'];
	echo '<hr />';*/
	return ($middle == $rs.substr(md5($rs.SECRET), 0,10))&&($_SERVER['REQUEST_TIME']-hexdec($rs2)-$rs<$delay);
}
var_dump(v_token(m_token()));
?>