<?php
if(!defined('MVC_PATH')){
    exit('Access Denied');
}

class core {
    
    static public $db;
    
    /**
     * 数据库初始化
     */
    static public function db(){
        if(isset(self::$db)) return;
        
        require CONFIGS_PATH.'/config.php';
        require COMPONENTS_PATH.'/db_mysql.php';
        $db = new db_mysql($db_options);
        self::$db = &$db;
    }
    
}
?>