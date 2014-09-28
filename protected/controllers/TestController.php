<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TestController extends BaseController{
    public function actionIndex(){
        
//        $sql = "INSERT INTO SC_ORDER_ACTION(ACTION_ID, ORDER_ID, ACTION_USER, ORDER_STATUS, SHIPPING_STATUS, PAY_STATUS, ACTION_NOTE)
//					VALUES(SEQ_SC_ORDER_ACTION_ID.NEXTVAL, :ORDER_ID, :USER_ID, :ORDER_STATUS, :SHIPPING_STATUS, :PAY_STATUS, :ACTION_NOTE)";
        $arr_a = array();
        $arr_a['ACTION_ID'] = new CDbExpression('SEQ_SC_ORDER_ACTION_ID.NEXTVAL');
        $arr_a['ORDER_ID'] = 1;
        $arr_a['ACTION_USER'] = 'ACTION_USER';
        $arr_a['ORDER_STATUS'] = 1;
        $arr_a['SHIPPING_STATUS'] = 1;
        $arr_a['PAY_STATUS'] = 1;
        $arr_a['ACTION_NOTE'] = 'ACTION_NOTE';
        
        $cmd = Yii::app()->db_sc->createCommand()->insert('sc_order_action', $arr_a);
        die;
        $arr_a = array();
        $arr_a['AD_ID'] = new CDbExpression('SEQ_SC_ORDER_ACTION_ID.NEXTVAL');
        $arr_a['POSITION_ID'] = 1;
        $arr_a['MEDIA_TYPE'] = 1;
        $arr_a['AD_CODE'] = 'sssssss';
        $arr_a['START_TIME'] = 1;
        $arr_a['END_TIME'] = 1;
        $arr_a['CLICK_COUNT'] = 1;
        $arr_a['ENABLED'] = 1;
        
        $cmd = Yii::app()->db_sc->createCommand()->insert('ecs_ad', $arr_a);
    }
}