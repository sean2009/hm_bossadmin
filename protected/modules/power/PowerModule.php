<?php
class PowerModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'power.models.*',
                        'power.forms.*',
			'power.services.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{   
                $controller->layout = 'application.views.layouts.main';
		if(parent::beforeControllerAction($controller, $action))
		{
//			$controllerId = strtolower($controller->id);
			if (Yii::app()->adminuser->getIsGuest()){
                            Yii::app()->request->redirect(Yii::app()->createUrl('/login'));
                        }
                        if(Yii::app()->adminuser->admin_type!=1){
                            throw new CHttpException(500,'没有权限');
                        }
			return true;
		}
		else
			return false;
	}
}
