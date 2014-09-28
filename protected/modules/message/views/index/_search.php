<div class="seniorSearch hidden">
   <label class="name" for="">编号：</label>
    <input type="text" value="" class="inpt" id="">
   <label class="name" for="">名称：</label>
    <input type="text" value="" class="inpt" id="">
   <label class="name" for="">分站：</label>
    <select class="inpt"><option>请选择...</option></select>
    <label class="name" for="">商场：</label>
    <select class="inpt"><option>请选择...</option></select><br/>
    <label class="name" for="">团购类型：</label>
    <select class="inpt"><option>请选择...</option></select>
    <label class="name" for="">状态：</label>
    <select class="inpt"><option>请选择...</option></select>
    <label class="name" for="">团购开始时间</label>
    <input type="text" value="" class="inpt" id="">&nbsp;至&nbsp;<input type="text" value="" class="inpt" id="">
    <span class="btn-link btn-link5">
    <button hidefocus="true" class="button" title="查询" type="button">查询</button>
    </span><span class="btn-link btn-link6">
    <button hidefocus="true" class="button" title="重置" type="button">重置</button>
    </span></div>
    <script language="javascript">
    	$("#seniorSearchBut").click(function(){
			$(".seniorSearch").toggleClass("hidden");
			$(this).toggleClass("btn-unfold");
         });
    </script>