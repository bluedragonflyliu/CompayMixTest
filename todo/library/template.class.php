<?php
    class Template {
       protected $variables = array();
       protected $_controller;
       protected $_action;
       function __construct($controller,$action) {
           $this->_controller = $controller;
           $this->_action =$action;
       }
       /* 设置变量 */
       function set($name,$value) {
            $this->variables[$name] = $value;
       }
       /* 显示模板 */
       function render() {
           extract($this->variables);
           if (file_exists(ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'header.php')) {
               include(ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'header.php');
           } else {
               include(ROOT.DS. 'application' .DS. 'views' .DS. 'header.php');
           }
           echo ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. $this->_action . '.php';
           include (ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. $this->_action . '.php');
           if (file_exists(ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'footer.php')) {
               include (ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'footer.php');
           } else {
               include (ROOT.DS. 'application' .DS. 'views' .DS. 'footer.php');
           }
        }
    }