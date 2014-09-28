<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MenuController extends AdminController{
    public function init(){
        parent::init();
        $this->isAdminManager();
        if(Yii::app()->adminuser->admin_id != self::ADMIN_MID){
            throw new CHttpException(500,'没有权限');
        }
    }
    
    public function actionIndex(){
        $render['list'] = PowerMenuModel::model()->findAll(array(
            'condition' => "is_deleted = 0 and parent_id = 0",
            'order' => 'sort desc,parent_id asc',
        ));
        
        
        LogWebService::addLog('查看菜单列表',__CLASS__.'/'.__FUNCTION__);
        
        $this->render('index', $render);
    }
    
    public function actionTree(){
        $list = PowerMenuModel::model()->findAll(array(
            'condition' => "is_deleted = 0",
            'order' => 'sort desc,parent_id asc',
        ));
        $menuTree = '';
        foreach($list as $v){
            $menuTree .= "{id:$v->id,pId:$v->parent_id,name:\"$v->name\",sign:\"$v->sign\"";
            $menuTree .= ",file:\"".$this->createUrl('upd',array('id'=>$v->id))."\"";
            switch ($v->menu_type){
                case 1:
                    $menuTree .= ",font:{'color':'blue'}";
                    break;
                case 2:
                    $menuTree .= ",font:{'font-style':'italic'}";
                    break;
            }
            if($v->parent_id!=0)
                $menuTree .= ",open:true";
            $menuTree .= "},\n";
        }
        
        
        LogWebService::addLog('查看菜单列表',__CLASS__.'/'.__FUNCTION__);
        
        $this->render('tree', array('menuTree'=>$menuTree));
    }
    
    public function actionGet($parent_id){
        $list = PowerMenuModel::model()->findAll(array(
            'select' => 'id,name,parent_id,menu_type,url_type,sign',
            'condition' => "is_deleted = 0 and parent_id = :parent_id",
            'order' => 'parent_id asc,id asc',
            'params' => array(':parent_id'=>$parent_id),
        ));
        $new = array();
        foreach ($list as $key => $val){
            $new[$key]['id'] = $val->id;
            $new[$key]['name'] = $val->name;
            $new[$key]['menu_type'] = $val->menu_type;
            $new[$key]['url_type'] = $val->url_type;
            $new[$key]['sign'] = $val->sign;
        }
        echo json_encode($new);
        exit;
    }
    
    public function actionAdd($parent_id = 0,$level = 1){
        if(Yii::app()->request->isPostRequest){
            $data = $_POST['Data'];
            $model = new PowerMenuModel();
            $model->attributes = $data;
            if($model->save()){
                echo 'success';
            }else{
                $error = $this->getErrorHtml($model);
                echo implode("\n", $error);
            }
            exit;
        }
        if($parent_id){
            $row = PowerMenuModel::model()->find(array(
                'select' => 'id,name,parent_id,level,menu_type,url_type,sort',
                'condition' => "is_deleted = 0 and id = :id",
                'params' => array(':id'=>$parent_id),
            ));
            $render['parent_name'] = $row->name;
        }else{
            $render['parent_name'] = '跟菜单';
        }
        $render['parent_id'] = $parent_id;
        echo $this->renderPartial('add',$render);
        exit;
    }
    
    public function actionUpd($id){
        $row = PowerMenuModel::model()->find(array(
            'select' => 'id,name,parent_id,level,menu_type,url_type,url,sign,sort',
            'condition' => "is_deleted = 0 and id = :id",
            'params' => array(':id'=>$id),
        ));
        if(Yii::app()->request->isPostRequest){
            $data = $_POST['Data'];
            $row->attributes = $data;
            if($row->save()){
                echo 'success';
            }else{
                $error = $this->getErrorHtml($row);
                echo implode("\n", $error);
            }
            exit;
//            PowerMenuModel::model()->updateByPk($id, $data);
            
        }
//        $row = PowerMenuModel::model()->find(array(
//            'select' => 'id,name,parent_id,level,menu_type,url,sign,sort',
//            'condition' => "is_deleted = 0 and id = :id",url_type,
//            'params' => array(':id'=>$id),
//        ));
        $render['row'] = $row;
        $render['menu_type_array'] = array('菜单','按钮','隐藏列');
        $render['url_type_array'] = array('默认','团购','商城');
        $render['parent_id'] = $id;
        $render['parent_name'] = $row->name;
        echo $this->renderPartial('upd',$render);
    }
    
    public function actionDel($id){
        $count = PowerMenuModel::model()->count('is_deleted = 0 and parent_id = '.(int)$id);
        if($count > 0){
            die('当前菜单还有下级菜单，不能删除');
        }else{
            PowerMenuModel::model()->deleteByPk($id);
            die('success');
        }
    }
//    
//    public function actionSss(){
//        $sql = 'select action_id,action_name,parent_id,action_url,action_code from eai_admin_action where is_deleted = 0 and parent_id = 0';
//        $list = Yii::app()->db->createCommand($sql)->queryAll();
//        $this->insMenu($list,33);
//    }
    
    public function getUrlUpd($url){
        $url = str_replace('http://malladmin.shop.com/admin', '',$url);
        $url = str_replace('http://tuanadmin.shop.com/admin', '',$url);
        return $url;
    }
    
    public function getCodeSign($url){
        if(strstr($url,'default.php')){
            $url = str_replace('/default.php?', '', $url);
            parse_str($url);
            return 'sc_'.$con.'_'.$act;
        }elseif (strstr($url,'main.php')) {
            $url = str_replace('/main.php?', '', $url);
            parse_str($url);
            return 'sc_'.$at.'_'.$st;
        }elseif (strstr($url,'privilege.php')) {
            $url = str_replace('/privilege.php?', '', $url);
            parse_str($url);
            return 'sc_privilege_'.$act;
        }elseif(strstr($url,'/')){
            return str_replace('/', '_', $url);
        }else{
            return $url;
        }
    }


    public function insMenu($list,$insert_id = NULL,$action_id = NULL){
        $db = Yii::app()->db->createCommand();
        foreach($list as $val){
            $db->reset();
            $action_url = $this->getUrlUpd($val['action_url']);
            $db->insert('eai_power_menu', array(
                'parent_id' => $insert_id,
                'name' => $val['action_name'],
                'url' => $action_url,
                'sign' => $this->getCodeSign($action_url),
                'url_type'  => 2,
                'add_time' => new CDbExpression('NOW()'),
            ));
            $insert2_id = Yii::app()->db->getLastInsertID();
            $db->reset();
            $sql = 'select action_id,action_name,parent_id,action_url,action_code from eai_admin_action where is_deleted = 0 and parent_id = '.$val['action_id'];
            $list2 = Yii::app()->db->createCommand($sql)->queryAll();
            $db->reset();
            $this->insMenu($list2,$insert2_id,$val['action_id']);
        }
        if(empty($list)){
            $sql = 'select button_name,button_url,button_code from eai_admin_button where is_deleted = 0 and action_id = '.$action_id;
            $list3 = Yii::app()->db->createCommand($sql)->queryAll();
            foreach($list3 as $val){
                $url = $this->getUrlUpd($val['button_url']);
                $db->insert('eai_power_menu', array(
                    'parent_id' => $insert_id,
                    'name' => $val['button_name'],
                    'url' => $url,
                    'sign' => $this->getCodeSign($url),
                    'url_type'  => 2,
                    'menu_type' => 1,
                    'add_time' => new CDbExpression('NOW()'),
                ));
            }
        }
    }
}
