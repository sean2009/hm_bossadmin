<?php

class RegisterMgDbModel extends EMongoDocument {
    
    private $monthName;
    
    public $login_name;
    public $ext_login_type;
    public $back_act;
    public $reg_time;
    public $user_name;
    public $ext_login_name;
    
    /**
     * 
     * @param type $className
     * @return RegisterMgDbModel
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getCollectionName() {
        return 'passport_register_' . ($this->monthName ? $this->monthName : date('Ym'));
    }
    
    public function setCollectionMonth($monthName) {
        $this->monthName = $monthName;
    }

}