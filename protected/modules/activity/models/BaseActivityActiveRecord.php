<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class BaseActivityActiveRecord extends EOracleActiveRecord{
    
    public function getDbConnection() {
        if(self::$db!==null)
                return self::$db;
        else
        {
                self::$db=Yii::app()->getDb();
                if(self::$db instanceof EOracleDB)
                        return self::$db;
                else
                        throw new CDbException(Yii::t('yii','Active Record requires a "db" EOracleDB application component.'));
        }
    }
}
?>
