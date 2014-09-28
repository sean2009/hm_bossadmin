<?php
class CityModel extends BaseModel{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/** 取所有国内所有省份 */
	public function getAllProvinces(){
		$sql = "SELECT region_id as id,parent_id,region_name,region_type FROM ECS_REGION WHERE parent_id!=0 and region_type=1 order by region_id desc ";
		$keyCache='get_all_province_'.md5($sql);
		$cache_array= $this->cache->fetch($keyCache);
		if($cache_array){
			return $cache_array;
		}else{
			$list = $this -> db ->getAll($sql);
			$this->cache->save($keyCache,$list);
			return $list;
		}
	}

	/**
	 * 根据主键返回 省|市|区
	 * @param int $id 省|市|区 ID 主键
	 */
	public function getCityById($id){
		$sql = "SELECT region_id as id,parent_id,region_name,region_type FROM ECS_REGION WHERE region_id=:region_id ";
		$keyCache='getCityById_'.$id;
		$cache_array= $this->cache->fetch($keyCache);
		if($cache_array){
			return $cache_array;
		}else{
			$this -> db ->bind("region_id", $id);
			$row= $this -> db ->getRow($sql);
			$this->cache->save($keyCache,$row);
			return $list;
		}
	}

}
