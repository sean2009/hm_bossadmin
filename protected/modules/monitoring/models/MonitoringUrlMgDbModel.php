<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MonitoringUrlMgDbModel extends EMongoDocument {
    public $id;
    public $url;
    public $starttime;
    public $request;
    public $server;
    public $add_time;
    public $login_token;
    public $session_id;
    public $service_ip;
    private static $table_time = '';
    /**
     * 
     * @param type $className
     * @return UserMgDbModel
     */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function setTableTime($table_time = NULL){
            if(empty($table_time)){
                self::$table_time = date('Ymd',time());
            }else{
                self::$table_time = $table_time;
            }
        }
    
    // This method is required!
	public function getCollectionName() {
		return 'monitoring_url'.self::$table_time;
	}
}
?>
