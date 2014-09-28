<?php
class EController extends CController{
    /**
     *
     * @var cls_cookie
     */
    protected $sess;

    /**
     *
     * @var cls_template 
     */
	public $smarty;
    
    public function init() {
        $this->smarty = Yii::app()->smarty;
		
		$this->smarty -> assign('cookie_domain', COOKIE_DOMAIN);
		$this->smarty -> assign('ecs_charset', EC_CHARSET);
	
		$this->smarty -> assign('jsdomain1', JS_DOMAIN1);
		$this->smarty -> assign('jsdomain2', JS_DOMAIN2);
		$this->smarty -> assign('jsdomain3', JS_DOMAIN3);
		$this->smarty -> assign('jsdomain4', JS_DOMAIN4);
		$this->smarty -> assign('jsdomain5', JS_DOMAIN5);
		
		//CMS的JS域名
		$this->smarty -> assign('datajsdomain1', DATAJS_DOMAIN1);
		$this->smarty -> assign('datajsdomain2', DATAJS_DOMAIN2);	
	
		$this->smarty -> assign('cssdomain1', CSS_DOMAIN1);
		$this->smarty -> assign('cssdomain2', CSS_DOMAIN2);
		$this->smarty -> assign('cssdomain3', CSS_DOMAIN3);
		$this->smarty -> assign('cssdomain4', CSS_DOMAIN4);
		$this->smarty -> assign('cssdomain5', CSS_DOMAIN5);
	
		$this->smarty -> assign('cssversion', CSS_VERSION);
		$this->smarty -> assign('jsversion', JS_VERSION);
		$this->smarty -> assign('nowtime', date("YmdHi", time()));
	
		$this->smarty -> assign('domain_www', DOMAIN_WWW);
		$this->smarty -> assign('domain_shan', DOMAIN_SHAN);
		$this->smarty -> assign('domain_tuan', DOMAIN_TUAN);
		$this->smarty -> assign('domain_user', DOMAIN_USER);
		$this->smarty -> assign('domain_zixun', DOMAIN_ZIXUN);
		$this->smarty -> assign('domain_search', DOMAIN_SEARCH);
		$this->smarty -> assign('domain_gj', DOMAIN_GJ);
		$this->smarty -> assign('domain_zixun', DOMAIN_ZIXUN);
		$this->smarty -> assign('domain_zx', DOMAIN_ZX);
		$this->smarty -> assign('domain_tool', DOMAIN_TOOL);
		$this->smarty -> assign('domain_zxh',DOMAIN_HUI);
		$this->smarty -> assign('domain_hy',DOMAIN_HY);	
		
		$this->smarty -> assign('domain_company','http://zhuangxiu.ec.com/');
		$this->smarty -> assign('domain_sheji','http://sheji.ec.com/');
		
		//页面默认值
		$this->smarty -> assign('pagetitle', '红星抢购');
		$this->smarty -> assign('pagekeywords', '红星抢购');
		$this->smarty -> assign('pagedescription', '红星抢购');
		
        $this->smarty->assign('HTTP_HOST', $_SERVER['HTTP_HOST']);
    }
    
	public function isAjax ()
	{
		if (
			isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
			&& $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") 
			return true;
		return false;
	}
}