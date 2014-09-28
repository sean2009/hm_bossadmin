<!doctype html>
<meta http-equiv="window-target" content="_top" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<html lang="zh-cn">
<head>
<title>MEMCACHE管理</title>
</head>
<body>
<a href="show.php?type=show">查看MEMCACHE服务器状态</a>
<form method="post">
<?php 
$keyname = isset($_POST['key'])    ? $_POST['key']    : '';
$method  = isset($_POST['method']) ? $_POST['method'] : '0';
?>
请输入要查询的KEY:<input type="text" size="100" name="key" value="<?php  echo $keyname; ?>" id="key"/>
<select name="method" id="method">	
	<option value="0">查看</option>
	<option value="1">清除</option>
	<option value="2">回收过期缓存</option>
	<option value="3">作废缓存中的所有元素</option>
</select> 
<input type="submit" value='提交'/>
</form>
<?php
include_once("./cls_memcache.php");
$cache = new base_memcached();
switch ($method)
{
	case '0'://显示
		$keys = $cache->keylist();
		foreach ($keys as $key) 
		{
			if($keyname!='')
			{
				if(substr($key[0],0,strlen($keyname))!=$keyname) continue;
			}
			echo $key[0] . "----过期时间：$key[1]秒" . '<a href="show.php?key='.$key[0].'">查看</a>|<a href="show.php?type=delete&key='.$key[0].'">清除</a><br/>';
		}
		break;
	case '1'://清除
		if($keyname!='')
		{
			$keys = $cache->keylist();
			foreach ($keys as $key) 
			{
				if($keyname!='')
				{
					if(substr($key[0],0,strlen($keyname))!=$keyname) continue;
				}
				$cache->delete($key[0]);
			}
		}
		else 
		{
			echo '请输入要清除的KEY。';
		}
		break;
	case '2':
		$cache->gc();
		echo '回收过期缓存完成！';
		break;
	case '3':
		$cache->flush();
		echo '操作完成！';
		break;
}
?>
</body>
</html>