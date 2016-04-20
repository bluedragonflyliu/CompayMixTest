<?php 
class Db_Adapter_sqlite implements Db_Adapter
	{
		private $_dbLink; //连接数据字符串提示
		/**
		*数据库连接函数
		*@param $config 数据库配置
		*@throw Db_Exception
		*@return resource
		*/
		public function connect($config)
		{
			if($this->_dbLink = sqlite_open($config->file,0666,$error))
			{
				return $this->_dbLink;
			}

			/*数据库异常*/
			throw new Db_Exception($error);

		}

		/**
		*执行数据库查询
		*@param string $query 数据库查询SQL字符串
		*@param mixed $handle 连接对象
		*@return resource
		*/
		public function query($query, $handle)
		{
			if($resource = @sqlite_squery($query,$handle)){
				return $resource;
			}
		}
	}