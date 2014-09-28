<div id="error_l" class="<?php if($code===505){ echo 'error';}else if($code===506){echo 'warning';}else if($code===507){echo 'success';} ?>"> 
</div>
<div class="error_msg"><?php echo CHtml::encode($message); ?></div>
<a class="img_btn_normal four_words" href="<?php echo Yii::app()->request->urlReferrer;?>">← 返回</a>