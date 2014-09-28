<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MemcacheController extends AdminController {

    public function actionIndex() {
        $render = array();
        $server = !empty($_REQUEST['server']) ? $_REQUEST['server'] : array();
        $type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $key = !empty($_REQUEST['key']) ? $_REQUEST['key'] : '';
        $hashKey = !empty($_REQUEST['hashKey']) ? $_REQUEST['hashKey'] : '';
        
        if(!empty($server)){
            $server_configs = $this->getMemcacheConfig($server);
            
            $cache = new MemcacheExt();
            $cache->setServers($server_configs);
            
            if($hashKey == 1){
                $key = md5($key);
            }
            
            if($type == 'status'){
                $render['show'] = $cache->show();
            }elseif($type == 'del'){
                $render['show'] = $cache->delete($key);
                $_REQUEST['type'] = 'key';
            }elseif($type == 'key'){
                 $data = $cache->get($key);
                 $data_dejson = json_decode($data,true);
                 $data_ser = unserialize($data);
                 if($data_dejson !== NULL){
                     $render['data'] = $data_dejson;
                 }elseif($data_ser !== NULL){
                     $render['data'] = $data_ser;
                 }else{
                     $render['data'] = $data;
                 }
            }elseif($type=='showlist'){
                $keys = $cache->keylist();
                $str = '';
                foreach ($keys as $key) 
		{
			if($keyname!='')
			{
				if(substr($key[0],0,strlen($keyname))!=$keyname) continue;
			}
			$str .= $key[0] . "----过期时间：$key[1]秒" . '<a href="show.php?key='.$key[0].'">查看</a>|<a href="show.php?type=delete&key='.$key[0].'">清除</a><br/>';
		}
                $render['show'] = $str;
            }
            
        }
        $render['servers'] = $this->getMemcacheConfig();
        $this->render('index',$render);
    }

    protected function getMemcacheConfig($ids = array()) {
        $configs = Yii::app()->params['memcache'];
        if(empty($ids)){
            return $configs;
        }
        $return = array();
        foreach($ids as $id){
            $return[] = $configs[$id];
        }
        return $return;
    }

}

?>
