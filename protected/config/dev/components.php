<?php
return array(
    //集成后台	 
    'db' => array(
        'connectionString' => "mysql:host=192.168.0.216;port=33306;dbname=hm_bossadmin",
        'emulatePrepare' => true,
        'username' => 'hmeai',
        'password' => 'hmeai',
        'charset' => 'utf8',
        'tablePrefix' => 'eai_',
        'schemaCachingDuration' => 0,
    ),
    //中间件管理
    'db_mid' => array(
        'class' => 'CDbConnection',
        'connectionString' => "mysql:host=192.168.0.216;port=33306;dbname=hm_middleware",
        'emulatePrepare' => true,
        'username' => 'hmeai',
        'password' => 'hmeai',
        'charset' => 'utf8',
        'tablePrefix' => 'bc_',
        'schemaCachingDuration' => 0,
    ),
    //团购oracle库
    'db_tg' => array(
        'class' => 'EOracleDB',
        'connectionString' => "(DESCRIPTION=(ADDRESS=(PROTOCOL =TCP)(HOST=192.168.0.216)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SID=pangu01)))",
        'username' => 'ecshop',
        'password' => 'Yh^9(G$MgU'
    ),
    'db_sc' => array(
        'class' => 'EOracleDB',
        'connectionString' => "(DESCRIPTION=(ADDRESS=(PROTOCOL =TCP)(HOST=192.168.0.216)(PORT = 1531))(CONNECT_DATA =(SERVER = DEDICATED)(SID=pangusc)))",
        'username' => 'hmsc_s',
        'password' => 'mQ*HbDZ6KX'
    ),
    'mongodb' => array(
        'class' => 'EMongoDB',
        'connectionString' => 'mongodb://192.168.0.119:27017',
        'dbName' => 'log',
        'fsyncFlag' => true,
        'safeFlag' => true,
        'useCursor' => false
    ),
    'cache' => array(
        'class' => 'BaseMemCache',
        'servers' => array(
            array(
                'host' => '192.168.0.219',
                'port' => 11211
            )
        ),
    ),
);