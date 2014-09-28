<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class SiteController extends AdminController{
    
    public function init(){
        
    }
    
    /*
     * 修改密码
     */
    public function actionUpd($type = NULL) {
        if (Yii::app()->adminuser->getIsGuest()){
            Yii::app()->request->redirect(Yii::app()->createUrl('/login'));
        }
        
        $model = new UpdPwdForm();
        if (isset($_POST['UpdPwdForm'])) {
            $model->type = $type;
            $model->attributes = $_POST['UpdPwdForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->update()) {
                Yii::app()->adminuser->logout();
                $this->redirect(array('/login'));
            }
        }
        $row = PowerUserModel::model()->findByPk(Yii::app()->adminuser->admin_id);
        $this->render('updPwd', array('model' => $model, 'type' => $type, 'row' => $row));
    }
}
