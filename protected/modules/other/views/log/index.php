<style type="text/css">
    .tables .order-bd .label {
        text-align: right;padding-right:10px;width: 121px;
    }
    .tables .order-bd td i {color: red;}
    .datepicker {width: 100px;cursor: pointer;}
</style>
<h2 class="title-h4 bordBtm1">通用日志查询功能</h2>
<div class="controlWrap">
    <div class="searchModule">
        <form method="get" id="search-form" action="<?php echo $this->createUrl('index');?>">
            数据库：<input type="text" name="db_name" value="<?php echo $_REQUEST['db_name']; ?>">
            日志名：<input type="text" name="table_name" value="<?php echo $_REQUEST['table_name']; ?>">
            查询条件：<input type="text" name="find" value='<?php echo $_REQUEST['find']; ?>' size="100">
            排序条件：<input type="text" name="sort" value='<?php echo $_REQUEST['sort']; ?>' size="30">
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit">查询</button>
            </span>
        </form>
        使用说明：查询条件和排序条件使用数组格式，如查询admin_id = 9999的，条件写为array("admin_id"=>"9999")，如倒序排序：array("_id"=>0)
    </div>
</div>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd" id="head_title"></tr>
        </thead>
        <?php
        $k_arr = array();
		if(!empty($cursor)):
        foreach ($cursor as $obj):
        ?>
        <tr class="order-bd">
            <?php foreach ($obj as $k => $v):
                $k_arr[$k] = $k;
            ?>
            <td class="txt-center"><?php if(is_array($v)){print_r($v);}else{echo $v;};?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;endif;?>
    </table>
    分页：
    <a href="<?php echo $this->createUrl('index');?>?<?php echo $page_s;?>">上一页</a> | 
    <a href="<?php echo $this->createUrl('index');?>?<?php echo $page_n;?>">下一页</a>
</div>

<script type="text/javascript">
    $(function() {
        var head_title = '<?php echo implode(',', $k_arr);?>';
        head_title = head_title.split(',');
        $.each(head_title,function(i,v){
            $('#head_title').append('<th>'+v+'</th>');
        });
    });
</script>