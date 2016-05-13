<?php
class controller_index_index extends controller_base{

    function __construct() {
    	parent::__construct();
    }
    function index(){
    	import("page.php"); // 使用分页类
    	$module = new module_index_index();
    	$counts=$module->getCounts();
    	$page = new page($counts,3);
    	$pagestr=$page->getPage();
    	$list=$module->index($page->start,3);
    	$list2 = $module->index($page->start,3);
    	$this->_view->assign('page',$pagestr);
    	$this->_view->assign('list',$list);
    	$this->_view->display('index/index.html');
    	
    	
    	
    }
    
}
?>