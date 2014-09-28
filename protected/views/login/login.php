<!doctype html>
<html lang="zh-cn">

    <head>
        <meta charset="utf-8">
        <title>登录-集成后台管理系统</title>
        <link rel="stylesheet" href="<?php echo CSS_DOMAIN1; ?>/css/mmall/manage/boss/common.css" />
        <link rel="stylesheet" href="<?php echo CSS_DOMAIN1; ?>/css/mmall/manage/boss/login.css" />
        <script type="text/javascript" src="<?php echo CSS_DOMAIN1; ?>/js/public.js"></script>
    </head>
    <body>
        <div class="head">
            <div class="head_bar" id="head">
                <a href="javascript:void(0)" title="集成后台系统" class="logo_boss">集成后台系统</a>
                <div class="head_login">您好，欢迎来红星美凯龙</div>
            </div>
        </div>
        <div class="wrap" id="wrap">
            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
                <div class="login_wrap">
                    <div class="login_item">
                        <h2 class="title">会员登录</h2>
                        <ul class="login_area">
                            <li><label class="name">用户名：</label>
                                <?php echo $form->textField($model,'username',array('class'=>'input_txt','maxlength'=>30)); ?>
                                <div class="msg_tips"><span id="span_user" style="color: #FF0000;"><?php echo $form->error($model,'username'); ?></span></div>
                            </li>
                            <li><label class="name">密码：</label>
                                <?php echo $form->passwordField($model,'password',array('class'=>'input_txt','maxlength'=>30)); ?>
                                <div class="msg_tips"><span id="span_pwd" style="color: #FF0000;"><?php echo $form->error($model,'password'); ?></span></div>
                            </li>
                            <li><label class="name">验证码：</label>
                                <?php echo $form->textField($model,'captcha',array('class'=>'input_txt input_sw','maxlength'=>6)); ?>
                                <img src="<?php echo $this->createUrl('captcha'); ?>" id="captcha" width="200px;" height="50px;" class="code_img"  onclick="reCaptcha();"/>
                                <div class="msg_tips"><span id="span_cap" style="color: #FF0000;"><?php echo $form->error($model,'captcha'); ?></span></div>
                            </li>
                            <li class="select_file" style="display:none;"><label class="select_c"><input id="admin_type_1" name="admin_type" value="1" class="input_radio" type="radio" />员工</label><label class="select_c"><input id="admin_type_2" name="admin_type" value="0" class="input_radio" type="radio" />管理员</label>
                            </li>
                            <li class="btn_file"><input class="input_btn login_btn" type="submit" value="登  录"/></li>
                        </ul>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="foot" id="foot">Copyright©2012 红星美凯龙家居集团股份有限公司 版权所有</div>
    </body>
    <script type="text/javascript">
                                    //提交
                                    function butSubmit() {
                                        var _name = $('#admin_user').val();
                                        var _passwd = $('#admin_passwd').val();
                                        var _captcha = $('#captcha-form').val();
                                        if (_name == "") {
                                            alert("请填写用户名");
                                            $('#admin_user').focus();
                                            return false;
                                        }
                                        if (_passwd == "") {
                                            alert("请填写密码");
                                            $('#admin_passwd').focus();
                                            return false;
                                        }
                                        if (_captcha == "") {
                                            alert("请填写验证码");
                                            $('#captcha-form').focus();
                                            return false;
                                        }
                                        $("#formDate").submit();
                                    }
                                  
                                    //更新验证码
                                    function reCaptcha() {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo $this->createUrl('captcha', array('refresh' => 1)); ?>",
                                            data: "",
                                            dataType: "json",
                                            async: false,
                                            cache: false,
                                            error: function() {
                                                alert('操作失败!');
                                            },
                                            success: function(data) {
                                                $('#captcha').attr('src', data.url);
                                            }
                                        });
                                    }
                                    $(function() {
                                        //更新验证码
                                        reCaptcha();
                                        $("#aside_menu .nav_item").click(function() {
                                            $(this).siblings(".show_menu").toggleClass('hidden');
                                            $(this).find(".handle_icon").toggleClass('minus_icon');
                                        })
                                    })
    </script>
</html>