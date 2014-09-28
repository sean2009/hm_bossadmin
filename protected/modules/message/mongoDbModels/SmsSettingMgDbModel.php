<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SmsSettingMgDbModel extends EMongoDocument {

    public $type;
    public $name;
    public $content;
    public $status;
    public $laster_time;

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
        return 'admin_sms_setting';
    }

    public function beforeSave() {
        if (empty($this->status)) {
            $this->status = 0;
        }
        parent::beforeSave();
    }

}

?>
