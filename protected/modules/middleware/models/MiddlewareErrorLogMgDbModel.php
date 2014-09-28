<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MiddlewareErrorLogMgDbModel extends EMongoDocument {
    public $type;
    public $typeName;
    public $errorMsg;
    public $add_time;
    
    /**
     * 
     * @param type $className
     * @return UserMgDbModel
     */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
    
    // This method is required!
	public function getCollectionName() {
		return 'middleware_error_logs';
	}
}
?>
