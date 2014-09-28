<table style="margin: 10px;" height="200" valign="top" border="0">
    <tr>
        <td width="250" style="padding: 10px;BORDER-RIGHT: #999999 1px dashed">
            <form method="post" id="form_upd" action="<?php echo $this->createUrl('upd', array('id' => $row->id)); ?>">
                菜单类型：
                <?php foreach($menu_type_array as $k => $v):?>
                <input type="radio" class="form_menu_type" name="Data[menu_type]" value="<?php echo $k;?>" <?php if($k == $row->menu_type):?>checked="checked"<?php endif;?>><?php echo $v;?>
                    <?php endforeach;?>
                <br>
                菜单地址类型：
                    <?php foreach($url_type_array as $k => $v):?>
                <input type="radio" class="form_url_type" name="Data[url_type]" value="<?php echo $k;?>" <?php if($k == $row->url_type):?>checked="checked"<?php endif;?>><?php echo $v;?>
                    <?php endforeach;?>
                <br>
                名称：<input type="text" name="Data[name]" class="inpt_name" value='<?php echo $row->name; ?>'>*<br>
                <?php if ($row->menu_type != 2): ?>
                    链接：<input type="text" name="Data[url]" value='<?php echo $row->url; ?>'><br>
                <?php endif; ?>
                    标识：<input type="text" name="Data[sign]" class="inpt_sign" value='<?php echo $row->sign; ?>'><br>
                    排序：<input type="text" name="Data[sort]" value='<?php echo $row->sort; ?>'><br>
                    <br>
                <input type="button" value="保存更新" id='form_button' onclick="javascript:saveForm('form_upd',<?php echo $row->parent_id; ?>);">
                <input type="button" value="删除当前" onclick="javascript:delForm(<?php echo $row->id; ?>,<?php echo $row->parent_id; ?>);">
            </form>
        </td>
        <td width="250" style="padding: 10px;">
            <?php echo $this->renderPartial('add', array('parent_id' => $parent_id, 'parent_name' => $parent_name)); ?>
        </td>
    </tr>
</table>

