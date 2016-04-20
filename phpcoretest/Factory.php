<?php 
	
	class sqlFactory
	{
		public static function factory($type)
		{
			if(include_once './drivers/'.$type.'.php'){
				$classname = 'Db_Adapter_'.$type;
				return new $classname;
			}else{
				throw new Exception("drivers not found");
				
			}
		}
	}
	$db = sqlFactory::factory('MySQL');
	$db = sqlFactory::factory('SQLite');
?>