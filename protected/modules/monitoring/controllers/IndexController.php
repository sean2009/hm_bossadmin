<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class IndexController extends BaseController{
    
    public function actionIndex(){
        $page = !empty($_GET['page']) ? $_GET['page'] :  1;
        $page_size = 30;
        
        $tableName = !empty($_GET['tableName']) ? $_GET['tableName'] : date('Ymd',time());
        MonitoringUrlMgDbModel::model()->setTableTime($tableName);
        
        $criteria = new EMongoCriteria();
        
        if(!empty($_GET['id'])){
            $criteria->id('==', $_GET['id']);
        }
        if(!empty($_GET['session_id'])){
            $criteria->session_id('==', $_GET['session_id']);
        }
        
        
        $count = MonitoringUrlMgDbModel::model()->count($criteria);
        $offset = $page_size * ($page - 1);
        
        $criteria->limit($page_size);
        $criteria->offset($offset);
        $criteria->setSort(array('_id' => EMongoCriteria::SORT_DESC));
        $render['list'] = MonitoringUrlMgDbModel::model()->findAll($criteria);
        
        $pages = new CPagination($count);
        $pages->pageSize = $page_size;
//        $criteria = new CDbCriteria();
//        $pages->applyLimit($criteria);
        $render['pages'] = $pages;
        $render['search'] = $_GET;
        $this->render('index',$render);
    }
    
    public function actionList(){
        $criteria = new EMongoCriteria();
        if(!empty($_GET['url_id'])){
            $criteria->url_id('==', $_GET['url_id']);
        }
        if(!empty($_GET['type'])){
            $criteria->type('==', $_GET['type']);
        }
        if(!empty($_GET['type2'])){
            $criteria->type2('==', $_GET['type2']);
        }
        if(!empty($_GET['type3'])){
            $criteria->type3('==', $_GET['type3']);
        }
        if(!empty($_GET['url'])){
            $criteria->url('==', $_GET['url']);
        }
        $criteria->setSort(array('add_time' => EMongoCriteria::SORT_ASC));
        
        $tableName = date('Ymd',time());
        MonitoringUrlContentMgDbModel::model()->setTableTime($tableName);
        
        $render['list'] = MonitoringUrlContentMgDbModel::model()->findAll($criteria);
        $this->render('list',$render);
    }
}
?>
