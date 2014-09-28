<h2 class="title-h4 bordBtm1">全部订单列表</h2>
<div class="controlWrap">
    <?php
    //配置按钮
    $this->widget('ListButtonWidget', array('buttons' => array(
//            array('修正', 'middleware_order_update', $this->createUrl('update'), 1),
    )));
    ?>
    <div class="searchModule">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
            渠道订单号<?php echo $form->textField($model,'tid',array('class'=>'inpt','maxlength'=>30)); ?>
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
                <th width="2%">渠道名称</th>
                <th width="10%">渠道订单号</th>
                <th width="5%">订单状态</th>
                <th width="4%">添加时间</th>
                <th width="4%">更新时间</th>
                <th width="4%">同步状态</th>
                <th width="4%">同步时间</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><input type="checkbox" class="sel_ids" name="sel_ids[]" value="<?php echo $v->id; ?>"></td>
                    <td class="txt-center"><?php echo $v->id; ?></td>
                    <td class="txt-center"><?php echo $v->channel->channel_name; ?></td>
                    <td class="txt-center"><?php echo $v->tid; ?></td>
                    <td class="txt-center"><?php echo $v->status; ?></td>
                    <td class="txt-center"><?php echo $v->sys_add_time; ?></td>
                    <td class="txt-center"><?php echo $v->sys_upd_time; ?></td>
                    <td class="txt-center"><?php echo $v->sys_is_synch; ?></td>
                    <td class="txt-center"><?php echo $v->sys_synch_time; ?></td>
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