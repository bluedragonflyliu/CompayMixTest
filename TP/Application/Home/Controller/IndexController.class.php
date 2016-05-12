<?php
namespace Home\Controller;
 use Think\Controller;
 use Think\hook;
class IndexController extends Controller {
    public function index(){
    	//$aa = 'Behavior\\adBehavior';
    	//Hook::add();
    	Hook::add('ad','Behavior\\adBehavior');
    	$this->display();
        //$this->show();
    }
}