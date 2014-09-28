<?php
/*
 * 日志
 */
class LogController extends BaseController{
    
    public function actionError($page = 1,$type = '',$start_time = '',$end_time = ''){
//        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
//        $type = !empty($_POST['type']) ? $_POST['type'] : '';
//        $start_time = !empty($_GET['start_time']) ? $_GET['start_time'] : '';
//        $end_time = !empty($_GET['end_time']) ? $_GET['end_time'] : '';
        $page_size = 20;
        $criteria = new EMongoCriteria();

        if (!empty($params['type'])){
            $criteria->type('==', $params['type']);
        }
        if (!empty($params['typeName'])){
            $criteria->typeName('==', $params['typeName']);
        }
        if (!empty($params['start_time'])){
            $criteria->add_time('>=', "{$params['start_time']}");
        }
        if (!empty($params['end_time'])){
            $criteria->add_time('<=', "{$params['end_time']}");
        }
        $criteria->setSort(array('add_time' => EMongoCriteria::SORT_DESC));

        $count = MiddlewareErrorLogMgDbModel::model()->count($criteria);

        if (empty($params['page'])){
            $params['page'] = 1;
        }
        $limit = 20;
        if ($params['page'] == 1) {
            $offset = 0;
        } else {
            $offset = $limit * (intval($params['page']) - 1);
        }

        $criteria->limit($limit);
        $criteria->offset($offset);
        $list = MiddlewareErrorLogMgDbModel::model()->findAll($criteria);
        
//        
//        $criteria = new CDbCriteria();
//        $criteria->compare('type',$type);
//        $criteria->compare('start_time',$start_time);
//        $criteria->compare('end_time',$end_time);
        $pages = new CPagination($count);
        $pages->pageSize = $page_size;
        $pages->applyLimit($criteria);
        
        $this->render('index', array(
            'list' => $list,
            'pages' => $pages,
            'search'  => array('type'=>$type,'start_time'=>$start_time,'end_time'=>$end_time),
        ));
    }
}