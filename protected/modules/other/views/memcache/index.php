<style type="text/css">
    .tables .order-bd .label {
        text-align: right;padding-right:10px;width: 121px;
    }
    .tables .order-bd td i {color: red;}
    .datepicker {width: 100px;cursor: pointer;}
</style>
<h2 class="title-h4 bordBtm1">Memcache查询器</h2>
<div class="controlWrap">
    <div class="tablesModule">
        <form method="get" id="search-form" action="<?php echo $this->createUrl('index');?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables"><tr><td style="padding-left:20px;">
            选择缓存服务器：
            <?php foreach($servers as $key => $item):?>
            <input type="checkbox" name="server[]" value="<?php echo $key;?>" <?php if(in_array($key, $_REQUEST['server'])){echo 'checked';}?>><?php echo $item['port'];?>
            <?php endforeach;?>
            <br>
            查询类型：
            <input type="radio" name="type" value="status" <?php if($_REQUEST['type'] == 'status'){echo 'checked';}?>>系统状态
            <!--<input type="radio" name="type" value="showlist" <?php if($_REQUEST['type'] == 'showlist'){echo 'checked';}?>>所有未过期-->
            <input type="radio" name="type" value="key" <?php if($_REQUEST['type'] == 'key'){echo 'checked';}?>>查询值
            <?php if(!empty($data)):?>
            <input type="radio" name="type" value="del" <?php if($_REQUEST['type'] == 'del'){echo 'checked';}?>>清除值
            <?php endif;?>
            <br>
            Key：<input type="text" name="key" value="<?php echo $_REQUEST['key']; ?>" size="80">
            HashKey:<input type="checkbox" name="hashKey" value="1">
            <br>
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit">查询</button>
            </span>
            
                
                
                
            </td></tr></table>
        </form>
    </div>
</div>

<div class="tablesModule">
    <?php 
if($_REQUEST['type'] == 'status' || $_REQUEST['type'] == 'showlist'){
    echo $show;
}else{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
?>
    
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