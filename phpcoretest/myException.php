<?php 
header("content-type:text/html;charset=utf-8");
class emailException extends exception{

}
class pwdException extends Exception{
	function __toString()
	{
		//return 'pwdException';
		return "<div class='error'>Exception {".$this->getCode().'}:{'.$this->getMessage().'}in File:{'.$this->getFile().'}on line:{'.$this->getLine().'}</div>'; //改写抛出异常结果；
	}
}
function reg($reginfo =null){
	if(empty($reginfo) || !isset($reginfo)){
		throw new Exception("参数非法");
	}
	if(empty($reginfo['email'])){
		throw new emailException(' 邮箱为空');
	}
	if($reginfo['pwd'] !=$reginfo['repwd']){
		throw new pwdException('两次密码输入不一致');
	}
	echo '注册成功';
}

try{
	reg(array('email'=>'waitfox@qq.com','pwd'=>1234546, 'repwd'=>142322 ));
}catch(emailException $ee){
	echo $ee->getMessage();
}catch(pwdException $ep){
	echo $ep;
	echo '<br/>特殊处理';
}catch(Exception $e){
	echo $e->getTraceAsString(),'<br/>其他情况统一处理';
}
?>