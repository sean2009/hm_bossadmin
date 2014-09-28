<style>
    .errorSummary{color: #FF0000}
</style>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/statics/plugins/zTree/jquery.ztree-2.6.min.js");
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/statics/plugins/zTree/zTreeStyle.css");
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'admin-role-model-form',
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
            <td align="right"><?php echo $form->labelEx($model, 'role_name'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'role_name', array('maxlength' => 30)); ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'sign_ids'); ?></td>
            <td class="txt-left">
                <div class="treeview treemenu">
                    <ul id="tree" class="tree" style="width:300px; overflow:auto;"></ul>                    
                </div>
            </td>
        </tr>        


        <tr class="order-bd">
            <td class="txt-right"></td>
            <td class="txt-left">
                <span class="btn-link btn-link1">
                    <?php echo $form->hiddenField($model, 'sign_ids', array('id' => 'sign_ids')); ?>
                    <?php echo $form->hiddenField($model, 'sign_list', array('id' => 'sign_list')); ?>
                    <button type="submit" title="保 存" class="button" hidefocus="true" id="save">保 存</button>
                </span>

                <span class="btn-link btn-link3">
                    <button type="button" title="取 消" class="button" onClick="javascript:window.history.back();">取 消</button>
                </span>
            </td>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(function() {
        var setting = {
            fontCss: setFont,
            showLine: true,
            checkable: true,
            isSimpleData: true,
            treeNodeKey: "id",
            treeNodeParentKey: "pId",
        };
        var zTreeNodes = <?php echo $menuTree; ?>;
        var zTree = $("#tree").zTree(setting, zTreeNodes);

        function setFont(treeId, treeNode) {
            var css = {};
            if (treeNode) {
                if (treeNode.menu_type == 1) {
                    css = {color: "#ff0000"}
                } else if (treeNode.menu_type == 2) {
                    css = {color: "#00ff00"};
                }
            }
            return css;
        }

        $("#save").live("click", function() {

            var selectedNode = zTree.getCheckedNodes();

            var sign_ids = "";
            var sign_list = "";
            for (k in selectedNode) {
                var j = selectedNode[k];
                sign_ids += (j.cid) + ",";
                sign_list += (j.sign) + ",";
            }
            sign_ids = sign_ids.substr(0, sign_ids.length - 1);
            sign_list = sign_list.substr(0, sign_list.length - 1);
            $("#sign_ids").val(sign_ids);
            $("#sign_list").val(sign_list);
            return true;
        })
    });
</script>