<?php

/* 
 * 异常订单管理
 * @auther xiao.peng740
 */

class OrderController extends AdminController{
    /*
     * 全部订单列表
     */
    public function actionIndex(){
        $model = new ChannelOrderModel('search');
        $model->unsetAttributes();
        if (isset($_POST['ChannelOrderModel'])){
            $model->attributes = $_POST['ChannelOrderModel'];
        }
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $criteria->order = 'id desc';
        $list = ChannelOrderModel::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }
    
    /*
     * 异常订单列表
     */
    public function actionError(){
        $model = new ChannelOrderModel('search');
        $model->unsetAttributes();
        $model->sys_is_synch = -1;
        if (isset($_POST['ChannelOrderModel'])){
            $model->attributes = $_POST['ChannelOrderModel'];
        }
        $criteria = $model->search()->getCriteria();
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $list = ChannelOrderModel::model()->findAll($criteria);

        $this->render('error', array(
            'model' => $model,
            'list' => $list,
            'pages' => $pages
        ));
    }
    
    /*
     * 订正异常订单的 outer_iid 和 outer_sku_id
     */
    public function actionUpdate($ids){
        $ids = (int)$ids;
        $render['is_success'] = 0;
        if (isset($_POST['Data'])){
            foreach($_POST['Data'] as $id => $val){
                ChannelOrderGoodsModel::model()->updateByPk($id, $val);
            }
            $render['is_success'] = 1;
        }
        $render['order'] = ChannelOrderModel::model()->findByPk($ids);
        $render['goods'] = ChannelOrderGoodsModel::model()->findAll('order_id = :order_id',array('order_id'=>$ids));
        $this->render('update',$render);
    }
    
    public function actionSku($order_id,$supplier_id,$order_goods_id,$sku){
        $params = array(
            'sku_code' => $sku,
            'supplier_id' => $supplier_id
        );
        $result = ScWebService::getGoodsSku($params);
        if($result['code'] != 0){
            $data = array('code'=>'error','msg'=>$result['message']);
        }elseif($result['code']==0){
            if(count($result['response']) == 1){
                $data = array('code'=>'success','msg'=>'校对成功：'.$result['response'][0]['goods_sku']);
                $this->setSelSku($order_id,$order_goods_id,$sku,$result['response'][0]);
            }else{
                $data = array('code'=>'throw','msg'=>$this->getSkuList($result['response']));
            }
        }
        echo json_encode($data);
        Yii::app()->end();
    }
    
    public function actionUpdateSku($order_id,$order_goods_id,$outer_sku_id,$goods_id,$goods_sn,$goods_sku){
        $response = array(
            'goods_id'  => $goods_id,
            'goods_sn'  => $goods_sn,
            'goods_sku' => $goods_sku,
        );
        $return = $this->setSelSku($order_id, $order_goods_id,$outer_sku_id, $response);
        if($return === true){
            $data = array('code'=>'success');
        }else{
            $data = array('code'=>'error','msg'=>$return);
        }
        echo json_encode($data);
        Yii::app()->end();
    }
    
    private function getSkuList($response){
        $data = '<table width="500" border="1" cellpadding="0" cellspacing="0">';
        $data.= '<tr><td align="center">选择</td><td>商品编号</td><td>商品SN</td><td>SKU编码</td><td>SKU价格</td></tr>';
        foreach ($response as $val){
            $data.= "<tr><td><input type='radio' name='sku_radio' class='sku_radio' value='".$val['goods_sku']."' sel_goods_id='".$val['goods_id']."' sel_goods_sn='".$val['goods_sn']."'></td>"
                    . "<td>{$val['goods_id']}</td><td>{$val['goods_sn']}</td><td>{$val['goods_sku']}</td><td>{$val['sku_price']}</td></tr>";
        }
        $data.= '</table>';
        return $data;
    }
    
    private function setSelSku($order_id,$order_goods_id,$outer_sku_id,$response){
        $db = Yii::app()->db_mid->createCommand();
        try {
            $db->update('bc_channel_order_goods', array('outer_sku_id'=>$outer_sku_id,'sys_goods_id' => $response['goods_id'],'sys_goods_sn' => $response['goods_sn'], 'sys_goods_sku_id' => $response['goods_sku']), 'id = :id', array('id' => $order_goods_id));
            $db->update('bc_channel_order', array('sys_is_synch' => 1), 'id = :id', array('id' => $order_id));
            return true;
        } catch (CDbException $ex) {
            return $ex->getMessage();
        }
        
    }
}

