<?php

/* 
 * 用户验证服务
 * @auth xiaopeng
 */
class WebUserService extends BaseService{
    const TOKEN_NAME = 'bstk';
    
    const CACHE_HEAD = 'sdf2342sdfsd1fsf1';
    const CACHE_KEY_TOKEN_TIME = 60;
    const CACHE_KEY_TOKEN_ACCESS_TIME = 1800;
    
    private $userInfo = array();
    private $token;
    private $cache_key_token;
    private $cache_key_token_access;
    private $user_ip;
    private $user_agent;


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function setCacheKey($token){
        $this->cache_key_token = $key = self::CACHE_HEAD.$token;
        $this->cache_key_token_access = self::CACHE_HEAD.$token . '_lastaccess';
    }
    
    /*
     * 获取初始数据
     */
    public function getInit($token = NULL){
        $this->user_ip = EIp::getIp();
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        if($token == NULL){
            $token = Yii::app()->request->cookies[self::TOKEN_NAME]->value;
        }
        if(empty($token)){
            return NULL;
        }
        $this->token = $token;
        $this->setCacheKey($token);
        
        $user = Yii::app()->cache->get($this->cache_key_token);
        if (!$user) {
            $user = $this->getLoginForToken($token);
            if($user === false){
                return false;
            }
            Yii::app()->cache->set($this->cache_key_token, $user, time() + self::CACHE_KEY_TOKEN_TIME);
        }
        if($this->safeVerif($user) === false){
            return false;
        }
        
        $this->userInfo = $user;
        WebUserService::model()->lastAccess($token);
        return $user;
    }
    /*
     * 安全验证
     */
    protected function safeVerif($user) {
        if(time() - $user['login_time'] > 3600*8){//至少8个小时后需要重新验证登录，即便用户一直在操作。
            return false;
        }
        if($this->token != $this->getNewToken($user, $user['login_time'])){
//            return false;
        }
        return true;
    }
    
    /*
     * 获取初始化后的token值
     */
    public function getToken() {
        return $this->token;
    }
    
    /*
     * 记录更新最后访问时间
     */
    public function lastAccess($token,$is_one = false){
        $this->setCacheKey($token);
        
        if($is_one === FALSE){
            $t = Yii::app()->cache->get($this->cache_key_token_access);
            
            if(!empty($t) && (time() - $t > self::CACHE_KEY_TOKEN_ACCESS_TIME)){
                $this->logout($token);
                return false;
            }
        }
        Yii::app()->cache->set($this->cache_key_token_access, time(), time() + self::CACHE_KEY_TOKEN_ACCESS_TIME + 3600);
        return true;
    }
    
    public function getLoginForToken($token){
        $user = PowerLoginModel::model()->findByAttributes(array('token' => $token));
        $user = $user->attributes;
        if (!$user || $user['is_valid'] == 1) {
            return false;
        }
        return $user;
    }
    /*
     * 传入token判断是否还在登录状态
     */
     public function getIsLogin($token) {
        if($this->lastAccess($token) === false){
            return false;
        }
        return true;
    }
    /*
     * 生成令牌，使用ip和用户信息，防止cookie盗用。
     */
    protected function getNewToken($userInfo,$login_time){
        return md5($userInfo['admin_id'].$userInfo['admin_name'].$this->user_ip.$this->user_agent.$login_time);
    }
    
    public function login(CUserIdentity $identity) {
        $userInfo = $identity->userVal;
        $login_time = time();
        $token = $this->getNewToken($userInfo,$login_time);
        //更新最后登录时间缓存
        $this->lastAccess($token, true);
        //将token写入cookie
        $cookie = new CHttpCookie(self::TOKEN_NAME, $token, array(
            'domain' => COOKIE_DOMAIN,
            'path' => COOKIE_PATH,
            'expire' => 0,
            'httpOnly' => true
        ));
        Yii::app()->request->cookies[self::TOKEN_NAME] = $cookie;
        //将数据写入db
        $data = $userInfo;
        if($data['login_num'] != NULL){
            $data['login_num'] = $data['login_num'] + 1;
        }
        $data['login_time'] = $login_time;
//        $data['login_time'] = new CDbExpression('NOW()');
        $data['token'] = $token;
        $data['login_ip'] = $this->user_ip;
        $model = new PowerLoginModel();
        $model->attributes = $data;
        $model->save();
        
        if(empty($data['login_num'])){
            Yii::app()->request->redirect('/site/upd/type/onelogin.html');
        }
        
        $upd_data['last_login_date'] = new CDbExpression('NOW()');
        if($data['login_num'] != NULL){
            $upd_data['login_num'] = $data['login_num'];
        }
        PowerUserModel::model()->updateByPk($data['admin_id'],$upd_data);
        return true;
    }
    
    /*
     * 退出
     */
    public function logout($token){
        $this->setCacheKey($token);
        Yii::app()->cache->set($this->cache_key_token, NULL, time() - 60);
        Yii::app()->cache->set($this->cache_key_token_access, NULL, time() - 60);
        
        PowerLoginModel::model()->updateByPk($this->userInfo['id'],array('is_valid'=>1));
        setcookie(self::TOKEN_NAME, '', time() - 3600, COOKIE_PATH, COOKIE_DOMAIN);
    }
}
