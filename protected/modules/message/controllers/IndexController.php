<?php
/*
 * 消息服务
 */
class IndexController extends AdminController{
//    public $layout = 'application.views.layouts.main';
    /*
     * 
     */
    public function actionIndex(){
        $render['list'] = SmsSettingService::model()->getTypeList();
        $render['channel'] = SmsSettingService::model()->getChannelRow();
        $this->render('index',$render);
    }
    
    public function actionSetChannel($content){
        $s = SmsSettingService::model()->setChannel($content);
        $this->redirect(array('index'));
    }
    
    public function actionUpdate($id,$status){
        $s = SmsSettingService::model()->updateType($id,array('status'=>$status));
        $this->redirect(array('index'));
    }
    
    public function actionAdd(){
        $name = $_GET['name'];
        $return = SmsSettingService::model()->addTypeContent($name,'');
        if($return===false){
            $status = -1;
            $msg = '类型名称不能重复';
        }else{
            $status = 0;
            $msg = '';
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
    
    public function actionLog(){
        $this->render('log');
    }
    
    public function actionSendSms(){
        $mobile = $_GET['mobile'];
        $send_type = $_GET['type'];
        $content = $_GET['content'].$send_type.date('Y-m-d H:i:s',time());
        $s =  MessageWebService::sendSms(array($mobile), $content, $send_type);
    }
    
    public function actionSendEmail(){
        $mail_title = $_GET['title'];
        $mail_to = $_GET['to'];
        $mail_content = $_GET['content'].$mail_to.date('Y-m-d H:i:s',time());
        $s =  MessageWebService::sendEmail($mail_title, $mail_content, $mail_to);
        print_r($s);
    }
}
?>
