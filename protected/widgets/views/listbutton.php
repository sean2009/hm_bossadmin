<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
foreach($list as $val):
?>
<div class="controlModule">
    <span class="btn-link btn-link4">
        <button hidefocus="true" class="button" title="<?php echo $val['name']?>" url="<?php echo $val['url']?>" button_type="<?php echo $val['type']?>" button_func="<?php echo $val['func']?>" type="button" <?php foreach($val['options'] as $k => $v){echo "$k=\"$v\"";}?>><?php echo $val['name']?></button>
    </span>
</div>
<?php endforeach;?>
<script>
$(function(){
    $('.btn-link4 button').click(function(){
        var url = $(this).attr('url');
        var button_type = $(this).attr('button_type');
        var button_func = $(this).attr('button_func');
        var ids = [];
        if(button_type == 'no'){
            
        }else{
            sel_count = $("input[type='checkbox'][name='sel_ids[]']:checked").length;
            if(sel_count <= 0){
                showMessage('未选中任何选项！');
                return false;
            }
            if(button_type != 0){
                if(sel_count > button_type){
                    alert('本操作只能选择'+button_type+'项');
                    return false;
                }
            }
            
            $("input[type='checkbox'][name='sel_ids[]']:checked").each(function(i){
                ids[i] = $(this).val();
            });
            url = url + '?ids=' + ids.join(',');
        }
        if(button_func != ''){
            var button_func = $(this).attr('button_func');
            eval(button_func)($(this),ids.join(','));
            return true;
        }
        location.href=url;
        return true;
    });
});
</script>
