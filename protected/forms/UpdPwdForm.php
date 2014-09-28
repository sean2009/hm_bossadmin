<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UpdPwdForm extends CFormModel {

    public $oldPwd;
    public $newPwd;
    public $newPwd2;
    public $type;

    public function rules() {
        return array(
            array('oldPwd,newPwd,newPwd2', 'required'),
            array('oldPwd,newPwd,newPwd2', 'length','min' => 6, 'max' => 16),
            array('oldPwd','valiOldPwd'),
            array('newPwd','compare','compareAttribute'=>'oldPwd','operator'=>'!=','message'=>'新密码不能和原密码相同！'),
            array('newPwd2','compare','compareAttribute'=>'newPwd','operator'=>'==','message'=>'重复新密码和新密码必须相同！'),
            array('newPwd','valiNewPwd'),
        );
    }
    
    public function valiOldPwd(){
        if($this->oldPwd){
            $row = PowerUserModel::model()->findByPk(Yii::app()->adminuser->admin_id);
            if($row->passwd != md5($this->oldPwd)){
                $this->addError('oldPwd', '原密码不正确！');
                return false;
            }
        }
        return true;
    }
    
    public function valiNewPwd(){
        if($this->newPwd){
            if(is_numeric($this->newPwd)){
                $this->addError('newPwd', '新密码请不要使用纯数字或其他简单的密码！');
                return false;
            }
        }
        return true;
    }
    

    public function attributeLabels() {
        return array(
            'oldPwd' => '原密码',
            'newPwd' => '新密码',
            'newPwd2' => '重复新密码',
        );
    }
    
    public function update(){
        $data['passwd'] = md5($this->newPwd);
        if($this->type == 'onelogin'){
            $data['login_num'] = 1;
        }
        return PowerUserModel::model()->updateByPk(Yii::app()->adminuser->admin_id, $data);
    }
}
