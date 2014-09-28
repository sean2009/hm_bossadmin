<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserController extends AdminController{
    public function init(){
        parent::init();
        $this->isAdminManager();
    }
    
    public function actionIndex(){
        $model = new PowerUserModel('search');
        $model->unsetAttributes();
        if (isset($_POST['PowerUserModel'])){
            $model->attributes = $_POST['PowerUserModel'];
        }
        $model->is_deleted = 0;
        if($this->admin_id != self::ADMIN_MID){
            $model->add_admin_id = $this->admin_id;
        }
        
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $criteria->order = 'admin_id desc';
        $list = PowerUserModel::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }
    
    public function actionAdd(){
        $model = new PowerUserModel();
        $model->scenario = 'add';
        if(Yii::app()->request->isPostRequest){
            $model->attributes = $_POST['PowerUserModel'];
            if($model->validate() && $model->save()){
                $this->redirect($this->createUrl('index'));
            }
        }
        $this->render('add',array('model'=>$model));
        
    }
    

    public function actionUpd($ids){
        
        $model = PowerUserModel::model()->findByPk($ids);
        if(Yii::app()->request->isPostRequest){
            $model->attributes = $_POST['PowerUserModel'];
            $model->scenario = 'upd';
            if($model->validate() && $model->save()){
                $this->redirect($this->createUrl('index'));
            } 
        }
        $this->render('upd',array('model'=>$model));
    }
    
    public function actionResetPwd($ids){
        $data['passwd'] = md5('hm123456');
        $data['login_num'] = NULL;
        PowerUserModel::model()->updateByPk($ids, $data);
        echo json_encode(array('status'=>'success'));
        exit;
    }
    
    public function actionDel($ids){
        if($ids == $this->admin_id){
            echo json_encode(array('status'=>'error','msg'=> '不能删除自己！' ));
            exit;
        }
        if($ids == self::ADMIN_MID){
            echo json_encode(array('status'=>'error','msg'=> '不能删除超级管理员！' ));
            exit;
        }
        $data['is_deleted'] = 1;
        $return = PowerUserModel::model()->updateByPk($ids, $data);
        if($return){
            echo json_encode(array('status'=>'success'));
        }else{
            $errors = PowerUserModel::model()->getErrors();
            echo json_encode(array('status'=>'error','msg'=> $errors ));
        }
        exit;
    }
    
    public function setDropListArray($data,$key,$val) {
        $new_arr = array();
        $new_arr[''] = '请选择';
        foreach($data as $k => $v) {
            $new_arr[$v->$key] = $v->$val;
        }
        return $new_arr;
    }
}
