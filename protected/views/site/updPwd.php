<h2 class="title-h4 bordBtm1">修改密码<?php if($type == 'onelogin'){echo '（首次登录请修改密码！）';}?></h2>
<style>
    .errorSummary{color: #FF0000}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'admin-user-model-form',
    'enableAjaxValidation' => false,
        ));
?>
<input type="hidden" name="type" value="<?php echo $type;?>">
<div class="tablesModule">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <tr class="order-bd">
            <td class="txt-right" width='200' aligt='right'></td>
            <td class="txt-left">
                <?php echo $form->errorSummary($model); ?></td>
        </tr>
        <tr class="order-bd">
            <td align="right">真实姓名：</td>
            <td class="txt-left">
                <?php echo $row->admin_tname;?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right">登录名：</td>
            <td class="txt-left">
                <?php echo $row->admin_name;?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right">类型：</td>
            <td class="txt-left">
                <?php
                $data = array('员工', '管理员');
                echo $data[$row->admin_type];
                ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right">原密码：</td>
            <td class="txt-left">
                <?php echo $form->passwordField($model, 'oldPwd', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right">新密码：</td>
            <td class="txt-left">
                <?php echo $form->passwordField($model, 'newPwd', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right">重复新密码：</td>
            <td class="txt-left">
                <?php echo $form->passwordField($model, 'newPwd2', array('maxlength' => 30)); ?>
            </td>
        </tr>
        
        <tr class="order-bd">
            <td class="txt-right"></td>
            <td class="txt-left">
                <span class="btn-link btn-link1">
                    <button type="submit" title="保 存" class="button" hidefocus="true">保 存</button>
                </span>

                <span class="btn-link btn-link3">
                    <button type="button" title="取 消" class="button" onClick="javascript:window.history.back();">取 消</button>
                </span>
            </td>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>