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
			<a href="<?php echo $this->createUrl('eaiarg/ArgCateList/');?>"><button type="button" title="分类列表" class="button" hidefocus="true">
			分类列表
			</button></a>
		 </span>	
	</div>
	</div>
  <form action="<?php echo $this->createUrl('eaiarg/ArgCateSave');?>"  name="formDate" id="formDate" method="post" enctype="multipart/form-data" >		
 	<div class="tablesModule">
    <table width="819"  border="0" cellpadding="0" cellspacing="0" class="tables"    >
    
	<?php if($parent_id && $parent){?>
	 
	 <tr class="order-bd">
		   <td align="right" style="padding-right:10px;">父类名称:</td>
		   <td  align="left">
 		   <a href="<?php echo $this->createUrl('eaiarg/ArgCateList',array('parent_id'=> $parent['cate_id']));?>"> <?php echo $parent['cate_name'];?> </a>
 		   &nbsp;</td>
      </tr>
	  <input type="hidden"   name="parent_id" id="parent_id" value="<?php echo $parent_id;?>" />
 	<?php }else{?>
 	  <input type="hidden"   name="parent_id" id="parent_id" value="<?php echo $info['parent_id'];?>" />
	<?php }?>

      <tr class="order-bd">
		   <td align="right" style="padding-right:10px;">分类名称:</td>
		   <td  align="left"> 
 		   <input type="text" class="inpt" size="60" maxlength="90"  name="cate_name" id="cate_name" value="<?php echo $info['cate_name'];?>" />*
 		   &nbsp;</td>
      </tr>
	  
 	<!--
	<tr class="order-bd">
		   <td align="right" style="padding-right:10px;">分类排序:</td>
		   <td  align="left"> 
 		   <input type="text" class="inpt" maxlength="5" size="6" name="action_desc" id="action_desc" value="" /> (降序排列，从大到小)
 		   &nbsp;</td>
      </tr>
	-->
	  
	  <tr class="order-bd">
		   <td class="txt-right" colspan="2">
		     <?php if($info['cate_id']){?> <input type="hidden" class="inpt" name="cate_id" id="cate_id" value="<?php echo $info['cate_id'];?>" /> <?php }?>
		   <span class="btn-link btn-link1">
    			<button type="button" title="保 存" class="button" hidefocus="true" onClick="butSubmit();">保 存</button>
    		</span>
			
			<span class="btn-link btn-link3">
				<button type="button" title="取 消" class="button" onClick="butCancel();">取 消</button>
			</span>
	
	 </td>
       </tr>
	
    </table>
    </div>
  </form>
	
 	<script type="text/javascript">
	//保存
	function butSubmit(){
 		var _name = $('#cate_name').val();
  		if(_name == "" ){
			alert("请填写名称");
			$('#cate_name').focus();
			return false;
		}	 
  		$("#formDate").submit();
	}
	
	
	//取消
	function butCancel(){
		 window.location.href = '<?php echo $this->createUrl('eaiarg/ArgCateList',array('parent_id'=>$parent_id));?>';
	}
	</script>
</div>
</body>
</html>