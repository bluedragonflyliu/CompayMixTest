<?php

 class module_index_index extends module_base{
 	
 	protected $table = "pagedata";
 	
 	public function __construct(){
 		parent::__construct();
 	}
 	public function index($start,$length){
 		$list=$this->_db->select($this->table,'','',$start, $length,"order by id,picname desc");
 		return $list;
 	} 
 	public function getCounts(){
 		$counts=$this->_db->counts($this->table);
 		return $counts;
 	}
 }
?>
