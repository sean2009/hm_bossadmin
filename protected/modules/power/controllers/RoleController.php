<?php

/**
 * @todo 角色管理
 * @author chuanheng
 * @since 2014-01-17
 */
class RoleController extends AdminController{
    
    public function init(){
        parent::init();
        $this->isAdminManager();
    }
    
    public function actionIndex(){
        $model = new PowerRoleModel('search');
        $model->unsetAttributes();
        if (isset($_POST['PowerRoleModel'])){
            $model->attributes = $_POST['PowerRoleModel'];
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
        $criteria->order = 'id desc';
        $list = PowerRoleModel::model()->findAll($criteria);
        foreach ($list as $val){
            $user_ids[$val->add_admin_id] = $val->add_admin_id;
            $user_ids[$val->edit_admin_id] = $val->edit_admin_id;
        }
        $list_user = PowerUserModel::model()->findAllByPk($user_ids);
//        var_dump($list_user);
        foreach($list_user as $v){
            $list_u[$v->admin_id] = $v->admin_tname;
        }
//        var_dump($list_u);
        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages,
            'list_user' => $list_u
        ));
    }
    
    public function actionAdd(){
        $model = new PowerRoleModel();
        if(Yii::app()->request->isPostRequest){
            $model->attributes = $_POST['PowerRoleModel'];
            if($model->save()){
                $this->redirect($this->createUrl('index'));
            }
        }
        $menutree = $this->getMenuTree($model->sign_ids);   
        $this->render('add',array('model'=>$model,"menuTree"=>$menutree));
        
    }
    
    public function actionUpd($ids){
    	if(isset($_GET['ids']))
    	{
    		$condition='';
    		$model=PowerRoleModel::model()->findByPk($_GET['ids'], $condition);
    	}
    	if($model===null)
    		throw new CHttpException(404,'The requested page does not exist.');
		if(isset($_POST['PowerRoleModel']))
		{
			$model->attributes=$_POST['PowerRoleModel'];
			if($model->save())
				$this->redirect($this->createUrl('index'));
		}
        $menutree = $this->getMenuTree($model->sign_ids);
    	$this->render('upd',array('model'=>$model,'menuTree'=>$menutree));
    }
    
    private function getMenuTree($sign_ids=""){
        //获取菜单
         $menutree = PowerMenuService::model()->getTree($this->admin_id,$this->role_id);
       
         //添加checked
         if(!empty($sign_ids)){
             $sign_ids_arr = explode(",",$sign_ids);
             foreach($menutree as $key=>$val){
                 if(in_array($val['id'],$sign_ids_arr)){
                     $menutree[$key]["checked"] = true;
                 }
             }
         }
         return json_encode($menutree);
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
