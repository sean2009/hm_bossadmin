<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PowerMenuService extends BaseService {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 获取当前用户所拥有的权限菜单列表
     */

    public function getPowerMenuList($admin_id, $role_id) {
        $condition = 'is_deleted = 0 and menu_type = 0';
        if ($admin_id != AdminController::ADMIN_MID) {
            $signs = PowerRoleService::model()->getRoleSign($role_id);
            $sign_ids = $signs->sign_ids;
            $condition .= ' and id in ('.$sign_ids.')';
        }

        $list = PowerMenuModel::model()->findAll(array(
            'select' => 'id,name,parent_id,sign,url,url_type',
            'condition' => $condition,
            'order' => 'parent_id asc'
        ));
        $_menu = array();
        foreach ($list as $k => $v) {
            $_menu[$v->parent_id][$k]['id'] = $v->id;
            $_menu[$v->parent_id][$k]['name'] = $v->name;
            $_menu[$v->parent_id][$k]['sign'] = $v->sign;
            $_menu[$v->parent_id][$k]['url'] = $v->url;
            $_menu[$v->parent_id][$k]['url_type'] = $v->url_type;
        }
        return $_menu;
    }

    public function getTree($admin_id, $role_id) {
        $condition = 'is_deleted = 0';
        if ($admin_id != AdminController::ADMIN_MID) {
            $signs = PowerRoleService::model()->getRoleSign($role_id);
            $sign_ids = $signs->sign_ids;
            $condition .= ' and id in ('.$sign_ids.')';
        }
        $_data = array();
        $data = PowerMenuModel::model()->findAll(array(
            'select' => 'id,name,parent_id,sign,menu_type,url_type',
            'condition' => $condition,
            'order' => 'parent_id asc'
        ));
        foreach ($data as $key => $val) {
            $v['id'] = $val['id'];
            $v['name'] = $val['name'];
            $v['pId'] = $val['parent_id'];
            $v['open'] = true;
            $v['cid'] = $val['id'];
            $v['sign'] = $val['sign'];
            $v['menu_type'] = $val['menu_type'];
            $v['url_type'] = $val['url_type'];
            $_data[] = $v;
        }
        return $_data;
    }

}
