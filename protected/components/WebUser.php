<?php

class WebUser extends CComponent implements ArrayAccess {
    

    private $userInfo = array();
    private $token;
    
    public function init() {
        $user = WebUserService::model()->getInit();
        if($user !== NULL){
            if($user === false){
                $this->logout();
                Yii::app()->request->redirect('/login');
            }

            $this->userInfo = $user;
            $this->token = WebUserService::model()->getToken();
        }
    }
    
    
    public function getIsGuest() {
        if(WebUserService::model()->lastAccess($this->token) === false){
            return true;
        }
        return !isset($this->userInfo['admin_id']);
    }
    
    public function getToken() {
        return $this->token;
    }
    
    public function login(CUserIdentity $identity) {
        WebUserService::model()->login($identity);
    }
    
    public function logout() {
        WebUserService::model()->logout($this->token);
    }
    
    
    
    public function __get($name) {
        return $this->offsetGet($name);
    }
    public function offsetExists($offset) {
        return isset($this->userInfo[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->userInfo[$offset]) ? $this->userInfo[$offset] : null;
    }

    public function offsetSet($offset, $value) {
        
    }

    public function offsetUnset($offset) {
        
    }
    
    public function toArray() {
        return $this->userInfo;
    }
    
}