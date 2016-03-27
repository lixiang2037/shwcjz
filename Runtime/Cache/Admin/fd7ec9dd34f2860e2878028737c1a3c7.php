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
    <li><a href="<?php echo U('order/index');?>">订单列表 </a></li>
    <li class="current"><a href="">详情 </a></li>
    </ul>
</div>
<div class="margin10px">
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
            	<td width="100" class="tdf">套餐名：</td>
				<td> 
				    <?php echo ($info['goods_name']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">下单时间：</td>
				<td> 
				    <?php echo ($info['add_ts']); ?>
                </td>
            </tr>

			<tr>
                <td width="100" class="tdf">检测数量(个)：</td>
				<td> 
				    <?php echo ($info['goods_num']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">总价格(元)：</td>
				<td> 
				    <?php echo ($info['total_price']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">支付状态：</td>
				<td> 
				    <?php echo ($info['pay_status_name']); ?>
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
            
            <?php if(!empty($info["samples"])): ?><tr>
                <th colspan="2">样品信息</th>
            	</tr>
            	
            	<tr>
            		<td width="100" class="tdf"></td>
            		<td>
            			<table width="70%">
            				<tr><td>样品Id</td><td>样品编号</td><td>被检测人</td><td>状态</td><td>时间</td></tr>
            				<?php if(is_array($info["samples"])): $i = 0; $__LIST__ = $info["samples"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sam): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($sam['sample_id']); ?></td><td><?php echo ($sam['sample_sn']); ?></td><td><?php echo ($sam['person_name']); ?></td><td><?php echo ($sam['status_name']); ?></td><td><?php echo ($sam['add_ts']); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
            			</table>
            		</td>
            	</tr><?php endif; ?>
            
            <?php if(!empty($info["logs"])): ?><tr>
	                <th colspan="2">操作日志</th>
	            </tr>
           	 <?php if(is_array($info["logs"])): $k = 0; $__LIST__ = $info["logs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($k % 2 );++$k;?><tr>
                <td width="100" class="tdf"></td>
				<td> 
				    [<?php echo ($log['op_ts']); ?>]--<?php echo ($log['admin_name']); echo ($log['op_type_name']); ?>
                </td>
           		</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
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