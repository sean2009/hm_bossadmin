<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class SmsBlanklistController extends AdminController{
    public function actionIndex(){
        $model = new SmsBlanklistModel('search');
        $model->unsetAttributes();
        if (isset($_POST['SmsBlanklistModel'])){
            $model->attributes = $_POST['SmsBlanklistModel'];
        }
        
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $criteria->order = 'id desc';
        $list = SmsBlanklistModel::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }
    
    public function actionAdd(){
        $model = new SmsBlanklistModel();
        if(Yii::app()->request->isPostRequest){
            $model->attributes = $_POST['SmsBlanklistModel'];
            if($model->validate() && $model->save()){
                $this->redirect($this->createUrl('index'));
            }
        }
        $this->render('add',array('model'=>$model));
    }
    
    public function actionDel($ids){
        if(!is_int($ids)){
            $ids = explode(',',$ids);
        }
        $return = SmsBlanklistModel::model()->deleteByPk($ids);
        if($return){
            echo json_encode(array('status'=>'success'));
        }else{
            $errors = SmsBlanklistModel::model()->getErrors();
            echo json_encode(array('status'=>'error','msg'=> $errors ));
        }
        exit;
    }
}
?>
