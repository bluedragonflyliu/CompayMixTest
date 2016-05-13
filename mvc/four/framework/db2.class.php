<?php
class db {
    public $conn;
	public static $sql;
	public static $instance=null;
	private function __construct(){
		global $db;
		$this->conn = mysql_connect($db['host'],$db['user'],$db['password']);
		if(!mysql_select_db($db['database'],$this->conn)){
			echo "失败";
		};
		mysql_query('set names utf8',$this->conn);		
	}
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new db;
		}
		return self::$instance;
	}
	public function find(){
		$result=mysql_query(self::$sql,$this->conn);
		$resuleRow = array();
		$i = 0;
		while($row=mysql_fetch_assoc($result)){
			foreach($row as $k=>$v){
				$resuleRow[$i][$k] = $v;
			}
			$i++;
		}
		return $resuleRow;
	}
	
}
?>