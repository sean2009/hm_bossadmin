<?php

/* 
 * 暂时未使用
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PowerUserWebService extends BaseService{
    
    public static function getTokenLoginUrl(){
        return array(
            POWER_MADMIN_URL,
//            POWER_SHOPADMIN_URL
        );
    }
    
    public static function login($token){
        foreach (self::getTokenLoginUrl() as $key => $value) {
            HttpCurl::request($value.'/login.php?act=login&token='.$token);
        }
    }
    
    public static function logout(){
        foreach (self::getTokenLoginUrl() as $key => $value) {
            HttpCurl::request($value.'/login.php?act=logout');
        }
    }
    
    
}
