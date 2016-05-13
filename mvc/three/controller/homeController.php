<?php 
	class homeController extends Controller{
		public function __construct(){
			parent::__construct();
		}

		public function index(){
			echo '测试';
			exit();
		}
	}
?>