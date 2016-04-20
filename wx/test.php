<?php 
	$username=$_POST['username'];
	$sex=$_POST['sex'];
	if(!empty($username)&& !empty($sex)){
		echo ('success!');
	}
?>