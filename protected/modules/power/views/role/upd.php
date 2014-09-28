<h2 class="title-h4 bordBtm1">修改角色</h2>
<div class="controlWrap">
    <?php
    //配置按钮
    $this->widget('ListButtonWidget', array('buttons' => array(
            array('返回列表', 'power_role_index', $this->createUrl('index'), 'no'),
    )));
    ?>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model,"menuTree"=>$menuTree));?>