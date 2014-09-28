<?php
define ( 'YII_DEBUG', true );
define('YII_IS_MONITORING',false);
require_once ('../yiiext/yii_ext_lib/bootStrap.php');
define ( 'ROOT_PATH', dirname ( __FILE__ ) . DIRECTORY_SEPARATOR );
$config = dirname ( __FILE__ ) . '/protected/config/main.php';
// create a Web application instance and run
Yii::createWebApplication ($config )->run ();

