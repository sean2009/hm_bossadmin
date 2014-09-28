<?php
/**
 * Enter description here ...
 * @author xiaopeng
 *
 */
abstract class BaseModel {
	/**
	 * 数据库连接cls_oracle/mysql
     * @var cls_oracle Description
	 */
	public $db,$db_m,$db_mmall;
    
    /**
     *
     * @var cls_oracle
     */
    public $db_zx;
    public $eai;

	/**
	 * memcache数据库
     * @var base_memcached Description
	 */
	public $cache;
    
    /**
     * 存放一些错误信息
     * 
     * @var array 
     */
    private $errors = array();


    /**
	 * 单例模式,类对象保存
	 * @var array
	 */
	private static $_models = array();
	function __construct() {
		$this -> db = Yii::app()->dbc;
		$this -> eai = Yii::app()->eai;
		$this -> db_zx = Yii::app()->db_zx;
		//$this->db_m = Yii::app()->db_m;
		$this -> cache = Yii::app()->oldCache;
	}

	/**
	 * 单例模式
	 * @param string $className
     * @return BaseModel 
	 */
	public static function model($className = __CLASS__) {
		if (isset(self::$_models[$className]))
			return self::$_models[$className];
		else {
			$model = self::$_models[$className] = new $className(null);
			return $model;
		}
	}
    
    public function addError($attribute, $msg) {
        $this->errors[$attribute] = $msg;
    }
    
    /**
     * 获取全部的错误信息
     * 
     * @param string $attribute
     * @return array
     */
    public function getErrors($attribute = '') {
        return $this->errors;
    }
    
    /**
     * 获取指定的错误信息
     * 
     * @param string $attribute
     * @return string
     */
    public function getError($attribute) {
        return isset($this->errors[$attribute]) ? $this->errors[$attribute] : '';
    }
}
