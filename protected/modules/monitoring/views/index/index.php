<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/jquery.ui/css/start/jquery-ui-1.8.21.custom.css?<?php ECHO CSS_VERSION; ?>" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/jquery.ui/js/jquery-ui-1.8.21.custom.min.js?<?php ECHO JS_VERSION; ?>"></script>
<h2 class="title-h4 bordBtm1">消息树</h2>
<div class="controlWrap">
    <div class="searchModule">
        <form method="get" action="<?php echo $this->createUrl('index');?>">
        地址标识<input type="text" name="id" value="<?php echo $search['id'];?>">
        日志时间<input type="text" name="tableName" value="<?php echo $search['tableName'];?>">
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
                <th width="60">操作</th>
                <th width="400">请求路径</th>
                <th width="100">时间</th>
                <th width="200">SESSION_ID</th>
                <th width="200">登录token</th>
            </tr>
        </thead>
        <tbody>
<?php 
if($list):
foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center">
                        <a href="<?php echo $this->createUrl('list',array('url_id'=>$v['id']));?>">查看详情</a>
                        <!--<a href="<?php echo $this->createUrl('index',array('session_id'=>$v['session_id']));?>">用户轨迹</a>-->
                    </td>
                    <td class="urlContent2" url_id="<?php echo $v['id']; ?>" style="padding-left: 10px;"><?php echo $v['url']; ?></td>
                    <td class="txt-center"><?php echo $v['starttime']; ?></td>
                    <td class="txt-center"><a href="<?php echo $this->createUrl('index',array('session_id'=>$v['session_id']));?>"><?php echo $v['session_id']; ?></a></td>
                    <td class="txt-center"><?php echo $v['login_token']; ?></td>
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

<div id="edit" style="display:none">
<table id="edit_table">
<tr>
    <td id="edit_title"><iframe id="iframe_url" src=""></iframe></td>
</tr>
</table>
</div>


<script>
    $(function(){
        $('.urlContent').click(function(){
            var url_id = $(this).attr('url_id');
            var iframe_url = '<?php echo $this->createUrl('list');?>?url_id=' + url_id;
            $('#iframe_url').attr('src',iframe_url);
            $( "#edit" ).dialog({
				title:'编辑',
                                width:500,
				buttons: {
					"关闭": function() { 
						$(this).dialog("close"); 
					}
				}
			});
        });
    });
    </script>