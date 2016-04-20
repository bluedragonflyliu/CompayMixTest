<?php 
require_once './drivers/Db_Adapter.php';
class Db_Adapter_Mysql implements Db_Adapter
	{
		private $_dbLink;

		/**
		*数据库连接函数
		*
		*@param $config 数据库配置
		*@throws Db_Exception
		*@return resoure
		*/
		public function connect($config)
		{
			if($this->_dbLink = @mysql_connect($config->host.(empty($config->post)?'':':'.$config->port),$config->user,$config->password,true)){
				if(@mysql_select_db($config->database,$this->_dbLink)){
					if($config->charset){
						mysql_query("SET NAMES '{$config->charset}'",$this->_dbLink);
					}
					return $this->_dbLink;
				}
			}
			/*数据库异常*/
			throw new Db_Exception(@mysql_error($this->_dbLink));

		}

		/**
		*@param string $query   数据库查询SQL字符串
		*@param mixed $handle  连接对象
		*@return resource
		*/
		public function query($query, $handle)
		{
			if($resource = @mysql_query($query,$handle))
			{
				return $resource;
			}
		}
	}
