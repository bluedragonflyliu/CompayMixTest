<?php
	/**
	*应用程序入口
	*/
	//echo dirname(__FILE__);
	//echo '<hr/>',__FILE__;
	//die();
	require dirname(__FILE__).'/system/app.php';
	require dirname(__FILE__).'/config/config.php';
	Application::run($CONFIG);
?>