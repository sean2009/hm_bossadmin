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
			<a href="<?php echo $this->createUrl('eaiarg/ArgCateAdd');?>"><button type="button" title="添加主分类" class="button" hidefocus="true">
			添加主分类
			</button></a>
 		 </span>
 		 
		 <?php if($parent_id && $parent){?>
 				&nbsp; <?php echo $parent['cate_name'];?> 
				&nbsp; <a href="<?php echo $this->createUrl('eaiarg/ArgCateList',array('parent_id'=> $parent['parent_id']));?>">返回</a>
			<?php }?>	
	</div>
	</div>	 
	
	
	<div class="tablesModule">
    <table  style="width:400px;" border="0" cellpadding="0" cellspacing="0" class="tables">
      <tr class="order-bd">
			<td class="txt-center">分类名称</td>
			<td class="txt-center">操作</td>
      </tr>
    <?php 
	foreach((array)$list as $k=>$v){
	?>
      <tr class="order-bd">
		   <td class="txt-center">
	 <a href="<?php echo $this->createUrl('eaiarg/ArgCateList',array('parent_id'=> $v['info']['cate_id']));?>"><?php echo $v['info']['cate_name'];?></a></td>
		   <td class="txt-center">
		   <a href="<?php echo $this->createUrl('eaiarg/ArgCateList',array('parent_id'=> $v['info']['cate_id']));?>">查看</a>(<?php echo count($v['list'])?>) |  
		     <a href="<?php echo $this->createUrl('eaiarg/ArgCateEdit',array('id'=> $v['info']['cate_id']));?>" >编辑</a> |  
		   <a href="<?php echo $this->createUrl('eaiarg/ArgCateAdd',array('parent_id'=> $v['info']['cate_id']));?>">添加子菜单</a></td>
      </tr>
	  <?php }?>
	    
    
    </table>
   </div>
    
 </div>
 
</body>
</html>