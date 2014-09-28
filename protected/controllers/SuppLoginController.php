<?php

/* 
 * 供应商商户统一登录---数据迁移脚本
 */
class SuppLoginController extends BaseController{
    /*
     * 商城供应商迁移
     */
    public function actionScSupp(){
        //管理员
        $sql = 'SELECT SUPPLIER_NAME,SUPP_LOG_NAME,SUPP_LOG_PWD from ECS_SUPPLIERS where IS_CHECK=1 AND SUPP_CATEGORY=1';
        //子账户
        $sql = 'select id,parent_id,login_name,is_deleted from sc_subaccount where LOGIN_NAME = :supplier_username and LOGIN_PWD = :password  and parent_id in (select supplier_id from ECS_SUPPLIERS where SUPPLIER_NAME=:supplier_name)';
        
        
    }
}
