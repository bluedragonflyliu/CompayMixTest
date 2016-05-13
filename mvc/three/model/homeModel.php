<?php
	class homeModel extends Model{
		function test(){
			echo 'this is test homeModel';
		}

		function testResult(){
			$this->db->show_datebases();
		}
	}
?>