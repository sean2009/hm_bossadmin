<!doctype html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->getPageTitle(); ?></title>
        <link rel="stylesheet" href="<?php echo ERand::randomCSSDomain(); ?>/css/mmall/manage/boss/common.css?<?php ECHO CSS_VERSION; ?>" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/statics/css/pager.css?<?php ECHO CSS_VERSION; ?>" />
        <script type="text/javascript" src="<?php echo ERand::randomJSDomain(); ?>/js/public.js?<?php ECHO JS_VERSION; ?>"></script>
    <body>
        <div class="main" style="margin: 0 20px;"> 
            <?php echo $content ?>
        </div>
    </body>
</html>