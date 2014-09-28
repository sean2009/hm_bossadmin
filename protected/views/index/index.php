<!doctype html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title>集成后台系统</title>
        <link rel="stylesheet" href="<?php echo CSS_DOMAIN1; ?>/css/mmall/manage/boss/common.css?<?php ECHO CSS_VERSION; ?>" />
        <script type="text/javascript" src="<?php echo JS_DOMAIN1; ?>/js/public.js?<?php ECHO JS_VERSION; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/data/static/menu.js?<?php ECHO JS_VERSION; ?>"></script>

        <!-- 滚动条 -->
        <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/data/static/jscrollspan/style/jquery.jscrollpane.css?<?php ECHO CSS_VERSION; ?>" />
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/data/static/jscrollspan/jquery.jscrollpane.min.js?<?php ECHO JS_VERSION; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/data/static/jscrollspan/jquery.mousewheel.js?<?php ECHO JS_VERSION; ?>"></script>
        <!-- 滚动条结束 -->
        <?php // foreach($login_url as $url):?>
        <!--<script type="text/javascript" src="<?php // echo $url.'?token='.$token.'&t='.time(); ?>"></script>-->
        <?php // endforeach;?>
        <style>
            .power_menu_one{cursor: pointer}
        </style>
        <script>
            $(function() {
                $('.power_menu_one').click(function() {
                    $('.aside_menu').hide();
                    var next = $(this).attr('next');
                    $('.power_menu_two_' + next).show();
                    $('.head_Nav li').removeClass('curr');
                    $(this).parent().addClass('curr');
                    athe();
                });
                $('.aside_menu').first().show();
                $('.power_menu_two_' + $('.power_menu_one:first').attr('next')).show();

            });
        </script>
    </head>
    <body>
        <div class="head">
            <div class="head_bar" id="head"> <a href="javascript:void(0)" title="集成后台系统" class="logo_boss">集成后台系统</a>
                <div class="head_login">
                    <span  style="color:#FF0000"><?php echo $this->admin_tname; ?></span>&nbsp;您好，欢迎来到集成后台管理系统<span class="exit">&nbsp;&nbsp;
                        [<a href="<?php echo $this->createUrl('/site/upd'); ?>" title="修改密码">修改密码</a>]
                        [<a href="<?php echo $this->createUrl('/login/logout'); ?>" title="退出">退出</a>]
                    </span>&nbsp;&nbsp;</div>
                
                <ul class="head_Nav">
                    <?php if (Yii::app()->adminuser->admin_type): ?>
                    <li class="curr"><a href="javascript:void(0)" class="power_menu_one" next="admin">权限管理</a></li>
                    <?php endif; ?>
                    <?php foreach ($list[0] as $val): ?>
                    <li><a href="javascript:void(0)" class="power_menu_one" next="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></a></li>
                    <?php endforeach; ?>
                   </ul>
                
                <ul class="head_menu" id="head_menu">
                    <li class="home" id="head_menu_0" menuid="0"><a href="javascript:void(0)" title="首页"><b class="home_ico"></b>首页</a></li>
                </ul>
            </div>
        </div>
        <div class="wrap" id="wrap">
            <div class="aside">
                <div class="aside_wrap" id="aside_wrap">
                    <div class="scro">
                        <ul class="aside_menu power_menu_two_admin" id="aside_menu" style="display:none">
                            <?php if (Yii::app()->adminuser->admin_type == 1): ?>
                                <li>
                                    <h3 class="nav_item"><a href="javascript:void(0)" title="系统管理">系统管理</a><b class="handle_icon minus_icon"></b></h3>
                                    <ul class="show_menu" style="display: block;">
                                        <?php if(Yii::app()->adminuser->admin_id == AdminController::ADMIN_MID):?>
                                        <li id="showmenu_a1"><a href="javascript:void(0)" menuid='1' url="<?php echo $this->createUrl('power/menu/index'); ?>" title="菜单设置">菜单设置</a></li>
                                        <li id="showmenu_a3"><a href="javascript:void(0)" menuid='4' url="<?php echo $this->createUrl('power/log/index'); ?>" title="操作日志">操作日志</a></li>
                                        <?php endif;?>
                                        <li id="showmenu_a2"><a href="javascript:void(0)" menuid='2' url="<?php echo $this->createUrl('power/user/index'); ?>" title="员工管理">员工管理</a></li>
                                        <li id="showmenu_a3"><a href="javascript:void(0)" menuid='3' url="<?php echo $this->createUrl('power/role/index'); ?>" title="角色管理">角色管理</a></li>
                                        
                                    </ul>	
                                </li>
                            <?php endif; ?>
                        </ul>
                        <?php foreach ($list[0] as $val): ?>
                            <ul class="aside_menu power_menu_two_<?php echo $val['id']; ?>" id="aside_menu" style="display:none">
                                <?php
                                foreach ($list[$val['id']] as $val_t):
                                    ?>
                                    <li>
                                        <h3 class="nav_item"><a href="javascript:void(0)" title="<?php echo $val_t['name']; ?>"><?php echo $val_t['name']; ?></a><b class="handle_icon minus_icon"></b></h3>
                                        <ul class="show_menu" style="display: block;">
                                            <?php
                                            if ($list[$val_t['id']]):
                                                foreach ($list[$val_t['id']] as $key=>$val_g):
                                                    ?>
                                                    <li id="showmenu_a1"><a href="javascript:void(0)" menuid='<?php echo $val_g['id']; ?>' url="<?php if($val_g['url_type']==1){echo POWER_SHOPADMIN_URL;}elseif($val_g['url_type']==2){echo POWER_MADMIN_URL;};echo $val_g['url']; ?>" title="<?php echo $val_g['name']; ?>"><?php echo $val_g['name']; ?></a></li>
                                                <?php endforeach;
                                            endif; ?>
                                        </ul>	
                                    </li>
                            <?php endforeach; ?>
                            </ul>
<?php endforeach; ?>
                    </div>
                </div>
                <div class="retune"><i class="arr_right"></i></div>
            </div>
            <div class="main">
                <div id="iframe_0" menuid="0" class="main_iframe"><iframe width="100%" src="/index/main"></iframe></div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
<!--

    function autoHeight() {
        var height = $(window).height() - $('#head').outerHeight();
        $('#wrap').height(height);
        $('.main_iframe iframe').height(height - 10);
    }

    function jspan() {
        $(".scro").jScrollPane({
            mouseWheelSpeed: 60,
        });
        if ($(".jspPane").width() == 160) {
            $(".jspPane").width("165");
        }
    }
    autoHeight()
    jspan();
    $(window).resize(athe());
    function athe() {
        autoHeight();
        jspan();

    }
 
-->
</script>