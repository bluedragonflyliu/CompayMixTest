	<?php
	interface Db_Adapter{
		/**
		*连接数据库
		*@param $config 数据库配置
		*@return resource
		*/
		public function connect($config);

		/**
		*执行数据库查询
		*@param string $query 数据库查询SQL字符串
		*@param mixed $handle 连接对象
		*return resource
		*/
		public function query($query,$handle);

	}
?>