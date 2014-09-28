<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RefundsController extends AdminController {

    public function actionIndex() {
        $model = new ChannelRefundModel('search');
        $model->unsetAttributes();
        if (isset($_POST['ChannelRefundModel'])) {
            $model->attributes = $_POST['ChannelRefundModel'];
        }
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $list = ChannelRefundModel::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }

}
