<?php

class LogMgDbModel extends EMongoDocument {
    
    
    public $admin_id;
    public $admin_tname;
    public $url;
    public $post;
    public $time;
    public $ip;
    
    /**
     * 
     * @param type $className
     * @return RegisterMgDbModel
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getCollectionName() {
        return 'bossadmin_request_log';
    }
}