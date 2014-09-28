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
            <td align="right"><?php echo $form->labelEx($model, 'mobiles'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'mobiles', array('maxlength' => 11)); ?>
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