<?php

class IndexController extends Controller
{
	public function actionIndex(){
		//echo 'aaa.com';
		echo Yii::app()->request->baseUrl;
		die();
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}
?>