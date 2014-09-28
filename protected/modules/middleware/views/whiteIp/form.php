<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/statics/plugins/jquery.ui/css/start/jquery-ui-1.8.21.custom.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/statics/plugins/jquery.ui/js/jquery-ui-1.8.21.custom.min.js"></script>
<div class="moduleContainer">
    <h3 class="title-h5 bordBtm2">短信服务基础设置</h3>
    <div class="frmItem" style="padding-left:25px;">
    <table>
        <tr>
            <td>短信通道选择：</td>
            <td>
                <form action="<?php echo $this->createUrl('setChannel');?>" methot="post">
                <input type="radio" id="" value="1" name="content" <?php if($channel['content'] == 1){echo ' checked="checked"';}?> />梦网 
                <input type="radio" id="" value="2" name="content"<?php if($channel['content'] == 2){echo ' checked="checked"';}?> />亿美
                <input type="radio" id="" value="3" name="content"<?php if($channel['content'] == 3){echo ' checked="checked"';}?> />拓鹏
                <input type="radio" id="" value="4" name="content"<?php if($channel['content'] == 4){echo ' checked="checked"';}?> />国都
                <input type="submit" value="确定" class="button">
                </form>
            </td>
        </tr>
    </table>
    </div>
    <h3 class="title-h5 bordBtm2">短信类型设置&nbsp;&nbsp;<input type="button" id="add_type" value="添加类型" class="button"></h3>
    <div class="frmItem" style="padding-left:25px;">
    <table>
        <tr class="order-hd">
            <td width="100">类型名称</td>
            <td width="100">状态</td>
            <td width="100">操作</td>
        </tr>
        <?php 
        if($list):
        foreach($list as $val):
        ?>
        <tr>
            <td><?php echo $val['name']?></td>
            <td><?php echo $val['status'] == 1 ? '禁用' : '正常'?></td>
            <td>
                <?php if($val['status'] == 1):?>
                <a href="<?php echo $this->createUrl('update',array('status'=>0,'id'=>$val['id']));?>">开启</a>
                <?php else:?>
                <a href="<?php echo $this->createUrl('update',array('status'=>1,'id'=>$val['id']));?>">禁用</a>
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach;endif;?>
    </table>
    </div>
    
    <!--<div class="noResult"> <i class="ico-warning"></i><span class="noResult-tips">没有找到您要的结果哦！请重新设置查询条件！</span> </div>-->
</div>

<div id="edit" style="display:none">
<table id="edit_table">
<tr>
	<td>类型名称：</td>
        <td><input type="text" id="edit_value"></td>
</tr>
</table>
</div>

<script>
$(function(){
    $('#add_type').click(function(){
			var obj = $(this);
			$( "#edit" ).dialog({
				title:'创建类型',
				buttons: { 
					"确定": function() {
						var dialog_this = $(this);
						var value = $('#edit_value').val();
						$.getJSON('<?php echo $this->createUrl('add');?>',{name:value},function(data){
							if(data.status == 0){
                                        dialog_this.dialog("close");
								location.reload();
							}else{
								alert(data.msg);
							}
						});
					},
					"取消": function() { 
						$(this).dialog("close"); 
					}
				}
			});
	});
});
</script>