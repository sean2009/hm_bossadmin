<?php
/**
 * Enter description here ...
 * @author xiaopeng
 *
 */
class TestWidget extends CWidget{
	
	public function init(){
		echo "this is init() <br>";
	}
	
	public function run(){
		echo "this is run()<br>";
		$str="<font color=red>this is widget</font>";
		$view['string']=$str;
		$this->render('test',$view);
	}
}