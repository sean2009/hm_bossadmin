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
 		 <strong>日志管理</strong>	
	</div>
   </div>	 
  <div class="tablesModule">
  <form action="/eailog/index"  name="formDate" id="formDate" method="post" enctype="multipart/form-data" >		
    <table width="731" border="0" cellpadding="0" cellspacing="0" class="tables"  >
      <tr class="order-bd">
			<td colspan="4" class="txt-center">
			日志类型
			  <select name="opter_action" id="opter_action">
    			 <option value=""  <?php if(empty($search['opter_action'])){echo "selected='selected'";}?>>-全部-</option>
				 <?php foreach((array)$listAct as $k=>$v){?>
				 <option value="<?php echo $v['info']['action_code'];?>" <?php if($search['opter_action'] && $search['opter_action']==$v['info']['action_code']){echo "selected='selected'";}?> ><?php echo $v['info']['action_name'];?></option>
				 <?php
				 foreach((array)$v['list'] as $k1=>$v1){
				 ?>
				 <option value="<?php echo $v1['action_code'];?>" <?php if( $search['opter_action'] && $search['opter_action']==$v1['action_code']){ echo "selected='selected'";}?> >&nbsp;-<?php echo $v1['action_name'];?></option>
				 <?php
 				 }?>
				 <?php }?>
   			 </select>
			操作时间： <input name="start_time" id="start_time"  maxlength="20" type="text" value="<?php echo $search['start_time'];?>" />&nbsp;
			至&nbsp;
			<input name="end_time" id="end_time" type="text" maxlength="20"  value="<?php echo $search['end_time'];?>" />
			 <span class="btn-link btn-link1">
    			<button type="button" title="搜 索" class="button" hidefocus="true" onClick="butSearch();">搜 索</button>
    		</span>
			</td>
      </tr>
	  <tr class="order-bd">
			<td width="94" class="txt-center">日志类型</td>
			<td width="224" class="txt-center">日志内容</td>
			<td width="269"   class="txt-center">操作人</td>
			<td width="74"   class="txt-center">操作时间</td>
      </tr>
    <?php 
	foreach((array)$list as $k=>$v){
		if($v['opter_action']){
	?>
      <tr class="order-bd">
		   <td class="txt-center"><?php echo $opterAct[strtolower($v['opter_action'])];?></td>
		   <td class="txt-center"><?php echo $v['content'];?></td>
			<td class="txt-center"><?php echo $v['opter_name'];?></td>
		   <td class="txt-center"><?php echo $v['opter_time'];?> </td>
      </tr>
	  <?php }}?>   
	  
	  
	   <tr class="order-bd">
		 
		   <td class="txt-center" colspan="4" style="text-align:right;">
		    
 <?php 
    if(empty($pages['limit'])) $pages['limit'] = 1;
 	$pageNum = ceil($pages['count']/$pages['limit']);
  	?>
	 共 <?php echo $pageNum;?>/<?php echo $pages['page'];?>页  
	  <input name="page" id="page"  value="<?php echo $pages['page']; ?>"  type="text" size="4"  /> 
	  <input name="GoPage" id="GoPage"  value="跳转" type="button" onClick="butGoPage();"  />
	  &nbsp;&nbsp;&nbsp;&nbsp;
	</td>
      </tr>
	   
    </table>
  	</form>
   </div>
   
 </div>
 <script type="text/javascript">
	//搜索
	function butGoPage(){
		//$('#page').val();
 		$("#formDate").submit();
	}
	//搜索
	function butSearch(){
 		$("#formDate").submit();
	}
	//取消
	function butCancel(){
		 window.location.href = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/eailog/index';
	}
	</script>
</body>
</html>