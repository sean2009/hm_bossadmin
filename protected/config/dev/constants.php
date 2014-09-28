<?php
//日志服务地址
define('API_LOG_URL', 'http://localhost/bossadmin/log_service/api.php');
//供应商服务地址，中间件获取商品sku信息有使用
define('API_SUPPLIERS_URL','http://localhost/dev/trunk/service/suppliers/api.php');
//订单服务
define('API_ORDER_URL','http://localhost/service/order/api.php');

//团购菜单地址
define('POWER_SHOPADMIN_URL','http://localhost/service/order/api.php');
//商城菜单地址
define('POWER_MADMIN_URL','http://malladmin.ec.com/admin');

define('BOSS_COOKIE_EXPIRE',30);//time()+60*60*24*30;  有限期30天
define('BOSS_COOKIE_DOMAIN','.ec.com');// COOKIE 域名
