<h2 class="title-h4 bordBtm1">错误日志列表</h2>
<div class="controlWrap">
    <div class="searchModule">
        <form method="get" action="<?php echo $this->createUrl('error');?>">
        类型<input type="text" name="type" value="<?php echo $search['type'];?>">
        开始时间<input type="text" name="start_time" value="<?php echo $search['start_time'];?>">
        结束时间<input type="text" name="end_time" value="<?php echo $search['end_time'];?>">
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit">查询</button>
            </span>
            <!--<a title="高级查询" id="seniorSearchBut" class="btn-fold" href="javascript:void(0);">高级查询</a>-->
        </form>
    </div>
</div>
<?php // include_once '_search.php'; ?>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd">
                <th width="2%">类型</th>
                <th width="2%">名称</th>
                <th width="10%">内容</th>
                <th width="4%">添加时间</th>
            </tr>
        </thead>
        <tbody>
<?php 
if($list):
foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><?php echo $v['type']; ?></td>
                    <td class="txt-center"><?php echo $v['typeName']; ?></td>
                    <td class="txt-center"><?php echo $v['errorMsg']; ?></td>
                    <td class="txt-center"><?php echo date('Y-m-d H:i:s',$v['add_time']); ?></td>
                </tr>
<?php endforeach;endif; ?>
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