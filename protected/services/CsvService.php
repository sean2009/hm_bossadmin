<?php
class CsvService extends BaseService{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/*
	 * CSV导入
	 */
	public function getCsvData($file)
	{
		$file_type = substr(strstr($file['name'],'.'),1);
		// 检查文件格式
	    if ($file_type != 'csv'){
	        echo '文件格式不对,请重新上传!';
	        exit;
	    }
	    $handle = fopen($file['tmp_name'],"r");
//    	$file_encoding = mb_detect_encoding($handle);
//		// 检查文件编码
//	    if ($file_encoding != 'ASCII'){
//	        echo '文件编码错误,请重新上传!';
//	        exit;
//	    }
		$row = 1;
		$dataArr = array();
		if ($handle !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $num = count($data);
		        $row++;
		        for ($c=0; $c < $num; $c++) {
		        	$data[$c] = iconv( 'GB2312', 'UTF-8', trim( $data[$c] ) );
		        }
		        $dataArr[] = $data;
		    }
		    fclose($handle);
		    return $dataArr;
		}
		
	}
}