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
	<li class="current"><a>分组列表 </a> </li> 
	<li><a href="<?php echo U('admin/group_add');?>">添加分组 </a> </li>
</ul>
</div>

<div class="margin10px">
	<table class="mytable">
		<tr>
			<th width="40">ID</th>
			<th>分组名称</th>
			<th width="100">状态</th>
			<th width="160">操作</th>
		</tr>
	    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
			<td class="tdf"><?php echo ($v['group_id']); ?></td>
			<td <?php if($v['group_pid'] == 0 ): ?>class="bgc_eaf7fe"<?php endif; ?> > <?php echo str_repeat('&nbsp;', 9*(intval($v['group_depth']))).$v['group_name'];?>  </td>
			<td><span class="cursorpointer" onclick="groupStatus(<?php echo ($v['group_id']); ?>, <?php if($v['st'] == 1): ?>0 <?php else: ?> 1<?php endif; ?> )">
			<?php if($v['st'] == 1): ?><font color="green">正常</font><?php else: ?>  <font color="red">禁用</font><?php endif; ?></span></td>
			<td>
            	<a href="<?php echo U('admin/group_del', array('group_id'=>$v['group_id']));?>" class="btn" onclick="javascript:return confirm('提示：您确定要删除吗？')">删除</a> /
                <a href="<?php echo U('admin/group_edit', array('group_id'=>$v['group_id']));?>" class="btn">修改</a>
            </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		<tr>
			<td colspan="4">没有数据</td>
		</tr><?php endif; ?>
	</table>
</div>
<script type="text/javascript">
function groupStatus(group_id, st){
	$.ajax({
		url:'<?php echo U('ajax_group_st');?>',
		data:({'group_id':group_id, 'st':st}),
		type:'post',
		success:function(msg){
			if(msg == 'ok'){
				alert('操作成功');
				location.reload();
			}else{
				alert(msg);
			}
		},
		error:function(){
			alert('网络繁忙，请稍后重试');
		}
	})
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