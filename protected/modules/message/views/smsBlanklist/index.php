<h2 class="title-h4 bordBtm1">短信黑名单列表</h2>
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
</script>
<div class="controlWrap">
    <?php
    //配置按钮
    $this->widget('ListButtonWidget', array('buttons' => array(
            array('添加', 'message_smsBlanklist_add', $this->createUrl('add'), 'no'),
            array('删除', 'message_smsBlanklist_del', $this->createUrl('del'), 0,'func_power_user_del'),
    )));
    ?>
    <div class="searchModule">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
            手机号码<?php echo $form->textField($model,'mobiles',array('class'=>'inpt','maxlength'=>11)); ?>
            
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
                <th width="2%">手机号码</th>
                <th width="4%">添加时间</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><input type="checkbox" class="sel_ids" name="sel_ids[]" value="<?php echo $v->id; ?>"></td>
                   
                    <td class="txt-center"><?php echo $v->mobiles; ?></td>
                    <td class="txt-center"><?php echo $v->add_time; ?></td>
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