<?php
//控制器简易
// controller/democontroller.php
/*  class DemoController
  {
      public function index()
      {
      echo 'hello world';
      }
  }*/
  // End of the class DemoController
  // End of file democontroller.php

  //控制器改进

/*  // controller/democontroller.php
  class DemoController
  {
 
      public function index()
      {
      $data = 'Hello furzoom!';
      //echo 'hello world';
      require('view/index.php');
      $view = new Index();
      $view->display($data);
      }
  }
  // End of the class DemoController
  // End of file democontroller.php*/


  //控制器改进2
  // controller/democontroller.php
  class DemoController
  {
      // private $data = 'Hello furzoom!';
      function index($param)
      {
      // echo 'hello world';
          require('view/index.php');
      require('model/model.php');
      $model = new Model();
      $view = new Index();
      $data = $model->getData($param);
      $view->display($data);
      }
  }// End of the class DemoController
  // End of file democontroller.php