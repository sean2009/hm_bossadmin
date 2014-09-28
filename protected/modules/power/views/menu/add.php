<form method="post" id='form_add' action="<?php echo $this->createUrl('add'); ?>">
    上级：<?php echo $parent_name;?><br>
    菜单类型：
    <input type="radio" class="form_menu_type" name="Data[menu_type]" value="0" checked="checked">菜单
    <input type="radio" class="form_menu_type" name="Data[menu_type]" value="1">按钮
    <input type="radio" class="form_menu_type" name="Data[menu_type]" value="2">隐藏列
    <br>
    菜单地址类型：
    <input type="radio" class="form_menu_type" name="Data[url_type]" value="0" checked="checked">默认
    <input type="radio" class="form_menu_type" name="Data[url_type]" value="1">团购
    <input type="radio" class="form_menu_type" name="Data[url_type]" value="2">商城
    <br>
    名称：<input type="text" name="Data[name]" class="inpt_name" value=''>*<br>
    <span id='form_url'>链接：<input type="text" name="Data[url]" value=''><br></span>
    标识：<input type="text" name="Data[sign]" value=''><br>
    排序：<input type="text" name="Data[sort]" value='0'><br>
    <input type="hidden" name="Data[parent_id]" value="<?php echo $parent_id;?>"><br>
    <input type="button" value="添加下级菜单" onclick="javascript:saveForm('form_add',<?php echo $parent_id;?>);">
</form>