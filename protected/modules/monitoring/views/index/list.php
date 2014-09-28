<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
    <?php foreach($list as $v):?>
    <tr class="order-bd">
        <td width="130" style="padding-left: 10px;"><?php echo $v->starttime;?></td>
        <td width="130" style="padding-left: 10px;"><?php echo $v->service_ip;?></td>
        <td width="80" style="padding-left: 10px;">
            <a href="<?php echo $this->createUrl('list',array('type'=>$v->type,'type2'=>$v->type2,'type3'=>$v->type3));?>"><?php echo $v->type;?></a>
        </td>
        <td width="50" style="padding-left: 10px;"><?php echo $v->type2;?></td>
        <td width="50" style="padding-left: 10px;"><?php echo $v->type3;?></td>
        <!--<td style="padding-left: 10px;"></td>-->
        <td width="120" style="padding-left: 10px;"><?php echo $v->mstime;?></td>
        <td style="padding-left: 10px;"><?php echo $v->url;?><?php echo $v->content;?></td>
    </tr>
    <?php endforeach; ?>
</table>