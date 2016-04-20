 <?php 
 //简易示例
 //index.php
/*  require('controller/democontroller.php');
  $controller = new DemoController();
  $controller->index();*/
  // End of index.php

  //改进示例
  //访问http://localhost/myframe/index.php?c=demo&a=index
  //index.php
   /*
   // get runtime controller prefix
 var_dump($_GET);
  $c_str = $_GET['c'];
  // the full name of controller
  $c_name = $c_str.'controller';
  // the path of controller
  $c_path = 'controller/'.$c_name.'.php';
  // get runtime action
  $method = $_GET['a'];
  // load controller file
  require($c_path);
  // instantiate controller
  $controller = new $c_name;
  // run the controller  method
  $controller->$method();
  // End of index.php
*/


  //改进示例2

   //index.php
  // get runtime controller prefix
  $c_str = $_GET['c'];
  // the full name of controller
  $c_name = $c_str.'controller';
  // the path of controller
  $c_path = 'controller/'.$c_name.'.php';
  // get runtime action
  $method = $_GET['a'];
  // get runtime parameter
  $param = $_GET['param'];
  // load controller file
  require($c_path);
  // instantiate controller
  $controller = new $c_name;
  // run the controller  method
  $controller->$method($param);
  // End of index.php
