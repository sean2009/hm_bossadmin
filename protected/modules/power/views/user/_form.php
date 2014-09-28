<style>
    .errorSummary{color: #FF0000}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'admin-user-model-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="tablesModule">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <tr class="order-bd">
            <td class="txt-right" width='200' aligt='right'></td>
            <td class="txt-left"><?php echo $form->errorSummary($model); ?></td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'admin_tname'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'admin_tname', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <?php if(isset($type)):?>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'admin_name'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'admin_name', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <?php else:?>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'admin_name'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'admin_name', array('maxlength' => 30,'readonly'=>true)); ?>
            </td>
        </tr>
        <?php endif;?>
        <?php if(isset($type)):?>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'passwd'); ?></td>
            <td class="txt-left">
                <?php echo $form->passwordField($model, 'passwd', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <?php endif;?>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'email'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'email', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'mobile'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'mobile', array('maxlength' => 11)); ?>（请输入真实手机号码！）
            </td>
        </tr>
        <?php
        if($model->admin_id != $this->admin_id):
        ?>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'admin_type'); ?></td>
            <td class="txt-left">
                <?php
                if($this->admin_id != AdminController::ADMIN_MID){
                    $data = array('员工');
                }else{
                    $data = array('员工', '管理员');
                }
                echo $form->radioButtonList($model, 'admin_type', $data, array('separator' => ''));
                ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'role_id'); ?></td>
            <td class="txt-left">
                <?php
                $condition = 'is_deleted = 0';
                if($this->admin_id != AdminController::ADMIN_MID){
                    if($this->admin_type == 1){
                        $condition .= ' and add_admin_id = '.$this->admin_id;
                    }
                }
                $data = PowerRoleModel::model()->findAll($condition);
                $data = $this->setDropListArray($data, 'id', 'role_name');
                echo $form->dropDownList($model, 'role_id', $data)
                ?>
            </td>
        </tr>
        <?php endif;?>
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