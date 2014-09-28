<?php

class RegisterController extends AdminController {
    
    /**
     * 获取第三方登录名称
     * 
     * @return array
     */
    public function getExtTypes() {
        return array(
            'baidu' => '百度',
            'qq' => 'QQ',
            'alipay' => '支付宝',
            'weibo' => '微博'
        );
    }
    
    public function actionIndex() {
        $search = array(
            'back_act' => (isset($_REQUEST['back_act']) && !empty($_REQUEST['back_act']) ? trim(urldecode($_REQUEST['back_act'])) : ''),
            'ext_login_type' => (isset($_REQUEST['ext_login_type']) && !empty($_REQUEST['ext_login_type']) ? trim($_REQUEST['ext_login_type']) : ''),
            'reg_time_from' => isset($_REQUEST['reg_time_from']) ? trim($_REQUEST['reg_time_from']) : '',
            'reg_time_to' => isset($_REQUEST['reg_time_to']) ? trim($_REQUEST['reg_time_to']) : '',
        );
        $pageSize = 30;
        $page = !empty($_GET['page']) ? $_GET['page'] :  1;

        $criteria = $this->search(new EMongoCriteria(), $search);
        
        if ($search['reg_time_from'] || $search['reg_time_to']) {
            RegisterMgDbModel::model()->setCollectionMonth(date('Ym', strtotime($search['reg_time_from'] ? $search['reg_time_from'] : $search['reg_time_to'])));
        }
        
        $count = RegisterMgDbModel::model()->count($criteria);
        
        $criteria->limit($pageSize);
        $criteria->offset(($page - 1) * $pageSize);
        $criteria->setSort(array('_id' => EMongoCriteria::SORT_DESC));
        
        $list = RegisterMgDbModel::model()->findAll($criteria);
        
        $pagination = new CPagination($count);
        $pagination->pageSize = $pageSize;
        $search_pages = $search;
        $search_pages['back_act'] = urlencode($search_pages['back_act']);
        $pagination->params = $search_pages;
        
        $this->render('index', array(
            'list' => $list,
            'pagination' => $pagination,
            'search' => $search,
            'count' => $count
        ));
    }
    
    private function search(EMongoCriteria $criteria, $params) {
        if ($params['back_act']) {
            $criteria->back_act = new MongoRegex("/{$params['back_act']}/");
        }
        if ($params['ext_login_type']) {
            $criteria->ext_login_type('==', $params['ext_login_type']);
        }
        if ($params['reg_time_to']) {
            $criteria->reg_time('<=', (string)strtotime($params['reg_time_to'].' 23:59:59'));
        }
        if ($params['reg_time_from']) {
            $criteria->reg_time('>=', (string)strtotime($params['reg_time_from']));
        }
        
        return $criteria;
    }
    
}
