<?php

class IndexController extends AdminController {
    
    

    //后台首页
    public function actionIndex() {
        $this->layout = false;
        $render['list'] = PowerMenuService::getPowerMenuList($this->admin_id,$this->role_id);
        //传递token到其他需要登录的站
//        $render['login_url'] = Yii::app()->params->login_urls;
//        $render['token'] = Yii::app()->adminuser->getToken();
       
        $this->render('index', $render);
    }

    //后台首页
    public function actionMain() {
        
        $log = array(
            'login_name' => time(),
        );
        
        LogService::log($log,'logtest');
        
        $this->render('main');
    }
}
