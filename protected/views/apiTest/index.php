<style type="text/css">
    .tables .order-bd .label {
        text-align: right;padding-right:10px;width: 121px;
    }
    .tables .order-bd td i {color: red;}
</style>
<div class="controlWrap">
    <div class="controlModule">
        接口调试（不同环境不能互通，开发环境不能调试测试环境，测试环境不能调试线上环境）
    </div>
</div>
<div class="tablesModule">
    <?php echo CHtml::form($this->createUrl('apiTest/index'), 'post', array('id' => 'api-form')) ?>
    <table class="tables">
        <tr class="order-bd">
            <td class="label">接口地址：</td>
            <td><input type="text" name="url" value="<?php echo $url ?>" style="width: 80%;" /><i>*</i></td>
        </tr>
        <tr class="order-bd">
            <td class="label">接口名称：</td>
            <td><input type="text" value="<?php echo $api_name ?>" style="width: 30%;" name="api_name"/><i>*</i></td>
        </tr>
        <tr class="order-bd">
            <td class="label">参数：</td>
            <td>
                <div style="float:left;"><textarea name="params" rows="16" cols="70"><?php echo $params ?></textarea></div>
                <div style="float: left;padding: 20px;">
                    参数为一个自定义的关联数组，例如：<br/>
                    array(<br/>'username'=>'1213123123',<br/>
                    'password'=>'xxxxx'<br/>)
                </div>
                <div style="clear: both;"></div>
            </td>
        </tr>
        <tr class="order-bd">
            <td>&nbsp;</td>
            <td>
                <span class="btn-link btn-link1">
                    <input type="submit" value="测试" class="button"/>
                </span> 
                <span class="btn-link btn-link3">
                    <input type="reset" value="重置" class="button"/>
                </span>
            </td>
        </tr>
    </table>
    <?php echo CHtml::endForm() ?>    
    <h2 style="font-weight: bold;margin: 10px 0;">接口返回结果</h2>
    <span>
        返回说明：如果返回null，就说明，服务端没有调用 return $this->response()方法，也有可能服务端发生错误，并且服务端要继承YarServiceController
    </span>
    <div style="border: 1px solid #333366;padding: 5px;background: #eeeeff;">
        <pre><?php var_export($result) ?></pre>
        <pre><?php echo (isset($exception) && is_object($exception) ? $exception->getMessage() : null) ?></pre>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#api-form").submit(function(e) {
            var url = $.trim($(this).find('input[name=url]').val());
            var apiName = $.trim($(this).find('input[name=api_name]').val());
            if (!url || !apiName) {
                alert("请填写接口地址和接口名称");

                e.preventDefault();
            }
        });
    });
</script>
