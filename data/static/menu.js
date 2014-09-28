/**
 * 
 */
$(function(){
	//打开第一个菜单
	$("#aside_menu li:first").find('.handle_icon').addClass("minus_icon").removeClass("plus_icon");
	$("#aside_menu li:first").find(".show_menu").show();
	
	
	
	
    $("#aside_menu .nav_item").click(function(){
		if($(this).children('b').hasClass('plus_icon')){
			$(this).find('.handle_icon').addClass('minus_icon').removeClass('plus_icon');
			$(this).siblings(".show_menu").show();
		}else{
			$(this).find('.handle_icon').removeClass('minus_icon').addClass('plus_icon');
			$(this).siblings(".show_menu").hide();
		}
		jspan();
	})
	
	var head_menu_toogle = function(id){
    	$("#head_menu li").removeClass("curr");
    	if(id > 0){
	    	$("#head_menu_"+id).addClass("curr");
    	}
    }
    $(".show_menu li").hover(function(){
    	$(this).addClass("cur");
    },function(){
    	$(this).removeClass("cur");
    });
    
    var iframe_toogle = function(id){
    	$(".main_iframe").hide();
    	$("#iframe_"+id).show();
    }
	$('.show_menu a').click(function(){
		var menuid = $(this).attr('menuid');
		var head_menu_count = $("#head_menu li").length;
		var url = $(this).attr('url');
		var name = $(this).attr('title');
		var height = $('#wrap').height();
		if($('#head_menu_'+menuid).length == 0){
 			if(head_menu_count >=8){
				var lastMenuId= $("#head_menu li:last").attr("menuid");
				$("#iframe_"+lastMenuId).remove();
				$("#head_menu_"+lastMenuId).remove();
			}
 			height = height - 10;
			var head_menu_html = '<li class="curr" menuid="'+menuid+'" id="head_menu_'+menuid+'"><a href="javascript:void(0)" title="'+name+'">'+name+'<i class="menu_close"></i></a></li>';
			$('#head_menu').append(head_menu_html);
			var iframe_html = '<div class="main_iframe" menuid="'+menuid+'" id="iframe_'+menuid+'"><iframe width="100%"  height="'+height+'" src="'+url+'"></iframe></div>';
			$('.main').append(iframe_html);
		}
		if($('#head_menu_'+menuid).length == 1){
			$('#iframe_'+menuid).html('<iframe width="100%"  height="'+height+'" src="'+url+'"></iframe>');
		}
		
		iframe_toogle(menuid);
		head_menu_toogle(menuid);
	});
	$('#head_menu li').live("click",function(){
		var menuid = $(this).attr("menuid");
		iframe_toogle(menuid);
		head_menu_toogle(menuid);
	});
	$("#head_menu .menu_close").live('click',function(event){
		var menuid = $(this).parents("li").attr("menuid");
		if($("#showmenu_"+menuid).hasClass("cur")){
			$("#iframe_"+menuid).remove();
			$("#head_menu_"+menuid).remove();
			var lastMenuId = $("#head_menu li:last").attr("menuid");
			iframe_toogle(lastMenuId);
			head_menu_toogle(lastMenuId);
		}else{
			$("#iframe_"+menuid).remove();
			$("#head_menu_"+menuid).remove();
		}
		event.stopPropagation();
	});
	
	$(".retune").click(function(){
		var spani = $(this).find("i");
		$("#aside_wrap").toggleClass("hidden");
		if($(spani).hasClass("arr_right")){
			$(spani).removeClass("arr_right").addClass("arr_left");
		}else if ($(spani).hasClass("arr_left")){
			$(spani).removeClass("arr_left").addClass("arr_right");
		}
		
	});
})