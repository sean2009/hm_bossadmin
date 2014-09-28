<script type="text/javascript">
function func_power_role_del(obj,ids){
        if(confirm("您确定要删除这个角色吗？")){
            $.getJSON('<?php echo $this->createUrl('del');?>',{ids:ids},function(data){
                if(data.status == 'success'){
                    alert('操作成功！');
                    window.location.reload();
                }else{
                    alert(data.msg);
                }
            });
    }
    }
</script>
<h2 class="title-h4 bordBtm1">角色列表</h2>
<div class="controlWrap">
    <?php
    //配置按钮
    $this->widget('ListButtonWidget', array('buttons' => array(
            array('添加', 'power_role_add', $this->createUrl('add'), 'no'),
            array('修改', 'power_role_upd', $this->createUrl('upd'), 1),
           // array('删除', 'power_role_del', $this->createUrl('del'), 1,'func_power_role_del'),
    )));
    ?>
    <div class="searchModule">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
            角色名:<?php echo $form->textField($model,'role_name',array('class'=>'inpt','maxlength'=>30)); ?>
            
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit">查询</button>
            </span>
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php // include_once '_search.php'; ?>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd">
                <th width="30">&nbsp;&nbsp;</th>
                <th>编号</th>
                <th>角色名</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>创建用户</th>
                <th>最后修改用户</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><input type="checkbox" class="sel_ids" name="sel_ids[]" value="<?php echo $v->id; ?>"></td>
                    <td class="txt-center"><?php echo $v->id; ?></td>
                    <td class="txt-center"><?php echo $v->role_name; ?></td>
                    <td class="txt-center"><?php echo $v->add_date; ?></td>
                    <td class="txt-center"><?php echo $v->edit_date; ?></td>
                    <td class="txt-center"><?php echo $list_user[$v->add_admin_id]; ?></td>
                    <td class="txt-center"><?php echo $list_user[$v->edit_admin_id]; ?></td>
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