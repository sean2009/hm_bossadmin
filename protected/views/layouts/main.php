<!doctype html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->getPageTitle(); ?></title>
        <link rel="stylesheet" href="<?php echo ERand::randomCSSDomain(); ?>/css/mmall/manage/boss/common.css?<?php ECHO CSS_VERSION; ?>" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/statics/css/pager.css?<?php ECHO CSS_VERSION; ?>" />
        <?php  Yii::app()->clientScript->registerCoreScript('jquery');?>
        <!--<script type="text/javascript" src="<?php //echo ERand::randomJSDomain(); ?>/js/public.js?<?php //ECHO JS_VERSION; ?>"></script>-->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/jquery.ui/js/jquery-ui-1.8.21.custom.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/jquery.ui/css/start/jquery-ui-1.8.21.custom.css" type="text/css" media="all" />

        <script>
            var showMessage = function(msg) {
                alert(msg);
                return true;
                $('.errorTips span').text(msg);
                $('.errorTips').removeClass('hidden');
                $('.errorTips').hide("slow");
            }
        </script>
    <body>
        <div class="main">
            <div class="moduleContainer">
                <?php echo $content; ?>
            </div>
            <div class="errorTips hidden"><span>未选中任何选项！</span></div>
        </div>

    </body>
</html>