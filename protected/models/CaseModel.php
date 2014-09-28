<?php
class CaseModel extends BaseModel{
    /**
     * 
     * @param type $className
     * @return CaseModel
     */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function getCaseByCompany(){
		$sql = 'select id,case_name,brief from zx_case';
		$res = $this->db_zx->selectLimitEx($sql,5,1);
		return $res;
	}

}
