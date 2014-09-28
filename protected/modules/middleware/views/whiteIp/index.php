<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/statics/plugins/jquery.ui/css/start/jquery-ui-1.8.21.custom.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/statics/plugins/jquery.ui/js/jquery-ui-1.8.21.custom.min.js"></script>
<script>
function dialog_add(obj,ids){
    $( "#edit" ).dialog({
            title:'添加',
            buttons: { 
                    "确定": function() {
                            var dialog_this = $(this);
                            var value_name = $('#edit_value_name').val();
                            var value_ip = $('#edit_value_ip').val();
                            if(!value_name || !value_ip){
                                alert('名称和IP不能为空！');
                                return false;
                            }
                            $.getJSON('<?php echo $this->createUrl('add');?>',{name:value_name,ip:value_ip},function(data){
                                    if(data.status == 'success'){
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
}
function dialog_upd(obj,ids){
    $.getJSON('<?php echo $this->createUrl('get');?>',{id:ids},function(data){
        $('#edit_value_name').val(data.api_type);
        $('#edit_value_ip').val(data.white_ip);
        $( "#edit" ).dialog({
            title:'修改',
            buttons: { 
                    "确定": function() {
                            var dialog_this = $(this);
                            var value_name = $('#edit_value_name').val();
                            var value_ip = $('#edit_value_ip').val();
                            if(!value_name || !value_ip){
                                alert('名称和IP不能为空！');
                                return false;
                            }
                            $.getJSON('<?php echo $this->createUrl('upd');?>',{id:ids,name:value_name,ip:value_ip},function(data){
                                    if(data.status == 'success'){
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
}
function dialog_del(obj,ids){
    if(confirm('确定删除选中值吗？')){
        $.getJSON('<?php echo $this->createUrl('del');?>',{id:ids},function(data){
            if(data.status == 'success'){
                    location.reload();
            }else{
                    alert(data.msg);
            }
        });
    }
}
</script>
<h2 class="title-h4 bordBtm1">OpenApi白名单</h2>
<div class="controlWrap">
    <?php
    //配置按钮
    $this->widget('ListButtonWidget', array('buttons' => array(
            array('添加', 'middleware_whiteip_add', $this->createUrl('add'),'no','dialog_add',array('other'=>'ss')),
            array('修改', 'middleware_whiteip_upd', $this->createUrl('upd'), 1,'dialog_upd'),
            array('删除', 'middleware_whiteip_del', $this->createUrl('del'), 0,'dialog_del'),
    )));
    ?>
    <div class="searchModule">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
            应用名称<?php echo $form->textField($model,'api_type',array('class'=>'inpt','maxlength'=>30)); ?>
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit">查询</button>
            </span>
            <!--<a title="高级查询" id="seniorSearchBut" class="btn-fold" href="javascript:void(0);">高级查询</a>-->
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php // include_once '_search.php'; ?>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd">
                <th width="2%">&nbsp;&nbsp;</th>
                <th width="2%">编号</th>
                <th width="2%">应用名称</th>
                <th width="10%">白名单</th>
                <th width="4%">添加时间</th>
                <th width="4%">更新时间</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><input type="checkbox" class="sel_ids" name="sel_ids[]" value="<?php echo $v->id; ?>"></td>
                    <td class="txt-center"><?php echo $v->id; ?></td>
                    <td class="txt-center"><?php echo $v->api_type; ?></td>
                    <td class="txt-center"><?php echo $v->white_ip; ?></td>
                    <td class="txt-center"><?php echo $v->add_time; ?></td>
                    <td class="txt-center"><?php echo $v->upd_time; ?></td>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="ui-pagination2">
    <div class="pager clearfix"><?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'cssFile' => false,
            'header' => ''
        ))
        ?></div></div>
<div class="noResult hidden"> <i class="ico-warning"></i><span class="noResult-tips">没有找到您要的结果哦！请重新设置查询条件！</span> </div>
</div>

<div id="edit" style="display:none">
<table id="edit_table">
<tr>
	<td>应用名称：</td>
        <td><input type="text" id="edit_value_name" maxlength="10"></td>
</tr>
<tr>
	<td>白名单IP：</td>
        <td><input type="text" id="edit_value_ip" maxlength="20"></td>
</tr>
</table>
</div>