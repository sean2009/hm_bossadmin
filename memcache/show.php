<!doctype html>
<meta http-equiv="window-target" content="_top" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<html lang="zh-cn">
<head>
<title>MEMCACHE管理</title>
</head>
<body>
<?php
require("./cls_memcache.php");
$cache = new base_memcached();
$type = isset($_GET['type'])?$_GET['type']:'get';
switch ($type)
{
	case 'get':
		echo '<a href="index.php">返回</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="show.php?type=delete&key='.$_GET['key'].'">清除</a><br/>';
		var_dump($cache->get($_GET['key'])) ;
		break;
	case 'delete':
		echo '<a href="index.php">返回</a>&nbsp;&nbsp;';
		$cache->delete($_GET['key']);
		echo '清除成功！';
		break;
	case 'show':
		echo '<a href="index.php">返回</a>&nbsp;&nbsp;';
		$cache->show();
		break;
}
?>
</body>
</html>