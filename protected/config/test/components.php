<?php

return array(
    //集成后台	 
    'db' => array(
        'connectionString' => "mysql:host=192.168.0.225;port=33306;dbname=hm_bossadmin",
        'emulatePrepare' => true,
        'username' => 'hmeai',
        'password' => 'hmeai',
        'charset' => 'utf8',
        'tablePrefix' => 'eai_',
        'schemaCachingDuration' => 3600,
    ),
    //中间件管理
    'db_mid' => array(
        'class' => 'CDbConnection',
        'connectionString' => "mysql:host=192.168.0.225;port=33306;dbname=hm_middleware",
        'emulatePrepare' => true,
        'username' => 'hmeai',
        'password' => 'hmeai',
        'charset' => 'utf8',
        'tablePrefix' => 'bc_',
        'schemaCachingDuration' => 0,
    ),
    //默认团购库
    'db_tg' => array(
        'class' => 'EOracleDB',
        'connectionString' => "(DESCRIPTION=(ADDRESS=(PROTOCOL =TCP)(HOST=192.168.0.225)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVER_NAME=hmsc_s)))",
        'username' => 'CTxgTSN2SC',
        'password' => 'SCSHOPqa_DB'
    ),
    'mongodb' => array(
        'class' => 'EMongoDB',
        'connectionString' => 'mongodb://root:jiajia@192.168.19.231:27017',
        'dbName' => 'admin',
        'fsyncFlag' => true,
        'safeFlag' => true,
        'useCursor' => false
    ),
    'cache' => array(
        'class' => 'BaseMemCache',
        'servers' => array(
            array(
                'host' => '192.168.0.247',
                'port' => 11211
            )
        ),
    ),
);
