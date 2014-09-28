<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/statics/plugins/zTree/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/statics/js/jquery.formsubmit.js"></script>
<SCRIPT type="text/javascript" >
  <!--
	var zTree;
	var demoIframe;

	var setting = {
		view: {
			dblClickExpand: false,
			showLine: true,
			selectedMulti: false
		},
		data: {
			simpleData: {
				enable:true,
				idKey: "id",
				pIdKey: "pId",
				rootPId: "sign"
			}
		},
		callback: {
			beforeClick: function(treeId, treeNode) {
				//demoIframe.attr("src",treeNode.file);
                                $.get('<?php echo $this->createUrl('upd');?>',{id:treeNode.id},function(data){
                                    $('#tree_right').html(data);
                                });
				return true;
			}
		}
	};

	var zNodes =[
            <?php echo $menuTree;?>
	];
        
        function updateNode(name) {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
            nodes = zTree.getSelectedNodes();
            if (nodes.length == 0) {
                    alert("请先选择一个节点");
            }
            for (var i=0, l=nodes.length; i<l; i++) {
                zTree.setting.view.fontCss = {};
                nodes[i].name = name;
                zTree.updateNode(nodes[i]);
            }
        }
        
        function refreshNode(e) {
                var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
                type = e.data.type,
                silent = e.data.silent,
                nodes = zTree.getSelectedNodes();
                if (nodes.length == 0) {
                        alert("请先选择一个父节点");
                }
                for (var i=0, l=nodes.length; i<l; i++) {
                        zTree.reAsyncChildNodes(nodes[i], type, silent);
                        if (!silent) zTree.selectNode(nodes[i]);
                }
        }

	$(document).ready(function(){
		var t = $("#treeDemo");
		t = $.fn.zTree.init(t, setting, zNodes);
		demoIframe = $("#testIframe");
		demoIframe.bind("load", loadReady);
		var zTree = $.fn.zTree.getZTreeObj("treeDemo");
		zTree.selectNode(zTree.getNodeByParam("id", 101));
	});

	function loadReady() {
		var bodyH = demoIframe.contents().find("body").get(0).scrollHeight,
		htmlH = demoIframe.contents().find("html").get(0).scrollHeight,
		maxH = Math.max(bodyH, htmlH), minH = Math.min(bodyH, htmlH),
		h = demoIframe.height() >= maxH ? minH:maxH ;
		if (h < 530) h = 530;
		demoIframe.height(h);
	}
        
        var saveForm = function(form_id,parent_id){
            var options = {
                success: function(responseText) {
                    e = {
                        data:{type:"refresh", silent:false}
                    };
                    refreshNode(e);
                    updateNode('sdfsfsf');
                    showMessage(responseText);
                }
            };
            $('#'+form_id).ajaxSubmit(options);
        }
        
        var delForm = function(id,parent_id){
            if(confirm('确定删除吗？')){
                $.get('<?php echo $this->createUrl('del');?>',{id:id},function(data){
                    if(data == 'success'){
                        showMessage('删除成功！');
                    }else{
                        alert(data);
                    }
                });
            }
        }
  //-->
  </SCRIPT>
  <TABLE border=0 height=600px align=left>
	<TR>
		<TD width=260px align=left valign=top style="BORDER-RIGHT: #999999 1px dashed">
			<ul id="treeDemo" class="ztree" style="width:260px; overflow:auto;"></ul>
		</TD>
                <TD width=770px align=left valign=top id="tree_right"></TD>
	</TR>
</TABLE>