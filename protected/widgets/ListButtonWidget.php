<?php
/**
 * 列表按钮控制
 * @author xiaopeng
 * $buttons = array(
 *  array('按钮名称','按钮编码','跳转地址','按钮类型（多选单选）'),
 *  array('按钮名称','按钮编码','跳转地址','按钮类型（多选单选）'),
 * )
 */
class ListButtonWidget extends CWidget{
	public $buttons = array();
        private $priv_buttons = array();
	public function init(){
            //权限控制
            if(Yii::app()->adminuser->admin_id != AdminController::ADMIN_MID){
                $sign_list = Yii::app()->adminuser->sign_list;
                if(empty($sign_list)){
                    return NULL;
                }
            }
            $modelId = Yii::app()->controller->module->getId();
            
            $priv_array = explode(',', $sign_list);
            foreach($this->buttons as $k => $b){
                if(Yii::app()->adminuser->admin_id != AdminController::ADMIN_MID && $modelId != 'power' && !in_array($b[1],$priv_array)){
                    return NULL;
                }
                $this->priv_buttons[$k]['name'] = $b[0];
                $this->priv_buttons[$k]['code'] = $b[1];
                $this->priv_buttons[$k]['url'] = $b[2];
                $this->priv_buttons[$k]['type'] = isset($b[3]) ? $b[3] : 1;
                $this->priv_buttons[$k]['func'] = isset($b[4]) ? $b[4] : '';
                $this->priv_buttons[$k]['options'] = isset($b[5]) ? $b[5] : array();
            }
	}
	
	public function run(){
		$this->render('listbutton',array('list'=>$this->priv_buttons));
	}
}