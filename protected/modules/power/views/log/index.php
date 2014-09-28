<script type="text/javascript" src="/statics/plugins/jquery.ui/js/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="/statics/plugins/jquery.ui/css/smoothness/jquery-ui-1.8.19.custom.css"/>
<style type="text/css">
    .tables .order-bd .label {
        text-align: right;padding-right:10px;width: 121px;
    }
    .tables .order-bd td i {color: red;}
    .datepicker {width: 100px;cursor: pointer;}
</style>
<h2 class="title-h4 bordBtm1">日志列表</h2>
<div class="controlWrap">
    <div class="searchModule">
        <form method="post" id="search-form" action="<?php echo $this->createUrl('index');?>">
            访问地址：<input type="text" name="url" value="<?php echo $search['url']; ?>">
            访问员工ID：<input type="text" name="admin_id" value="<?php echo $search['admin_id']; ?>">
            访问员工姓名：<input type="text" name="admin_tname" value="<?php echo $search['admin_tname']; ?>">
            开始时间：<input class="datepicker" readonly="readonly" value="<?php echo $search['time_start'] ?>" type="text" name="time_start"/>
            结束时间：<input class="datepicker" readonly="readonly" value="<?php echo $search['time_end'] ?>" type="text" name="time_end"/>
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit">查询</button>
            </span>
        </form>
    </div>
</div>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd">
                <th width="40%">访问地址</th>
                <th width="150">访问员工</th>
                <th width="150">访问时间</th>
                <th width="100">访问IP</th>
                <th >操作参数</th>
            </tr>
        </thead>
        <?php foreach ($list as $val): ?>
            <tr class="order-bd">
                <td class="urlContent2"><?php echo $val->url ?></td>
                <td class="txt-center"><?php echo $val->admin_id.' - '.$val->admin_tname ?></td>
                <td class="txt-center"><?php echo date('Y-m-d H:i', $val->time) ?></td>
                <td class="txt-center"><?php echo $val->ip ?></td>
                <td class="urlContent2"><?php echo $val->post ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
    echo '记录数：', $count;
    $this->widget('CLinkPager', array(
        'pages' => $pagination,
        'cssFile' => false,
        'header' => ''
    ))
    ?>
</div>

<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        
        $("#search-form").submit(function(e) {
            var fArr = $("input[name=reg_time_from]", this).val().split('-');
            var tArr = $("input[name=reg_time_to]", this).val().split('-');
            var fData = new Date();
            var tData = new Date();
            if (fArr.length > 1) {
                fData.setFullYear(fArr[0], fArr[1] - 1, fArr[2]);
            }
            if (tArr.length > 1) {
                tData.setFullYear(tArr[0], tArr[1] - 1, tArr[2]);
            }
            if ((fData.getFullYear() + "-" + fData.getMonth()) != (tData.getFullYear() + "-" + tData.getMonth())) {
                alert("开始时间和结束时间不是在同一个月，不能跨月查询");
                e.preventDefault();
            }
        });
    });
</script>