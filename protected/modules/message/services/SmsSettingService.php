<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class SmsSettingService extends BaseService{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function setChannel($content){
        $row = SmsSettingModel::model()->find('sms_type = :type',array('type'=>'1'));
        if($row){
            $data = array(
                'content'=>$content
            );
            return SmsSettingModel::model()->updateByPk($row['id'], $data);
        }else{
            $data = array(
                'sms_type'  => '1',
                'name'  => '短信通道选择',
                'content'=>$content
            );
            SmsSettingModel::model()->attributes = $data;
            return SmsSettingModel::model()->insert();
        }
//         $criteria = new EMongoCriteria();
//         $criteria->type('==', 'channel');
//         $data = SmsSettingMgDbModel::model()->find($criteria);
//         if($data){
//             $data->content = $content;
//             $data->laster_time = time();
//             return $data->save();
//         }else{
//            $model = new SmsSettingMgDbModel();
//            $model->type = 'channel';
//            $model->name = '短信通道选择';
//            $model->content = $content;
//            $model->laster_time = time();
//            return $model->save();
//         }
    }
    
    public function addTypeContent($name,$content = ''){
        $row = SmsSettingModel::model()->find('sms_type = :type and name = :name',array('type'=>'2','name'=>$name));
        if(!empty($row)){
            return false;
        }
        $data = array(
            'sms_type'  => '2',
            'name'  => $name,
            'content'=>$content
        );
        $sms = new SmsSettingModel();
        $sms->setAttributes($data, false);
        return $sms->save();
    }
    
    public function getTypeList(){
        return SmsSettingModel::model()->findAll('sms_type = :type',array('type'=>'2'));
    }
    
    public function getChannelRow(){
        return SmsSettingModel::model()->find('sms_type = :type',array('type'=>'1'));
    }
    
    public function updateType($id,$attributes){
//        SmsSettingModel::model()->attributes = $attributes;
        
        return SmsSettingModel::model()->updateByPk($id, $attributes);
        
        return SmsSettingModel::model()->updateByPk($id);
//        $criteria = new EMongoCriteria();
//        $criteria->type('==', 'type');
//        $criteria->name('==', $name);
//        $data = SmsSettingMgDbModel::model()->find($criteria);
//        foreach($attributes as $key => $val){
//            $data->$key = $val;
//        }
//        return $data->save();
    }
}
?>
