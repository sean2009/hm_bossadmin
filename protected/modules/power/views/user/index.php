<h2 class="title-h4 bordBtm1">员工列表</h2>
<script>
    function func_power_user_del(obj,ids){
        $.getJSON('<?php echo $this->createUrl('del');?>',{ids:ids},function(data){
            if(data.status == 'success'){
                alert('操作成功！');
                window.location.reload();
            }else{
                alert(data.msg);
            }
        });
    }
    function func_power_user_reset(obj,ids){
        $.getJSON('<?php echo $this->createUrl('resetPwd');?>',{ids:ids},function(data){
            if(data.status == 'success'){
                alert('操作成功！');
                window.location.reload();
            }else{
                alert(data.msg);
            }
        });
    }
</script>
<div class="controlWrap">
    <?php
    //配置按钮
    $this->widget('ListButtonWidget', array('buttons' => array(
            array('添加', 'power_user_add', $this->createUrl('add'), 'no'),
            array('修改', 'power_user_upd', $this->createUrl('upd'), 1),
            array('删除', 'power_user_del', $this->createUrl('del'), 1,'func_power_user_del'),
            array('重置密码', 'power_user_reset', $this->createUrl('reset'), 1,'func_power_user_reset'),
    )));
    ?>
    <div class="searchModule">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
            真实姓名<?php echo $form->textField($model,'admin_tname',array('class'=>'inpt','maxlength'=>30)); ?>
            用户名<?php echo $form->textField($model,'admin_name',array('class'=>'inpt','maxlength'=>30)); ?>
            
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
                <th width="2%">真实姓名</th>
                <th width="10%">登录名</th>
                <th width="5%">联系电话</th>
                <th width="4%">最后登录时间</th>
                <th width="4%">登录次数</th>
                <th width="4%">类型</th>
                <th width="4%">角色组</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><input type="checkbox" class="sel_ids" name="sel_ids[]" value="<?php echo $v->admin_id; ?>"></td>
                    <td class="txt-center"><?php echo $v->admin_id; ?></td>
                    <td class="txt-center"><?php echo $v->admin_tname; ?></td>
                    <td class="txt-center"><?php echo $v->admin_name; ?></td>
                    <td class="txt-center"><?php echo $v->mobile; ?></td>
                    <td class="txt-center"><?php echo $v->last_login_date; ?></td>
                    <td class="txt-center"><?php echo $v->login_num; ?></td>
                    <td class="txt-center"><?php if($v->admin_type){echo '管理员';}else{echo '员工';}?></td>
                    <td class="txt-center"><?php if($v->role_id == 1){echo '超级管理员';}else{echo $v->role->role_name;}; ?></td>
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