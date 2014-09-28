<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="<?php echo CSS_DOMAIN1;?>/css/mmall/manage/boss/common.css" />
<script type="text/javascript" src="<?php echo CSS_DOMAIN1;?>/js/public.js"></script>
<style>
.order-bd p {
height:20px;
}

div .left{
	width:30%;
	min-height:600px;
	float:left;
	border:1px solid gray;
	margin:5px 10px;
}

div .right{
	width:65%;
	float:right;
	margin:5px 10px;
	height:600px;
}


.tree {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.tree li {
    white-space: nowrap;
}
.tree li ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.tree-node {
    cursor: pointer;
    height: 18px;
    white-space: nowrap;
}
.tree-hit {
    cursor: pointer;
}
.tree-expanded, .tree-collapsed, .tree-folder, .tree-file, .tree-checkbox, .tree-indent {
    display: inline-block;
    height: 18px;
    overflow: hidden;
    vertical-align: top;
    width: 16px;
}
.tree-expanded {
    background: url("/data/static/tree_icons.png") no-repeat scroll -18px 0 rgba(0, 0, 0, 0);
}
.tree-expanded-hover {
    background: url("/data/static/tree_icons.png") no-repeat scroll -50px 0 rgba(0, 0, 0, 0);
}
.tree-collapsed {
    background: url("/data/static/tree_icons.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
}
.tree-collapsed-hover {
    background: url("/data/static/tree_icons.png") no-repeat scroll -32px 0 rgba(0, 0, 0, 0);
}
.tree-lines .tree-expanded, .tree-lines .tree-root-first .tree-expanded {
    background: url("/data/static/tree_icons.png") no-repeat scroll -144px 0 rgba(0, 0, 0, 0);
}
.tree-lines .tree-collapsed, .tree-lines .tree-root-first .tree-collapsed {
    background: url("/data/static/tree_icons.png") no-repeat scroll -128px 0 rgba(0, 0, 0, 0);
}
.tree-lines .tree-node-last .tree-expanded, .tree-lines .tree-root-one .tree-expanded {
    background: url("/data/static/tree_icons.png") no-repeat scroll -80px 0 rgba(0, 0, 0, 0);
}
.tree-lines .tree-node-last .tree-collapsed, .tree-lines .tree-root-one .tree-collapsed {
    background: url("/data/static/tree_icons.png") no-repeat scroll -64px 0 rgba(0, 0, 0, 0);
}
.tree-line {
    background: url("/data/static/tree_icons.png") no-repeat scroll -176px 0 rgba(0, 0, 0, 0);
}
.tree-join {
    background: url("/data/static/tree_icons.png") no-repeat scroll -192px 0 rgba(0, 0, 0, 0);
}
.tree-joinbottom {
    background: url("/data/static/tree_icons.png") no-repeat scroll -160px 0 rgba(0, 0, 0, 0);
}
.tree-folder {
    background: url("/data/static/tree_icons.png") no-repeat scroll -208px 0 rgba(0, 0, 0, 0);
}
.tree-folder-open {
    background: url("/data/static/tree_icons.png") no-repeat scroll -224px 0 rgba(0, 0, 0, 0);
}
.tree-file {
    background: url("/data/static/tree_icons.png") no-repeat scroll -240px 0 rgba(0, 0, 0, 0);
}
.tree-loading {
    background: url("/data/static/loading.gif") no-repeat scroll center center rgba(0, 0, 0, 0);
}
.tree-checkbox0 {
    background: url("/data/static/tree_icons.png") no-repeat scroll -208px -18px rgba(0, 0, 0, 0);
}
.tree-checkbox1 {
    background: url("/data/static/tree_icons.png") no-repeat scroll -224px -18px rgba(0, 0, 0, 0);
}
.tree-checkbox2 {
    background: url("/data/static/tree_icons.png") no-repeat scroll -240px -18px rgba(0, 0, 0, 0);
}
.tree-title {
    display: inline-block;
    font-size: 12px;
    height: 18px;
    line-height: 18px;
    padding: 0 2px;
    text-decoration: none;
    vertical-align: top;
    white-space: nowrap;
}
.tree-node-proxy {
    border-style: solid;
    border-width: 1px;
    font-size: 12px;
    line-height: 20px;
    padding: 0 2px 0 20px;
    z-index: 9900000;
}
.tree-dnd-icon {
    display: inline-block;
    height: 18px;
    left: 2px;
    margin-top: -9px;
    position: absolute;
    top: 50%;
    width: 16px;
}
.tree-dnd-yes {
    background: url("images/tree_icons.png") no-repeat scroll -256px 0 rgba(0, 0, 0, 0);
}
.tree-dnd-no {
    background: url("images/tree_icons.png") no-repeat scroll -256px -18px rgba(0, 0, 0, 0);
}
.tree-node-top {
    border-top: 1px dotted #FF0000;
}
.tree-node-bottom {
    border-bottom: 1px dotted #FF0000;
}
.tree-node-append .tree-title {
    border: 1px dotted #FF0000;
}
.tree-editor {
    border: 1px solid #CCCCCC;
    font-size: 12px;
    height: 14px !important;
    line-height: 14px;
    padding: 1px 2px;
    position: absolute;
    top: 0;
    width: 80px;
}
.tree-node-proxy {
    background-color: #FFFFFF;
    border-color: #95B8E7;
    color: #000000;
}
.tree-node-hover {
    background: none repeat scroll 0 0 #EAF2FF;
    color: #000000;
}
.tree-node-selected {
    background: none repeat scroll 0 0 #FBEC88;
    color: #000000;
}
.onMp hover{
 	background: none repeat scroll 0 0 #EAF2FF;
    color: #000000;
}
</style>
</head>
<body>
 <div class="main" style="margin-left:20px;"> 
  <div class="controlWrap">
    <div class="controlModule">
 		 <span class="btn-link btn-link4">
			<a href="<?php echo $this->createUrl('eaiarg/ArgAdd');?>">
			<button type="button" title="新增系统参数" class="button" hidefocus="true">
			新增系统参数
			</button></a>&nbsp;参数管理
		 </span>		
	</div>
   </div>	 
  <div class="tablesModule">
  <form action="/eaiarg/ArgSave"  name="formDate" id="formDate" method="post" enctype="multipart/form-data" >		
   
    <table width="855" border="0" cellpadding="0" cellspacing="0" class="tables"  >
    	<tr class="order-bd">
		 <td  style="text-align:left;width:20%; vertical-align:top;">
			  <?php
 			 echo cateToTree((array)$cateList);
			 ?>
	 	  </td>
		  
		  <td style="width:80%; vertical-align:top;"  >
		  <div id="div_msg" style="margin: 10px;"></div>
			   
			    <table id="td_list_show" style="display:none; height:80%;width:80%;margin: 10px;" border="0" cellpadding="0" cellspacing="0"   >
					<tr class="order-bd" id="tr_cate_name">
						 <td id="td_cate_name" style="text-align:left;width:20%; padding-left:10px;"> </td>
 					</tr>
					<tr><td>
						<table id="arg_list" style="margin: 10px; width:98%;"  border="0" cellpadding="0" cellspacing="0"></table>
					</td></tr>
				</table>	
			   <table id="td_info_show" style="display:none; height:80%;width:80%;margin: 10px;" border="0" cellpadding="0" cellspacing="0"   >
					<tr class="order-bd">
						<td  style="text-align:right;width:20%"> 分类： </td>
						  <td>
							 <input name="cate_name" id="cate_name"  disabled="disabled" size="20" />
							 <input name="cate_id" id="cate_id"   type="hidden"  />
 						 </td>
					</tr>
					<tr class="order-bd">
						<td  style="text-align:right;width:20%"> 名称： </td>
						  <td>
						  	 <input name="arg_id" id="arg_id"  type="hidden"  type="hidden" />
							 <input name="arg_code" id="arg_code"  size="20" />
						 </td>
					</tr>
					<tr class="order-bd">	 
						  <td  style="text-align:right;width:20%; vertical-align:top;"> 值： </td>
						  <td>
							 <textarea name="arg_value" id="arg_value" rows="12" cols="60" ></textarea>
						 </td>
					</tr>
					<tr class="order-bd">		 
						  <td  style="text-align:right;width:20%"> 备注： </td>
						  <td>
							 <input name="arg_remark" id="arg_remark" size="30" />
							 
						 </td>
					 </tr>
					 
					 <tr class="order-bd">		 
						  <td  style="text-align:left;width:20%">  </td>
						  <td>
 					  
			 <span class="btn-link btn-link1">
    			<button type="button" title="保 存" class="button" hidefocus="true" onClick="butSubmit();">保 存</button>
    		</span>
			
			<span class="btn-link btn-link3">
				<button type="button" title="取 消" class="button" onClick="butCancel();">取 消</button>
			</span>
							
						 </td>
					 </tr>
					 
 				 </table>
		 
		  </td>
      </tr>
   </table> 
	   
	</form>
   </div>
   <?php
  function cateToTree($List = array(),$level=-1){
   	for($i=0;$i<$level;$i++){
		$nbsp .='&nbsp;';
	}
	if($level >= 1){
		$node = 'none';
	}else{
		$node = '';
	}
	$level = $level + 2;	
	foreach((array)$List as $k=>$v){
		if($v['list']){
			$t = '<span level="'.$level.'" onClick="showCate(\''.$v['info']['cate_id'].'\',this)" class="tree-hit tree-expanded"></span>';
		}else{
			$t = '<span level="'.$level.'" class="tree-hit tree-collapsed"></span>';
		}
		 
		$html .= '<ul id="ul_'.$v['info']['cate_id'].'" ul_level="'.$level.'" class="tree-node" name="p_'.$v['info']['parent_id'].'" style=\'display:'.$node.';padding-left:10px;height:22px;\'>'.$nbsp.$t.'<span class="tree-icon tree-file"></span> <a href="javascript:showArgList(\''.$v['info']['cate_id'] .'\');" id="cateName_'.$v['info']['cate_id'].'">  '.$v['info']['cate_name'] .'</a></ul>';	
 		$html .= cateToTree($v['list'],$level);
	}	
	return 	$html;		
 
 } 
 
 ?> 
 
 <script type="text/javascript">	
$(".tree-node").hover(function(){
$(this).addClass('tree-node-hover');
},function(){
$(this).removeClass('tree-node-hover');
}); 
 
 //取参数信息
 function showArgByArgID(arg_id){
 	$.ajax({
           type: "POST",
           url: "<?php echo $this->createUrl('eaiarg/AjaxByArgID');?>",
           data: "arg_id="+arg_id,
           async : false,
           cache : false,
           error : function() {
        	   alert('操作失败!');
           },
           success: function(data){
		   		$("#div_msg").hide().html('');
				if(data == "null" || data == "[]"){
					 $("#td_info_show").hide();
					 $("#td_list_show").hide();
					 $("#div_msg").show().html("暂无数据");
					 return false;
				}
 				var obj;
				 
 				if (typeof(JSON) == 'undefined'){  
                     obj = eval("("+data+")");  
                }else{  
                     obj = JSON.parse(data);  
                }  
 				
				$("#td_info_show").show();
 				$("#arg_id").val(obj.arg_id);
				$("#arg_code").val(obj.arg_code);
 				$("#cate_name").val(  $('#cateName_'+obj.cate_id).html() );
				$("#cate_id").val(obj.cate_id);
				$("#arg_remark").val(obj.arg_remark);
				$("#arg_value").val(obj.arg_value);
 		   }
		});
		
 }
 
 
 //取参数信息
 function showArgList(cate_id){
  	$.ajax({
           type: "POST",
           url: "<?php echo $this->createUrl('eaiarg/AjaxArgListByCateID');?>",
           data: "cate_id="+cate_id,
           async : false,
           cache : false,
           error : function() {
        	   alert('操作失败!');
           },
           success: function(data){
		   		$('.tree-node').removeClass('tree-node-selected');
				$('ul[id="ul_'+cate_id+'"]').addClass('tree-node-selected');
 		   
 		   		$("#div_msg").hide().html('');
				if(data == "null" || data == "[]"){
					 $("#td_info_show").hide();
					 $("#td_list_show").hide();
 					 $("#div_msg").show().html("暂无数据");
					 return false;
				}
 				var obj;
  				if (typeof(JSON) == 'undefined'){  
                     obj = eval("("+data+")");  
                }else{  
                     obj = JSON.parse(data);  
                } 
  				$('#td_cate_name').html( $('#cateName_'+cate_id).html() );
  				var _td_list = '';
				
				if(obj.length==0) _td_list ='暂无数据';
				
				for(i=0;i<obj.length;i++){
					_td_list +='<tr class="order-bd">';
					_td_list +='<td style="text-align:left;width:25%; padding-left:10px;"><a href="javascript:showArgByArgID('+obj[i].arg_id+');">'+obj[i].arg_code+'</a> </td><td style="padding-left:10px;"> '+obj[i].arg_remark+' </td>';
 					_td_list +='</tr>';
 				} 
 				$('#arg_list').html(_td_list);
				$("#td_info_show").hide();
				$("#td_list_show").show();
 		   }
		});
		
 }
 	//显示子分类
	function showCate(cate_id,t){
 		if($('ul[name="p_'+cate_id+'"]').eq(0).is(":hidden") == true){
			$('ul[name="p_'+cate_id+'"]').show();
			//$('#show_cate_'+cate_id).html('-');
		}else{
			$('ul[name="p_'+cate_id+'"]').hide();
			//$('#show_cate_'+cate_id).html('+');
		}	
 	}
	//显示子分类
	function showCate1(cate_id){
		if($('p[name="p_'+cate_id+'"]').eq(0).is(":hidden") == true){
			$('p[name="p_'+cate_id+'"]').show();
			$('#show_cate_'+cate_id).html('-');
		}else{
			$('p[name="p_'+cate_id+'"]').hide();
			$('#show_cate_'+cate_id).html('+');
		}	
 	}
	//搜索
	function butSearch(){
 		$("#formDate").submit();
	}
	//保持
	function butSubmit(){
		var _arg_id = $('#arg_id').val();
		var _arg_code = $('#arg_code').val();
		var _cate_id = $('#cate_id').val();
		var _arg_value = $('#arg_value').val();
		var _arg_remark = $('#arg_remark').val();
 		var dataStr = "arg_id="+_arg_id+"&arg_code="+_arg_code+"&cate_id="+_cate_id+"&arg_value="+_arg_value+"&arg_remark="+_arg_remark+"&ajax=1";
 		$.ajax({
           type: "POST",
           url: "<?php echo $this->createUrl('eaiarg/ArgSave');?>",
           data: dataStr,
           async : false,
           cache : false,
           error : function() {
        	   alert('操作失败!');
           },
           success: function(data){
		   		if(data==true){
 					showArgList(_cate_id);
					showArgByArgID(_arg_id);
					//$("#div_msg").show().html("修改成功");
				}else{
					alert('修改失败!');	
				}
			 }	
		  });
		
		//$("#formDate").submit();
	}
	//取消
	function butCancel(){
		$("#div_msg").hide().html('');
		$("#td_info_show").hide();
 		$("#arg_id").val('');
		$("#arg_code").val('');
		$("#cate_name").val('');
		$("#cate_id").val('');
		$("#arg_remark").val('');
		$("#arg_value").val('');
 	}
	</script>
 
	
	 </div>
</body>
</html>