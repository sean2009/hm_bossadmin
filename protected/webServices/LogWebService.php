<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class LogWebService extends BaseService{
    
    public static function addLog($name,$action){
        $log = array(
            'opter_action' => $action,
            'opter_name' => Yii::app()->adminuser->admin_name,
            'opter_admin_id' => Yii::app()->adminuser->admin_id,
            'opter_time' => date('Y-m-d H:i:s',time()),
            'content' => $name,
        );
        LogService::log($log,'boss_admin_opter_log');
    }
    
    public static function setLogs($data){
    	$log = array(
            'opter_action' => $data['opter_action'],
            'opter_name' => $data['opter_name'],
    		'opter_admin_id' => $data['opter_admin_id'],
            'opter_time' => date('Y-m-d H:i:s',time()),
            'content' => $data['content'],
        );
        
        LogService::log($log,'boss_admin_opter_log');
    }
    
    public static function getLogs($data=array()) {
        	$params = array(
	             'opter_action' => $data['opter_action'],
	        	 'opter_name' => $data['opter_name'],
        		 'opter_admin_id' => $data['opter_admin_id'],
	             'start_time' => $data['start_time'],
	         	 'end_time' => $data['end_time'],
	             'content' => $data['content'],
        		 'page' => $data['page'],
        	);
        return API_Client::call(API_MESSAGE_URL, 'adminOpter/get', $params);
    }
	public static function getArgs($data=array()) {
        	$params = array(
	             'argcode' => $data['argcode'],
        	);
        return API_Client::call(API_LOG_URL, 'eaiarg/GetArg/', $params);
    }
}
?>
