<?php

class LogController extends AdminController {
    public function init(){
        parent::init();
        $this->isAdminManager();
        if(Yii::app()->adminuser->admin_id != self::ADMIN_MID){
            throw new CHttpException(500,'没有权限');
        }
    }
    
    public function actionIndex() {
        $search = array(
            'url' => (isset($_REQUEST['url']) && !empty($_REQUEST['url']) ? trim(urldecode($_REQUEST['url'])) : ''),
            'admin_id' => (isset($_REQUEST['admin_id']) && !empty($_REQUEST['admin_id']) ? trim($_REQUEST['admin_id']) : ''),
            'admin_tname' => (isset($_REQUEST['admin_id']) && !empty($_REQUEST['admin_tname']) ? trim($_REQUEST['admin_tname']) : ''),
            'time_start' => isset($_REQUEST['time_start']) ? trim($_REQUEST['time_start']) : '',
            'time_end' => isset($_REQUEST['time_end']) ? trim($_REQUEST['time_end']) : '',
        );
        $pageSize = 30;
        $page = !empty($_GET['page']) ? $_GET['page'] :  1;

        $criteria = $this->search(new EMongoCriteria(), $search);
        
        
        $count = LogMgDbModel::model()->count($criteria);
        
        $criteria->limit($pageSize);
        $criteria->offset(($page - 1) * $pageSize);
        $criteria->setSort(array('_id' => EMongoCriteria::SORT_DESC));
        
        $list = LogMgDbModel::model()->findAll($criteria);
        
        $pagination = new CPagination($count);
        $pagination->pageSize = $pageSize;
        $search_pages = $search;
        $search_pages['url'] = urlencode($search_pages['url']);
        $pagination->params = $search_pages;
        
        $this->render('index', array(
            'list' => $list,
            'pagination' => $pagination,
            'search' => $search,
            'count' => $count
        ));
    }
    
    private function search(EMongoCriteria $criteria, $params) {
        if ($params['url']) {
            $criteria->url = new MongoRegex("/{$params['url']}/");
        }
        if ($params['admin_id']) {
            $criteria->ext_login_type('==', $params['admin_id']);
        }
        if ($params['admin_tname']) {
            $criteria->admin_tname('==', $params['admin_tname']);
        }
        if ($params['time_start']) {
            $criteria->time_start('<=', (string)strtotime($params['time_start'].' 23:59:59'));
        }
        if ($params['time_end']) {
            $criteria->time_end('>=', (string)strtotime($params['time_end']));
        }
        
        return $criteria;
    }
    
}
