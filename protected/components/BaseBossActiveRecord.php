<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BaseBossActiveRecord extends BaseActiveRecord{
    public function getDbConnection() {
        self::$db = Yii::app()->db;
        return self::$db;
//        if (self::$db !== null){
//            return self::$db;
//        } else {
//            self::$db = Yii::app()->db_boss;
//            if (self::$db instanceof CDbConnection)
//                return self::$db;
//            else
//                throw new CDbException(Yii::t('yii', 'Active Record requires a "db_mid" CDbConnection application component.'));
//        }
    }
}
