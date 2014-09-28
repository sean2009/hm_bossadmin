<?php
/* 
 * 白名单管理
 */
class WhiteIpController extends AdminController{
    public function actionIndex(){
        $model = new OpenapiWhiteListModel('search');
        $model->unsetAttributes();
        if (isset($_POST['OpenapiWhiteListModel'])){
            $model->attributes = $_POST['OpenapiWhiteListModel'];
        }
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $criteria->order = 'id desc';
        $list = OpenapiWhiteListModel::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }
    
    public function actionGet($id) {
        $data = OpenapiWhiteListModel::model()->findByPk($id);
        echo json_encode(array('api_type'=>$data->api_type,'white_ip'=>$data->white_ip));
        Yii::app()->end();
    }
    
    public function actionAdd($name,$ip){
        $data = array('api_type'=>$name,'white_ip'=>$ip,'add_time'=>new CDbExpression('NOW()'),);
        OpenapiWhiteListModel::model()->setIsNewRecord(true);
        OpenapiWhiteListModel::model()->attributes = $data;
        $return = OpenapiWhiteListModel::model()->insert();
        if($return){
            echo json_encode(array('status'=>'success'));
            $this->sendRefresh();
        }else{
            echo json_encode(array('status'=>'error'));
        }
        Yii::app()->end();
    }

    public function actionUpd($id,$name,$ip){
        $data = array('api_type'=>$name,'white_ip'=>$ip,'upd_time'=>new CDbExpression('NOW()'),);
        $return = OpenapiWhiteListModel::model()->updateByPk($id, $data);
        if($return){
            echo json_encode(array('status'=>'success'));
            $this->sendRefresh();
        }else{
            echo json_encode(array('status'=>'error'));
        }
        Yii::app()->end();
    }
    
    public function actionDel($id){
        $ids = explode(',',$id);
        $return = OpenapiWhiteListModel::model()->deleteByPk($ids);
        if($return){
            echo json_encode(array('status'=>'success'));
            $this->sendRefresh();
        }else{
            echo json_encode(array('status'=>'error'));
        }
        Yii::app()->end();
    }
    
    private function sendRefresh(){
        HttpCurl::request('http://lua.shop.com/refresh/');
    }
}
