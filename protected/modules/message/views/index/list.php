<h2 class="title-h4 bordBtm1">团购列表</h2>
   <div class="controlWrap">
    <?php 
    //配置按钮
    $this->widget('ListButtonWidget',array('buttons'=>array(
        array('添加','sms_add',$this->createUrl('add',array('id'=>1)),1),
        array('修改','sms_upd',$this->createUrl('add',array('id'=>1)),1),
    )));?>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="新增" type="button">新增</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="编辑" type="button">编辑</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="供应商管理" type="button">供应商管理</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="商品管理" type="button">商品管理</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="预览" type="button">预览</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="品牌管理" type="button">品牌管理</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="填报销售金额" type="button">填报销售金额</button></span></div>
    <div class="controlModule"><span class="btn-link btn-link4"><button hidefocus="true" class="button" title="新增推广链接" type="button">新增推广链接</button></span></div>
    <div class="searchModule">
     <input type="text" value="团购名称" class="inpt" id="">
     <span class="btn-link btn-link5">
     <button hidefocus="true" class="button" title="查询" type="button">查询</button>
     </span>
	     <a title="高级查询" id="seniorSearchBut" class="btn-fold" href="javascript:void(0);">高级查询</a>
     </div>
   </div>
 <?php include_once '_search.php';?>
 <div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
     <thead>
      <tr class="order-hd">
       <th width="2%">&nbsp;&nbsp;</th>
       <th width="2%">排序</th>
       <th width="2%">编号</th>
       <th width="10%">团购名称</th>
       <th width="5%">分站</th>
       <th width="10%">主题类型</th>
       <th width="4%">状态</th>
       <th width="15%">起始时间</th>
       <th width="20%">报名时间</th>
       <th width="4%">报名人数</th>
       <th width="4%">签到人数</th>
      </tr>
     </thead>
     <tbody>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
      <tr class="order-bd">
       <td class="txt-center"><input type="checkbox"></td>
       <td class="txt-center">100</td>
       <td class="txt-center">821</td>
       <td class="txt-center">倩的测试团购</td>
       <td class="txt-center">北京</td>
       <td class="txt-center">综合团购</td>
       <td class="txt-center">已上线</td>
       <td class="txt-center">2013-05-14至2013-06-08</td>
       <td class="txt-center">2013-05-14 15:23:21至2013-05-31 15:23:26</td>
       <td class="txt-center">34</td>
       <td class="txt-center">1</td>
      </tr>
     </tbody>
    </table>
   </div>
   <div class="ui-pagination2"><span class="totalNum">总计<i class="webtxt">30</i>个记录</span><span class="showNum"><span>每页显示</span>
    <select id="" name="">
     <option value="">30</option>
     <option value="">20</option>
     <option value="">10</option>
    </select>
    </span><a class="page-prev" href="#">上一页</a><a class="page-next" href="#">下一页</a><span class="page-skip"><span>跳转到</span>
    <input type="text" value="" class="inpt">
    <button title="确定" class="btn" type="button">确定</button>
    </span></div>
   <div class="noResult hidden"> <i class="ico-warning"></i><span class="noResult-tips">没有找到您要的结果哦！请重新设置查询条件！</span> </div>
  </div>