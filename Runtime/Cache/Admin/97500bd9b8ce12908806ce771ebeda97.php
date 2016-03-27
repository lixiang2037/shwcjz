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
    <li class="current"><a>待采样订单</a></li>
</ul>
</div>


<div class="margin10px searchbox">
    <form action="<?php echo U('/order/confirmed');?>" method="get">
        订单编号：<input type="text" id="order_sn" name="order_sn" class="search-input" value="<?php echo ($params['order_sn']); ?>" placeholder="请输入订单编号">
        &nbsp;&nbsp;&nbsp;<input type="submit" name="so" class="button" value="搜索" />
    </form>
</div>
<div class="margin10px">
	<table class="mytable">
			<thead>
				<tr>
					<th width="180">ID</th>
					<th>订单编号</th>
					<th>检测数量</th>
					<th>总价格</th>
					<th>支付状态</th>
					<th>订单状态</th>
					<th>采样地址</th>
					<th>下单时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($info['order_id']); ?></td>
							<td><?php echo ($info['order_sn']); ?></td>
							<td><?php echo ($info['goods_num']); ?></td>
							<td><?php echo ($info['total_price']); ?></td>
							<td><?php echo ($info['pay_status_name']); ?></td>
							<td><?php echo ($info['order_status_name']); ?></td>
							<td><?php echo ($info['address_info']); ?></td>
							<td><?php echo ($info['add_ts']); ?></td>
							<td>
								<a title="详情" class="btn" href="<?php echo U('order/view',array('order_id'=>$info['order_id']));?>"  >详情</a>
								<a title="寄送采样器" class="btn" href="<?php echo U('order/send',array('order_id'=>$info['order_id']));?>" >寄送采样器</a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<td colspan="9" class="text-center"> 暂时还没有内容! </td><?php endif; ?>
			</tbody>
		</table>
    <div style="height:10px;">&nbsp;</div>
    <div class="pagenum"> <?php echo ($page); ?> </div>
</div>


<script type="text/javascript">
</script>
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