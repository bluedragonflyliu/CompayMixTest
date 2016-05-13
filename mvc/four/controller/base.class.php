<?php
class controller_base {
	protected $_view;
    function __construct(){    	
    	$this->_view = new view();
    }
 
}
?>