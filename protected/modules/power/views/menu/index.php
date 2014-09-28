<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/statics/js/jquery.formsubmit.js"></script>
<style>
    .tree_next{padding-left: 25px;}
    .tree_check{cursor:pointer}
    .tree_title{cursor:pointer}
    .tree_li_o{position:relative;}
    .tree_type0{color: #000}
    .tree_type1{color:#0078ae}
    .tree_type2{color:#009}
</style>
<script>
    var getTreeRightAdd = function(parent_id,level){
            $.get('<?php echo $this->createUrl('add');?>',{parent_id:parent_id,level:level},function(data){
                $('#edit').html(data);
                $( "#edit" ).dialog({
                    title:'添加跟菜单',
                    width:600,
                    buttons: { 
                        "取消": function() { 
                                $(this).dialog("close"); 
                        }
                    }
                });
            });
        }
        
        var getTreeRightUpd = function(type,parent_id){
            $.get('<?php echo $this->createUrl('upd');?>',{id:parent_id},function(data){
                $('#edit').html(data);
                $( "#edit" ).dialog({
                    title:'修改或添加下级菜单',
                    width:600,
                    buttons: { 
                        "取消": function() { 
                                $(this).dialog("close"); 
                        }
                    }
                });
            });
        };
        
        var getTreeNext = function(obj_p_this,is_refesh){
            var parent_id = obj_p_this.attr('parent_id');
            var obj_tree_chec = obj_p_this.find('.tree_check:first');
            var text = obj_tree_chec.text();
            $('#tree_next_'+parent_id).empty();
            if(!is_refesh && text == '[-]'){
                obj_tree_chec.text('[+]');
                return;
            }
            $.getJSON('<?php echo $this->createUrl('get');?>',{parent_id:parent_id},function(data){
                $.each(data,function(i,v){
                    $('#tree_next_'+parent_id).append('<li class="tree_li_o" parent_id="'+v.id+'" id="tree_li_o_'+v.id+'"><span class="tree_check">[+]</span><a class="tree_title tree_type'+v.menu_type+'">'+v.name+ ' '+ v.sign +  '</a><ul class="tree_next" id="tree_next_'+v.id+'"></ul></li>');
//                    getTreeNext($('#tree_li_o_'+v.id));
                });
            });
            obj_tree_chec.text('[-]');
        };
        
        
        var saveForm = function(form_id,parent_id){
            var options = {
                success: function(responseText) {
                    if(responseText == 'success'){
                        getTreeNext($('#tree_li_o_'+parent_id),1);
                        $( "#edit" ).dialog("close");
                    }else{
                        showMessage(responseText);
                    }
                }
            };
            $('#'+form_id).ajaxSubmit(options);
        }
        
        var delForm = function(id,parent_id){
            if(confirm('确定删除吗？')){
                $.get('<?php echo $this->createUrl('del');?>',{id:id},function(data){
                    if(data == 'success'){
                        getTreeNext($('#tree_li_o_'+parent_id));
                        showMessage('删除成功！');
                    }else{
                        alert(data);
                    }
                });
            }
        }

</script>
<div id="edit" style="display:none"></div>
<h2 class="title-h4 bordBtm1">菜单管理</h2>
<div class="controlWrap">
    <a onclick="javascript:getTreeRightAdd(0,1);">添加跟菜单</a>
</div>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <tbody>
            <tr class="order-bd">
                <td style=" padding-left: 10px; width: 500px;" align="left" valign="top">
                    <div style="position:relative;padding-top:10px;">
                        <ul class="tree_next" id='tree_next_0'>
                    <?php foreach ($list as $val): ?>
                        <li class="tree_li_o" id="tree_li_o_<?php echo $val->id; ?>" parent_id="<?php echo $val->id; ?>">
                            <span class="tree_check">[+]</span> 
                            <a class="tree_title tree_type0"><?php echo $val->name; ?> <?php echo $val->sign; ?></a>
                            <ul class="tree_next" id='tree_next_<?php echo $val->id; ?>'></ul>
                        </li>
                    <?php endforeach; ?>
                        </ul>
                    </div>
                </td>
                <td id="tree_right" valign="top">
                    
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>

<script>
    $(function() {
//        $('.tree_li_o').each(function(){
//            getTreeNext($(this));
//        });
        
        $('.tree_check').live('click',function(){
            var obj_p_this = $(this).parent();
            getTreeNext(obj_p_this);
        });
        
        $('.tree_title').live('click',function(){
            var parent_id = $(this).parent().attr('parent_id');
            getTreeRightUpd('upd',parent_id);
        });
        
        $('.form_menu_type').live('click',function(){
            if($(this).val() == '2'){
                $('#form_url').hide();
            }else{
                $('#form_url').show();
            }
        });
    });
</script>