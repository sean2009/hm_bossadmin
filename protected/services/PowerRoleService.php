<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PowerRoleService extends BaseService{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    /*
     * 查询角色拥有的权限
     */
    public function getRoleSign($role_id) {
        $signs = PowerRoleModel::model()->findByPk($role_id);
        return $signs;
    }
}
