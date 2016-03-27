<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>美吉生信管理系统</title>
<link href="/style/admin/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">body{ overflow:visible; background:#fff;}</style>
<script type="text/javascript" src="/javascript/admin/jquery-1.7.2.js"></script>
<script type="text/javascript" src="/javascript/admin/admin.js"></script>
<script type="text/javascript" src="/javascript/admin/mybox.js"></script>
</head>
<body>
<div class="main_title">
	<ul class="type_list clear">
    <li><a href="<?php echo U('order/confirmed');?>">待采样订单 </a></li>
    <li class="current"><a href="">寄送采样器 </a></li>
    </ul>
</div>
<style>
.express_list li{float:left;margin:5px 5px 0 0;}
.express_list li a{display:block;border:1px dashed #ccc;width:148px;height:48px;}
.express_list li a:hover{border-color:#333;}
</style>
<div class="margin10px">
    <form name="form1" method="post" action="<?php echo U('order/send');?>" onsubmit="return checkForm();">
        <table class="mytable">
            <tr>
                <th colspan="2">订单信息</th>
            </tr>
            
            <tr>
            	<td width="100" class="tdf">订单号</td>
            	<td> 
            		<?php echo ($info['order_sn']); ?>
            	</td>
            </tr>
            <tr>
                <td width="100" class="tdf">下单人：</td>
				<td> 
				    <?php echo ($info['user_name']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">下单时间：</td>
				<td> 
				    <?php echo ($info['add_ts']); ?>
                </td>
            </tr>
			<tr>
                <td width="100" class="tdf">订单状态：</td>
				<td> 
				    <?php echo ($info['order_status_name']); ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">联系人信息</th>
            </tr>
            <tr>
                <td width="100" class="tdf">联系人：</td>
				<td> 
				    <?php echo ($info['contact_name']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">联系电话：</td>
				<td> 
				    <?php echo ($info['tel']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">手机号码：</td>
				<td> 
				    <?php echo ($info['phone']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">采样地址：</td>
				<td> 
				    <?php echo ($info['address_info']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">选择：</td>
				<td> 
				   <ul class="express_list clear">
                                <?php if(is_array($search_option["logistic_icon"])): $i = 0; $__LIST__ = $search_option["logistic_icon"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li name="<?php echo ($val["name"]); ?>"><a href="javascript:void(0);"><img src="<?php echo ($val["img"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
                </td>
            </tr>
			<tr>
                <td width="100" class="tdf">快递公司：</td>
				<td> 
				    <input type="text" id="logistics_name" name="logistics_name" size="40"  /><span></span>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">快递单号：</td>
				<td> 
				    <input type="text" id="logistics_sn" name="logistics_sn" size="40" /><span></span>
                </td>
            </tr>
            <tr>
                <th colspan="2">样品信息</th>
            </tr>
            <tr>
                <td width="100" class="tdf">检测数量(个)：</td>
				<td> 
				    <?php echo ($info['goods_num']); ?>
                </td>
            </tr>
            <?php $__FOR_START_665__=0;$__FOR_END_665__=$info['goods_num'];for($i=$__FOR_START_665__;$i < $__FOR_END_665__;$i+=1){ ?><tr>
	                <td width="100" class="tdf"><?php if($i == 0): ?>样品编号：<?php endif; ?></td>
					<td> 
						<input type="hidden" name="sample_id_<?php echo ($i); ?>" value="<?php echo ($samples[$i]['sample_id']); ?>" /><input type="text" id="sample_sn_<?php echo ($i); ?>" name="sample_sn_<?php echo ($i); ?>" size="40" />(<?php echo ($samples[$i]['person_name']); ?>)<span></span>
	                </td>
	            </tr><?php } ?>           
           	<input type="hidden" name="order_id" value="<?php echo ($info['order_id']); ?>" />
           	<input type="hidden" name="goods_num" value="<?php echo ($info['goods_num']); ?>" />
           	<input type="hidden" name="order_sn" value="<?php echo ($info['order_sn']); ?>">
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="submit" name="formsubmit" value="确定" class="button" />
                    <span style="color:red;"><提示：确定寄送样品后，可打印样品检测单据信息></span>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>

<script>
    $(".del").click(function(){

        if (!confirm("确认删除吗?")) {
            return false;
        }
        var url    = $(this).attr("url");
        var del_id = $(this).attr("del_id");
        
        $.ajax({
        type    : 'POST',
        url     : url,
        data    : 'id='+ del_id,
        dataType: 'JSON',
        success: function(data) {
            if (data.success == '0') {
                alert(data.message);
            } else {
                window.location.reload();
            }
            }
        });
    });
</script>

<script type="text/javascript">

$(function(){

    $(".express_list li").click(function(){
        $(this).find('a').css('border-color', '#ff0000');
        $(this).siblings().find('a').css('border-color', '#ccc');
        $("#logistics_name").val($(this).attr('name'));
    });
})

function checkForm(){
	var goods_num_ = <?php echo ($info['goods_num']); ?>;
	var logistics_name_ = $('#logistics_name').val();
	var logistics_sn_  = $('#logistics_sn').val();

	if (logistics_name_ == '') {
        $('#logistics_name').css('background-color','#ffc');
        $('#logistics_name').next('span').html('<font color=red>请填写快递公司</font>');
        $('#logistics_name').focus();
        return false;
    }

	if (logistics_sn_ == '') {
        $('#logistics_sn').css('background-color','#ffc');
        $('#logistics_sn').next('span').html('<font color=red>请填写快递单号</font>');
        $('#logistics_sn').focus();
        return false;
    }

	for(var i=0; i<goods_num_; i++){
        var sample_sn_ = $('#sample_sn_'+i).val();
        if(sample_sn_ == ''){
        	$('#sample_sn_'+i).css('background-color','#ffc');
        	$('#sample_sn_'+i).next('span').html('<font color=red>请填写样品编号</font>');
        	$('#sample_sn_'+i).focus();
            return false;
        }
    }
        
    return true;
}

</script>