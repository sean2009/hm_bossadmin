<?php
class EailogController extends AdminController{
	public $layout = false;
	
	 
	//日志
	public function actionIndex(){
		 
		$data['opter_action'] = !empty($_POST['opter_action']) ? $_POST['opter_action'] : '';
		$data['start_time'] = !empty($_POST['start_time']) ? $_POST['start_time'] : '';
		$data['end_time'] = !empty($_POST['end_time']) ? $_POST['end_time'] : '';
		
		$data['page'] = !empty($_POST['page']) ? $_POST['page'] : 1;
		$list = LogWebService::getLogs($data);
		
		$render['list'] = $list['response']['list'];
		$render['pages'] = $list['response']['pages'];
		  //菜单 所有
        $_listAct = AdminActionModel::model()->findAll(array(
            'condition' => 'is_deleted = 0 ',
            'order' => 'action_desc desc',
        ));
		 foreach ((array) $_listAct as $k => $v) {
		 	$opterAct[strtolower($v['action_code'])] = $v['action_name'];
            if ($v['parent_id'] == 0)
                $listAct[$v['action_id']]['info'] = $v;
            if ($v['parent_id'] > 0)
                $listAct[$v['parent_id']]['list'][$v['action_id']] = $v;
        }
        foreach ((array) $listAct as $k => $v) {
            if (empty($v['info']) && !empty($v['list']))
                unset($listAct[$k]);
        }
        
         $logData = array(
		            'opter_action' => 'eailog',
		            'opter_name' => Yii::app()->adminuser->admin_name,
             		'opter_admin_id' => Yii::app()->adminuser->admin_id,
		            'content' => '查看日志列表',
		        );
       	 LogWebService::setLogs($logData);
        
        
       // print_r((array)$listAct);
        $render['listAct'] = $listAct;
        $render['opterAct'] = $opterAct;
        $render['search'] = $data;
		$this->render('index',$render);
	}
	  
}