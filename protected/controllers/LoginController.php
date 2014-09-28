<?php
class LoginController extends BaseController{
	public $layout = false;
	public function init(){ 
		$this->pageTitle = '后台登陆';
	}
	
	//登录
	public function actionIndex(){
                $model=new AdminLoginForm;
		if(isset($_POST['AdminLoginForm'])){
			$model->attributes=$_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(array('/index/index'));//$this->redirect(Yii::app()->user->returnUrl);
			}else{
                            $model->password = '';
                            $model->captcha = '';
                        }
                }
                $render['model'] = $model;
		$this->render('login',$render);
	}
        
	//退出
	public function actionLogout(){
            Yii::app()->adminuser->logout();
            $this->redirect(array('/login'));
            exit;
	} 
}