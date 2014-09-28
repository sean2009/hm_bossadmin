<?php

class AdminController extends BaseController {

    public $admin_id;
    public $admin_name;
    public $admin_type;
    public $role_id;
    public $admin_tname;
    public $menu = array();
    const ADMIN_MID = 9999;
    public $layout = 'application.views.layouts.main';

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function init() {
        
        if (Yii::app()->adminuser->getIsGuest()){
            if(Yii::app()->request->isAjaxRequest){
                echo 'nologin';
                exit;
            }
//            echo "<script>";
//            echo "parent.location.href= '/login' ";
//            echo "</script>";
//            exit;
            Yii::app()->request->redirect(Yii::app()->createUrl('/login'));
        }
        
        $this->admin_id = Yii::app()->adminuser->admin_id;
        $this->admin_name = Yii::app()->adminuser->admin_name;
        $this->admin_tname = Yii::app()->adminuser->admin_tname;
        $this->admin_type = Yii::app()->adminuser->admin_type;
        $this->role_id = Yii::app()->adminuser->role_id;
        $this->pageTitle = '后台管理';
        LogService::log(array(
            'url'   => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            'post'  => $_POST,
            'admin_id'  => $this->admin_id,
            'admin_tname'   => $this->admin_tname,
            'ip'   => EIp::getIp(),
            'time'  => time(),
        ),'bossadmin_request_log');
    }
    
    protected function isAdminManager(){
        if(Yii::app()->adminuser->admin_type!=1){
            throw new CHttpException(500,'没有权限');
        }
    }
    
    public function getErrorHtml($model){
        $errors = $model->getErrors();
        $error = array();
        foreach($errors as $val){
            $error[] = $val[0];
        }
        return $error;
    }
}
