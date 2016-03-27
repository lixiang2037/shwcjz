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
    <li class="current"><a>套餐列表</a></li>
    <li ><a href="<?php echo U('/goods/add');?>" >添加套餐</a></li>
</ul>
</div>


<div class="margin10px searchbox">
    <form action="<?php echo U('/goods/index');?>" method="get">
        套餐名：  <input type="text" name="goods_name" class="search-input" value="<?php echo ($params['goods_name']); ?>" placeholder="请输入套餐名">
        &nbsp;&nbsp;&nbsp;<input type="submit" name="so" class="button" value="搜索" />
    </form>
</div>
<div class="margin10px">
	<table class="mytable">
			<thead>
				<tr>
					<th width="180">ID</th>
					<th>套餐名</th>
					<th>图标</th>
					<th>价格</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($info['goods_id']); ?></td>
							<td><?php echo ($info['goods_name']); ?></td>
							<td><img src="<?php echo ($info['goods_img']); ?>" height="45px" alt="<?php echo ($info['goods_img']); ?>"  border=0 /></td>
							<td><?php echo ($info['goods_price']); ?></td>
							<td><span class="cursorpointer" onclick="changestatus(<?php echo ($info['goods_id']); ?>)"><font color="<?php echo ($info['status']==1?'green':'red'); ?>"><?php echo ($info['status_name']); ?></font></span></td>
							<td>
								<a title="编辑" class="btn" href="<?php echo U('goods/edit', array('goods_id' => $info['goods_id']));?>">编辑</a>
								<!--  <a class="del ajax-get btn" title="删除" url="<?php echo U('goods/ajax_delete_goods');?>" del_id="<?php echo ($info['goods_id']); ?>">删除</a> -->
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<td colspan="5" class="text-center"> 暂时还没有内容! </td><?php endif; ?>
			</tbody>
		</table>
    <div style="height:10px;">&nbsp;</div>
    <div class="pagenum"> <?php echo ($page); ?> </div>
</div>


<script type="text/javascript">

function changestatus(id){
	if(!confirm("确定修改该套餐状态吗?")) return false;
	var url="<?php echo U('goods/ajax_change_status');?>";
	$.ajax({
		type    : 'POST',
		url     : url,
		data    : 'id='+ id,
		dataType: 'JSON',
		success: function(data) {
		    if (data.success==0) {
			 alert(data.message);
		    } else {	            	
			window.location.reload();  
		    }
		 }
	});
}
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