<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		Study::model()->find
		(
			'username= :name' ,
			array(':name' =>'study')
		);
		$this->render('index');

	}
	public function actionLogin()
	{

		$loginForm = new loginForm();
		if(isset($_POST['LoginForm'])){
			$loginForm->attributes = $_POST['LoginForm'];
			
			if($loginForm->validate()){
				echo 'aa';
			}	
		}
		$this->render('login',array('loginForm'=>$loginForm));
	}

	public function actions(){
    return array(
        'captcha' =>array(
            'class' =>'system.web.widgets.captcha.CCaptchaAction',
            'height'=>25, 
            'width'=>80,
            'minLength'=>4,
            'maxLength'=>4,
    		
			),

		);

	}
}