<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/jquery.ui/css/start/jquery-ui-1.8.21.custom.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/jquery.ui/js/jquery-ui-1.8.21.custom.min.js"></script>
<div class="moduleContainer">
    <h3 class="title-h5 bordBtm2">订单修正</h3>
    <div class="frmItem" style="padding-left:25px;">
        <table>
            <tr class="order-bd">
                <td>订单编号：</td>
                <td><?php echo $order->tid; ?></td>
            </tr>
            <tr class="order-bd">
                <td>订单状态：</td>
                <td><?php echo $order->status; ?></td>
            </tr>
            <tr class="order-bd">
                <td>买家昵称：</td>
                <td><?php echo $order->buyer_nick; ?></td>
            </tr>
            <tr class="order-bd">
                <td>订单创建时间：</td>
                <td><?php echo $order->created; ?></td>
            </tr>
        </table>
    </div>
    <h3 class="title-h5 bordBtm2">商品详情</h3>
    <div class="tablesModule">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
            <thead>
                <tr class="order-hd">
                    <th width="50">商品名称</th>
                    <th width="2%">商品价格</th>
                    <th width="20">购买数量</th>
                    <th width="5%">SKU描述</th>
                    <!--<th width="45">商家编码</th>-->
                    <th width="45">商家SKU编码</th>
                    <th width="4%">操作</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($goods as $v): ?>
                    <tr class="order-bd">
                        <td class="txt-center"><?php echo $v->title; ?></td>
                        <td class="txt-center"><?php echo $v->price; ?></td>
                        <td class="txt-center"><?php echo $v->num; ?></td>
                        <td class="txt-center"><?php echo $v->sku_properties_name; ?></td>
                        <!--<td class="txt-center"><input type="text" name="Data[<?php echo $v->id; ?>][outer_iid]" value="<?php echo $v->outer_iid; ?>"></td>-->
                        <td class="txt-center"><input id="outer_sku_<?php echo $v->id; ?>" type="text" name="Data[<?php echo $v->id; ?>][outer_sku_id]" value="<?php echo $v->outer_sku_id; ?>"></td>
                        <td class="txt-center">
                            <button type="button" title="确 定" class="button btn_sku_upd" order_goods_id="<?php echo $v->id; ?>" hidefocus="true">确 定</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="order-bd">
                    <td class="txt-center" colspan="6">

                        <span class="btn-link btn-link3">
                            <button type="button" title="取 消" class="button" onClick="javascript:location.href = '<?php echo $this->createUrl('error'); ?>';">返回异常单列表</button>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<input type="hidden" name="order_id" id="order_id" value="<?php echo $order->id?>">
<input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $order->supplier_id?>">
<div id="edit">
</div>

<script>
    $(function() {
        $('.btn_sku_upd').click(function() {
            var order_id = $('#order_id').val();
            var supplier_id = $('#supplier_id').val();
            var order_goods_id = $(this).attr('order_goods_id');
            var outer_sku = $('#outer_sku_' + order_goods_id).val();
            if (!outer_sku) {
                alert('商家SKU编码不能为空！');
                return false;
            }
            $.getJSON('<?php echo $this->createUrl('sku'); ?>', {order_id:order_id,supplier_id:supplier_id,order_goods_id: order_goods_id, sku: outer_sku}, function(data) {
                if (data.code == 'success') {
                    alert('校对成功!');
                } else if (data.code == 'error') {
                    alert(data.msg);
                } else if (data.code == 'throw') {
                    $('#edit').html(data.msg);
                    $("#edit").dialog({
                        title: '选择商品',
                        width:520,
                        buttons: {
                            "确定": function() {
                                var dialog_this = $(this);
                                var sel_radio_obj = $(".sku_radio:checked");
                                var sel_length = sel_radio_obj.length;
                                var sel_sku = sel_radio_obj.val();
                                var sel_goods_id = sel_radio_obj.attr('sel_goods_id');
                                var sel_goods_sn = sel_radio_obj.attr('sel_goods_sn');
                                $.getJSON('<?php echo $this->createUrl('updateSku'); ?>', {order_id:order_id,order_goods_id: order_goods_id,outer_sku_id:outer_sku,goods_sku:sel_sku,goods_id:sel_goods_id,goods_sn:sel_goods_sn}, function(data) {
                                    if (data.code == 'success') {
                                        dialog_this.dialog("close");
                                        alert('选择校对成功！');
                                    } else {
                                        alert(data.msg);
                                    }
                                });
                            },
                            "取消": function() {
                                $(this).dialog("close");
                            }
                        }
                    });
                } else {
                    alert('登录已过期，请重新登录');
                    return false;
                }
            });
        })
    });
</script>