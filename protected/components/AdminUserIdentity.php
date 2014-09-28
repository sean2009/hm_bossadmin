<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminUserIdentity extends CUserIdentity {

    public $userVal;
    public $token;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $users = PowerUserModel::model()->findByAttributes(array('admin_name' => $this->username, 'passwd' => md5($this->password), 'is_deleted' => 0,));
        if (!empty($users)) {
            $this->userVal = $users->attributes;
            $signs = PowerRoleService::model()->getRoleSign($this->userVal['role_id']);
            $sign_list = $signs->sign_list;
            $this->userVal['sign_list'] = $sign_list;
//            $this->token = $this->setNewToken();
            $this->errorCode = self::ERROR_NONE;
        } else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        return !$this->errorCode;
    }
    
    protected function setNewToken(){
        $ip = EIp::getIp();
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        return md5($this->userVal['admin_id'].$this->userVal['admin_name'].$ip.$userAgent.time());
    }
}
