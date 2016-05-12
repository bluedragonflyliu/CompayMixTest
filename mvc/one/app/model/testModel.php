<?php 
/**
*测试模型
*/
class testModel extends Model{
	function testDatabases(){
		$this->db->show_databases();
	}
}

?>