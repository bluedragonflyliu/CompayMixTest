<?php 
 // model/model.php
  class Model {
      private $data = array(
                  'title' => 'Hello furzoom',
                  'welcome' => 'Welcome to furzoom.com',
                  );
      public function getData($key) {
          return $this->data[$key];
      }
  }
  // End of model.php