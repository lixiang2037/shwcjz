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
	<li class="current"><a>节点列表</a> </li>
	<li><a href="<?php echo U('node/add');?>">添加节点</a> </li>
</ul>	
</div>

<div class="margin10px">
    <table class="mytable">
        <tr>
            <th width="40">ID</th>
            <th width="150">排序</th>
            <th>节点名称</th>
            <th>节点地址</th>
            <th width="100">显示级别</th>
            <th width="80">状态</th>
            <th width="300">操作</th>
        </tr>
		
	    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr <?php if($v['node_pid'] == 0): ?>class="bglightyellow"<?php endif; ?> >
            <td class="tdf"><?php echo ($v['node_id']); ?></td>
            <td><?php echo ($v['px']); ?></td>
            <td><strong><?php echo ($v['node_name']); ?></strong></td>
            <td><strong><?php echo ($v['m_c_a']); ?></strong></td>
            <td <?php if(($v['node_level'] == 1) OR ($v['node_level'] == 2) ): ?>class="bglightgreen"<?php endif; ?> >
			<?php if(($v['node_level'] == 1)): ?>顶部菜单<?php elseif($v['node_level'] == 2): ?>左边一级菜单<?php elseif($v['node_level'] == 3): ?>左边二级子单<?php else: ?> 隐藏式菜单<?php endif; ?></td>
            <td align="center"><span class="cursorpointer" onclick="nodeStatus(<?php echo ($v['node_id']); ?>,<?php if($v['st'] == 1): ?>0 <?php else: ?> 1<?php endif; ?> )">
			<?php if($v['st'] == 1): ?><font color="green">正常</font><?php else: ?>  <font color="red">禁用</font><?php endif; ?></span>
			</td>
            <td>
                <a href="<?php echo U('node/add', array('node_pid'=>$v['node_id']));?>" class="btn">添加子菜单</a> /
                <?php if($v['node_pid'] == 0): ?><a href="<?php echo U('node/index', array('node_pid'=>$v['node_id']));?>" class="btn" >管理子菜单</a><?php endif; ?>
                <a href="<?php echo U('node/del', array('node_id'=>$v['node_id']));?>" onclick="javascript:return confirm('提示：您确定要删除吗？')" class="btn" >删除</a> /
                <a href="<?php echo U('node/edit', array('node_id'=>$v['node_id']));?>" class="btn">修改</a>
            </td>
        </tr>
        <!--Begin::左边二级菜单、隐藏菜单-->
        
		<?php if(is_array($v['_sub'])): $i = 0; $__LIST__ = $v['_sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr>
                <td class="tdf"><?php echo ($vv['node_id']); ?></td>
                <td style="padding-left:30px;"><?php echo ($vv['px']); ?></td>
                <td style="padding-left:30px;"><?php echo ($vv['node_name']); ?></td>
                <td style="padding-left:30px;"><?php echo ($vv['m_c_a']); ?></td>
                <td <?php if(($vv['node_level'] == 1) OR ($vv['node_level'] == 2) ): ?>class="bglightgreen"<?php endif; ?> >
			<?php if(($vv['node_level'] == 1)): ?>顶部菜单 <?php elseif($vv['node_level'] == 2): ?>左边一级菜单<?php elseif($vv['node_level'] == 3): ?>左边二级子单<?php else: ?> 隐藏式菜单<?php endif; ?></td>
                <td align="center"><span class="cursorpointer" onclick="nodeStatus(<?php echo ($vv['node_id']); ?>,<?php if($vv['st'] == 1): ?>0 <?php else: ?> 1<?php endif; ?> )">
			<?php if($vv['st'] == 1): ?><font color="green">正常</font><?php else: ?>  <font color="red">禁用</font><?php endif; ?></span>
			</td>
                <td>
                    <a href="<?php echo U('node/del', array('node_id'=>$vv['node_id']));?>" onclick="javascript:return confirm('提示：您确定要删除吗？')" class="btn">删除</a> /
                    <a href="<?php echo U('node/edit', array('node_id'=>$vv['node_id'], 'third'=>'y'));?>" class="btn">修改</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--End::左边二级菜单、隐藏菜单--><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
        <tr>
            <td colspan="8">没有数据</td>
        </tr><?php endif; ?>
    </table>
</div>
<script type="text/javascript">
    function nodeStatus(node_id, st){
        $.ajax({
            url:'<?php echo U('node/ajax_node_st');?>',
            data:({'node_id':node_id, 'st':st}),
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