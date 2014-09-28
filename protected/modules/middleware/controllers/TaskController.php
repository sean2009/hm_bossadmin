<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class TaskController extends AdminController{
    public function actionIndex(){
        $model = new TaskLogModel('search');
        $model->unsetAttributes();
        if (isset($_POST['TaskLogModel'])){
            $model->attributes = $_POST['TaskLogModel'];
        }
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $criteria->order = 'id desc';
        $list = TaskLogModel::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }
}
