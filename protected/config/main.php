<?php

include_once dirname(__FILE__) . '/' . DEV_ENVIRONMENT . '/constants.php';

return array (
	'basePath' => ROOT_PATH . 'protected' . DIRECTORY_SEPARATOR,
	'name' => '集成后台', 
	'defaultController' => 'index/index',
	'runtimePath'=> ROOT_PATH .'data'.DIRECTORY_SEPARATOR.'runtimes'.DIRECTORY_SEPARATOR,
	'language' => 'zh_cn',
	'timeZone'=>'Asia/Shanghai',
	'charset'=>'utf-8',
	'aliases'=>array('common_lib'=>ROOT_PATH . 'common_lib'),
//	'layoutpath' => YII_ROOT_PATH.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR,
	'import' => array (
		'application.config.config.php',
		'application.components.*',
		'application.forms.*',
		'application.models.*',
                'application.webServices.*',
		'application.services.*',
		'application.widgets.*',
		'yii_ext_lib.extensions.yiidebugtb.*',
                'yii_ext_lib.extensions.yiimongodb.*',
                'yii_ext_lib.extensions.yiioracledb.*',
                'yii_ext_lib.library.yar.*',
                'yii_ext_lib.common_service.*',
		'common_lib.*',
	),
	'preload'=>array(
		'log',
	),
	'modules'=>array(
		'gii'=>array(
			 'class'=>'system.gii.GiiModule',
			 'password'=>'111',
			 'ipFilters'=>array('127.0.0.1','::1','10.1.2.21','10\.1\.2\.[0-9]{1}','10\.1\.2\.[0-9]{2}','10\.1\.2\.[0-9]{3}'),
		 ),
		 'power' => array(
            'class' => 'application.modules.power.PowerModule',
            'defaultController' => 'index'
        ),
		 'message'=>array(
			 'class'=>'application.modules.message.MessageModule',
		 	 'defaultController'	=> 'index'
		 ),
                'middleware'=>array(
			 'class'=>'application.modules.middleware.MiddlewareModule',
		 	 'defaultController'	=> 'index'
		 ),
                 'monitoring'=>array(
			 'class'=>'application.modules.monitoring.MonitoringModule',
		 	 'defaultController'	=> 'index'
		 ),
        'other' => array(
            'class'=>'application.modules.other.OtherModule',
        ),
		
	),
	'components' => array_merge(array (
            'errorHandler'=>array(
                'errorAction' => 'public/error',
            ),
            'adminuser' => array(
                'class' => 'application.components.WebUser'
            ),
            'log'=>array(
                'class'=>'CLogRouter',
    			'routes'=>array(
    				array(
    		          'class'=>'XWebDebugRouter',
    		          'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
    		          'levels'=>'error, warning , info,trace',
    		          'allowedIPs'=>array('127.0.0.1','::1','10\.1\.2\.[0-9]{1}','10\.1\.2\.[0-9]{2}','10\.1\.2\.[0-9]{3}'),
    		        ),
    			),
            ),
            'request'=>array(  
                'enableCsrfValidation'=>false,  //如果防止post跨站攻击  
                'enableCookieValidation'=>true,//防止Cookie攻击  
            ), 
            'urlManager'=>array(
                'urlFormat' => 'path',											//重写URL
                'showScriptName' => false,									//隐藏Index.php，false为隐私，true为显示
                'urlSuffix' => '.html',											//为URL添加后坠
    //			'rules' => array(
    //				'supplier'					=> 'supplier/index',
    //				'power/myAccount'			=> 'power/user/myDetail',
    //		 		'power/myAccount/userReceive' => 'power/user/myUserReceive',
    //		 		'power/myAccount/userEvaluate' => 'power/user/myUserEvaluate'
    //			),
            ),
        ), require(dirname(__FILE__) . '/' . DEV_ENVIRONMENT . '/components.php')),
	'params'=>require(dirname(__FILE__) . '/' . DEV_ENVIRONMENT .'/params.php'),
);