<?php 
session_start();
if(pc_validate($_POST['username'],$_POST['password'])) {
	$_SESSION['login'] = $_POST['username'].','.md5($_POST['username'].$secret_word));
}
?>