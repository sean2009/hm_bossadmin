<?php

class OtherModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'other.models.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
                $controller->layout = 'application.views.layouts.main';
		if(parent::beforeControllerAction($controller, $action))
		{
			$controllerId = strtolower($controller->id);
			if($controllerId != 'site'){
				if (Yii::app()->adminuser->getIsGuest()){
					Yii::app()->request->redirect(Yii::app()->createUrl('/login'));
				}
			}
			return true;
		}
		else
			return false;
	}
}
