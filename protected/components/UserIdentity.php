<?php

class UserIdentity extends CUserIdentity
{
	private $user_id;
    private $user;
    public $extLoginType;
    public $userAgent;
    public $ip;
    public $mallAdminId;
    private $data = array();
    
    public function __construct($params, $extLoginType = '') {
        parent::__construct($params['username'], isset($params['password']) ? $params['password'] : '');
        $this->extLoginType = $extLoginType;
        $this->ip = EIp::getIp();
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->mallAdminId = isset($params['mall_admin_id']) ? $params['mall_admin_id'] : 0;
        
        if (!empty($extLoginType)) {
            $this->data = $params;
        }
    }
    
    public function authenticate() {
        if ($this->extLoginType) {
            $data = $this->data;
        } else {
            $data = array(
                'username' => $this->username,
                'password' => $this->password,
                'user_agent' => $this->userAgent,
                'ip' => $this->ip,
                'mall_admin_id' => $this->mallAdminId
            );
        }
        $ret = LoginService::model()->login($data, $this->extLoginType);
        
        if ($ret && $ret['code'] == 0) {
            $this->errorCode = self::ERROR_NONE;
            $user = $ret['response']['user'];
            $user['user_name'] = isset($this->data['old_qq_user_name']) ? $this->data['old_qq_user_name'] : '';
            
            $this->user_id = $user['user_id'];
            
            $this->setUser($user);
            $this->setState('token', $ret['response']['token']);
        } else {
            $this->errorCode = $ret ? $ret['code'] : self::ERROR_UNKNOWN_IDENTITY;
            switch ($this->errorCode) {
                case 300:
                    $this->errorMessage = '用户不存在';
                    break;
                case 302:
                    $this->errorMessage = '密码错误';
                    break;
                default :
                    $this->errorMessage = '登录失败';
            }
        }
        
        return !$this->errorCode;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function getId() {
        return $this->user_id;
    }
    
//	public function logout(){
//		HttpRequest::setCookie($this->login_token, '',time() - 3);
//	}
}