<?php
/**
 * @author XiaoPeng<xiaopeng@eetop.com>  2012-02-01
 * @link http://www.eetop.com
 * @copyright Copyright &copy; 2011-2012 eetop.com
 * @license
 */

/**
 * 公共访问方法  <$LastChangedBy: xiaopeng $>
 * @author XiaoPeng <xp_go@qq.com>
 * @version $Id: IndexController.php  2011-10-19 12:08 XiaoPeng $
 * @package 
 */
class PublicController extends BaseController {
	
	/**
	 * throw 错误后的默认跳转地址，在这里进行错误处理
	 */
	public function actionError(){
		if($error = Yii::app()->errorHandler->error){
			if(Yii::app()->request->isAjaxRequest){
				echo $error['message'];
				Yii::app()->end();
			} else {
//				$this->ur_here = '提示';
				$this->render('error', $error);
			}
		}
	}
        
        public function actionAuth($actions = NULL,$token = NULL){
            
            if(empty($actions)){
                echo json_encode(array('type'=>'isempty'));
                exit;
            }
            if(empty($token)){
                echo json_encode(array('type'=>'nologin'));
                exit;
            }
            
            if (($user = WebUserService::model()->getInit($token))=== false){
                echo json_encode(array('type'=>'nologin'));
                exit;
            }
            $admin_id = $user['admin_id'];
            if($admin_id == AdminController::ADMIN_MID){
                echo json_encode(array('type'=>'auth','admin_id'=>$admin_id,'admin_tname'=>$user['admin_tname']));
                exit;
            }
            $sign_list = $user['sign_list'];
            if(empty($sign_list)){
                echo json_encode(array('type'=>'noauth','admin_id'=>$admin_id,'admin_tname'=>$user['admin_tname']));
                exit;
            }
            $priv_array = explode(',', $sign_list);
            if(!in_array($actions,$priv_array)){
                echo json_encode(array('type'=>'noauth','admin_id'=>$admin_id,'admin_tname'=>$user['admin_tname']));
                exit;
            }
            echo json_encode(array('type'=>'auth','admin_id'=>$admin_id,'admin_tname'=>$user['admin_tname']));
            exit;
        }
}