<?php
class MemcacheExt extends Memcache {
	
	/**
	 * 构造函数
	 */
    function __construct() 
    {
    	date_default_timezone_set('PRC');
    }
    
    function setServers($servers){
        foreach ($servers as $item) {
            $this -> addServer($item['host'], $item['port'], 1);
        }
    }
    
    /**
     * 析构函数
     */
    function __destruct()
    {
    	$this->close();
    }
    /**
     * 回收所有过期的缓存
     */
    public function gc()
    {
    	$t = time();
	    $_this = $this;
	    $func = function($key,$info) use ($t,$_this)
	    {
	    	$exptime = $info[1] - $t;
	      	if($exptime<=0)
	      	{
	      		$_this->delete($key);
	      	}
	    };
	    $this->lists($func);
    }
    
    /**
     * 获取缓存中末过期的keys
     */
    public function keylist()
    {
    	$t = time();
    	$res = array();
    	$allSlabs = $this->getExtendedStats('slabs');
    	$items = $this->getExtendedStats('items');//获取memcached状态
    	if(count($items)==0||count($allSlabs)==0) return false;
    	foreach ($allSlabs as $server => $slabs)
    	{
    		$sid = $server;
    		if(empty($items[$sid]['items'])) break;
	    	foreach($items[$sid]['items'] as $slab_id => $slab)//获取指定server id 的 所有Slab
	    	{
	    		$item = $this->getExtendedStats('cachedump',(int)$slab_id);//遍历所有Slab
	    		foreach($item[$sid] as $key => $info)//获取Slab中缓存对象信息
	    		{
	    			if (!is_array($info)) break;
	    			//$exptime = $info[1]-$t;
	    			$exptime = $info[1];
	    			if($exptime>0)
	    			{
	    				$res[] = array($key,$exptime-$t);
	    			}
	    		}
	    	}
    	}
    	$cmp = function ($a,$b)
    	{
    		if ($a[1] == $b[1]) {
        		return 0;
	    	}
	    	return ($a[1] < $b[1]) ? 1 : -1;
    	};
    	usort($res, $cmp);
    	return $res;
    }
    /**
     * 获取服务器缓存数据信息
     */
    public function info()
    {
    	$t = time();
    	$func = function($key,$info) use ($t)
    	{
    		echo $key,' => Exp:',$info[1] - $t,"<br/>";//查看缓存对象的剩余过期时间    		
    	};
    	$this->lists($func);
    }
    private function lists($func)
    {
    	$allSlabs = $this->getExtendedStats('slabs');
    	$items = $this->getExtendedStats('items');//获取memcached状态
    	if(count($items)==0||count($allSlabs)==0) return false;
    	foreach ($allSlabs as $server => $slabs)
    	{
    		$sid = $server;
	    	foreach($items[$sid]['items'] as $slab_id => $slab)//获取指定server id 的 所有Slab
	    	{
	    		$item = $this->getExtendedStats('cachedump',(int)$slab_id);//遍历所有Slab
	    		foreach($item[$sid] as $key => $info)//获取Slab中缓存对象信息
	    		{
	    			if (!is_array($info)) break;
	    			$func($key,$info);
	    		}
	    	}
    	}
    }
    
    /**
     * 获取当前MEMCACHE服务器信息
     */
    public function show()
    {
    	$status = $this->getStats();
        $str = '';
    	$str .= "<table border='1' class='tables'>";
        $str .= "<tr><td>memcache版本:</td><td> ".$status ["version"]."</td></tr>"; 
        $str .= "<tr><td>memcache服务器的进程ID: </td><td>".$status ["pid"]."</td></tr>"; 
        $str .= "<tr><td>服务器当前的unix时间戳: </td><td>".$status ["uptime"]."</td></tr>"; 
        $str .= "<tr><td>进程的累计用户时间: </td><td>".$status ["rusage_user"]." seconds</td></tr>"; 
        $str .= "<tr><td>进程的累计系统时间: </td><td>".$status ["rusage_system"]." seconds</td></tr>"; 
        $str .= "<tr><td>从服务器启动以后存储的items总数量: </td><td>".$status ["total_items"]."</td></tr>"; 
        $str .= "<tr><td>当前打开着的连接数:</td><td>".$status ["curr_connections"]."</td></tr>"; 
        $str .= "<tr><td>从服务器启动以后曾经打开过的连接数: </td><td>".$status ["total_connections"]."</td></tr>"; 
        $str .= "<tr><td>服务器分配的连接构造数:</td><td>".$status ["connection_structures"]."</td></tr>"; 
        $str .= "<tr><td>get命令（获取）总请求次数:</td><td>".$status ["cmd_get"]."</td></tr>"; 
        $str .= "<tr><td>set命令（保存）总请求次数:</td><td>".$status ["cmd_set"]."</td></tr>"; 

        $percCacheHit=((real)$status ["get_hits"]/ (real)$status ["cmd_get"] *100); 
        $percCacheHit=round($percCacheHit,3); 
        $percCacheMiss=100-$percCacheHit; 

        $str .= "<tr><td>总命中:</td><td>".$status ["get_hits"]." ($percCacheHit%)</td></tr>"; 
        $str .= "<tr><td>未命中：</td><td>".$status ["get_misses"]."($percCacheMiss%)</td></tr>"; 

        $MBRead= (real)$status["bytes_read"]/(1024*1024); 

        $str .= "<tr><td>总读取数: </td><td>".$MBRead." Mega Bytes</td></tr>"; 
        $MBWrite=(real) $status["bytes_written"]/(1024*1024) ; 
        $str .= "<tr><td>总发送数:</td><td>".$MBWrite." Mega Bytes</td></tr>"; 
        $MBSize=(real) $status["limit_maxbytes"]/(1024*1024) ; 
        $str .= "<tr><td>分配给memcache的内存大小:</td><td>".$MBSize." Mega Bytes</td></tr>"; 
        $str .= "<tr><td>为获取空闲内存而删除的items数:</td><td>".$status ["evictions"]."</td></tr>"; 

	$str .= "</table>";
        return $str;
    }
}
?>