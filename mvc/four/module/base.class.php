<?php
 class module_base{
 	protected $_db;
 	public function __construct(){
 		$this->_db = db::getInstance();
 	}
 	
 }
?>
