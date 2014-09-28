<?php
class ScWebService extends BaseWebService{
    
    public static $api_goods_url = API_SUPPLIERS_URL;
    public static $api_order_url = API_ORDER_URL;
    
    public static function getGoodsSku($params){
        $return = API_Client::call(self::$api_goods_url, 'goods/getSupplierGoodsInfo', $params);
        $return = json_decode($return,true);
        if($return['code'] != 0){
//            MidLogService::midErrors('ScWebService::getGoodsSku', '', $return);
        }
        return $return;//$return['response'];
    }
    
}