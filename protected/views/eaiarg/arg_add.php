<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="<?php echo CSS_DOMAIN1;?>/css/mmall/manage/boss/common.css" />
<script type="text/javascript" src="<?php echo CSS_DOMAIN1;?>/js/public.js"></script>
</head>
<body>
 <div class="main" style="margin-left:20px;"> 
   <div class="controlWrap">
    <div class="controlModule">
 		 <span class="btn-link btn-link4">
			<a href="<?php echo $this->createUrl('eaiarg/index');?>"><button type="button" title="系统参数列表" class="button" hidefocus="true">
			系统参数列表
			</button></a> &nbsp;添加系统参数
		 </span>	
	</div>
	</div>	 
 	
	<div class="tablesModule">
     <form action="<?php echo $this->createUrl('eaiarg/argSave');?>"  name="formDate" id="formDate" method="post" enctype="multipart/form-data" >		
	<table width="706"  border="0" cellpadding="0" cellspacing="0" class="tables"    >
         <tr class="order-bd">
		   <td width="100" align="right" style="padding-right:10px;">参数名称:</td>
		   <td width="606"  align="left"> 
 		   <input type="text" class="inpt" maxlength="60" size="30" name="arg_code" id="arg_code"  value="<?php echo $info['arg_code'];?>"/>*<span style="color:#FF0000">(参数名称只能为英文，数字，下划线，且不能重复)</span> 
 		   &nbsp;</td>
      </tr>
	   
	    <tr class="order-bd">
		   <td align="right" style="padding-right:10px;">参数分类</td>
		   <td  align="left"> 
		   <select name="cate_id" id="cate_id">
  		    <?php
 			 echo optionToTree((array)$cateList);
			 ?>
  		   </select>*
 		   &nbsp;</td>
      </tr>
	   
	  <tr class="order-bd">
		   <td style="padding-right:10px; vertical-align: top; " align="right">值:</td>
		   <td  align="left"> 
  		   <textarea name="arg_value" id="arg_value"  rows="12" cols="60"><?php echo $info['arg_value'];?></textarea>*
		   
		   &nbsp;</td>
      </tr>
       <tr class="order-bd">
		   <td align="right" style="padding-right:10px;">备注</td>
		   <td  align="left"> 
 		   <input type="text" class="inpt" name="arg_remark" id="arg_remark"  value="<?php echo $info['arg_remark'];?>"  />*
 		   &nbsp;</td>
      </tr>
	 
	  <tr class="order-bd">
		   <td class="txt-right" colspan="2">
		     <input type="hidden" class="inpt" name="arg_id" id="arg_id"  value="<?php echo $info['arg_id'];?>"  />
		   <span class="btn-link btn-link1">
    			<button type="button" title="保 存" class="button" hidefocus="true" onClick="butSubmit();">保 存</button>
    		</span>
			
			<span class="btn-link btn-link3">
				<button type="button" title="取 消" class="button" onClick="butCancel();">取 消</button>
			</span>
	
	 </td>
      </tr>
	
    </table>
		</form>
   </div>
 <?php
  function optionToTree($List = array(),$level=-1){
   	for($i=0;$i<$level;$i++){
		$nbsp .='&nbsp;';
	}
	 $level = $level + 2;	
	foreach((array)$List as $key=>$val){
		$html .= "<option value=".$val['info']['cate_id']."> ".$nbsp." ".$val['info']['cate_name']." </option>";	
		$html .= optionToTree($val['list'],$level);
	}	
	return 	$html;		
 
 } 
 
 ?> 
    
 <script type="text/javascript">	
	 
	//保存
	function butSubmit(){
 		var _type = $('#arg_type').val();
		var _code = $('#arg_code').val();
		var _value = $('#arg_value').val();
		var _remark = $('#arg_remark').val();
 		if(_code == "" ){
			alert("请填写名称");
			$('#arg_code').focus();
			return false;
		}
		 var myreg = /^[\da-zA-Z_]+$/;
           if(!myreg.test(_code))
           {
                alert('请输入有效的名称');
             	$('#arg_code').focus();
                return false;
          }
		
		if(_type == "" ){
			alert("请填写分类");
			$('#arg_type').focus();
			return false;
		}
		if(_value == "" ){
			alert("请填写值");
			$('#arg_value').focus();
			return false;
		}
		if(_remark == "" ){
			alert("请填写备注");
			$('#arg_remark').focus();
			return false;
		}
	
 		$("#formDate").submit();
	}
	//取消
	function butCancel(){
  		 window.location.href = '<?php echo $this->createUrl('eaiarg/index/');?>';
	}
	</script>
 
	
	 </div>
</body>
</html>