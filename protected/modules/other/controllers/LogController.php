<?php

/* 
 * 通用日志访问接口
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class LogController extends AdminController{
    
    public function actionIndex(){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if($page < 1){
            $page = 1;
        }
        $page_size = 30;
        $table_name = !empty($_REQUEST['table_name']) ? $_REQUEST['table_name'] : '';
        $db_name = !empty($_REQUEST['db_name']) ? $_REQUEST['db_name'] : 'log';
        $find = !empty($_REQUEST['find']) ? $_REQUEST['find'] : array();
        $sort = !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : array();
        $search = $_GET;
        $render = array();
        if(!empty($table_name)){
            $con = Yii::app()->mongodb->getConnection();
            $db = $con->selectDB($db_name);
            if(!empty($find)){
                eval('$find =' . $find . ';');
            }
            if(!empty($sort)){
                eval('$sort =' . $sort . ';');
            }
            $cursor = $db->$table_name->find($find)->sort($sort)->skip(($page-1)*$page_size)->limit($page_size);
//            $array= iterator_to_array($cursor);
//            print_r($array);die;
            $render['cursor'] = $cursor;
        }
        $search['page'] = $page-1;
        $render['page_s'] = http_build_query($search);
        $search['page'] = $page+1;
        $render['page_n'] = http_build_query($search);
        $this->render('index',$render);
    }
}
