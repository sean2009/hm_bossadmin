<script type="text/javascript" src="/statics/plugins/jquery.ui/js/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" rel="stylesheet" href="/statics/plugins/jquery.ui/css/smoothness/jquery-ui-1.8.19.custom.css"/>
<style type="text/css">
    .tables .order-bd .label {
        text-align: right;padding-right:10px;width: 121px;
    }
    .tables .order-bd td i {color: red;}
    .datepicker {width: 100px;cursor: pointer;}
</style>
<?php
    $extLoginTypes = $this->getExtTypes();
?>
<div class="controlWrap">
    <div class="controlModule">
        用户注册记录
    </div>
    <div class="searchModule">
        <form method="post" id="search-form" action="<?php echo $this->createUrl('index');?>">
            注册来源：<input type="text" name="back_act" value="<?php echo $search['back_act']; ?>">
            是否第三方注册用户：
            <?php echo CHtml::dropDownList('ext_login_type', $search['ext_login_type'], array('' => '') + $extLoginTypes) ?>
            开始时间：<input class="datepicker" readonly="readonly" value="<?php echo $search['reg_time_from'] ?>" type="text" name="reg_time_from"/>
            结束时间：<input class="datepicker" readonly="readonly" value="<?php echo $search['reg_time_to'] ?>" type="text" name="reg_time_to"/>
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
                <th width="40%">注册来源地址</th>
                <th>是否是第三方注册</th>
                <th>用户名</th>
                <th >注册时间</th>
            </tr>
        </thead>
        <?php foreach ($list as $val): ?>
            <tr class="order-bd">
                <td class="urlContent2"><?php echo $val->back_act ?></td>
                <td class="txt-center"><?php echo $val->ext_login_type ? $extLoginTypes[$val->ext_login_type] : 'x' ?></td>
                <td class="txt-center"><?php echo $val->ext_login_name ? $val->ext_login_name : $val->login_name ?></td>
                <td class="txt-center"><?php echo date('Y-m-d H:i', $val->reg_time) ?></td>
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