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
    <li class="current"><a href="">位点列表</a></li>
    <li><a href="<?php echo U('kit/batch_locus');?>">批量添加位点</a></li>
</ul>
</div>
<div class="margin10px searchbox">
  <form action="<?php echo U('kit/locus_list');?>" method="get">
    试剂盒：<select name="kit_id">
      <option value="">--请选择--</option>
      <?php if(is_array($kit["kit_select"])): $i = 0; $__LIST__ = $kit["kit_select"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kit): $mod = ($i % 2 );++$i;?><option value="<?php echo ($kit['kit_id']); ?>" <?php if($kit['kit_id'] == $params['kit_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($kit['kit_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>&nbsp;
    位点名称：<input type="text" name="locus_name" class="search-input" value="<?php echo ($params['locus_name']); ?>" placeholder="请输入位点名称">
    <input type="submit" name="so" class="button" value="搜索" />
  </form>
</div>
<div class="margin10px">
  <table class="mytable">
    <thead>
      <tr>
        <th>位点ID</th>
        <th>试剂盒名称</th>
        <th>位点名称</th>
        <th>状态</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($val['locus_id']); ?></td>
            <td><?php echo ($val['kit_name']); ?></td>
            <td><?php echo ($val['locus_name']); ?></td>
            <td><?php echo ($val['status_name']); ?></td>
            <td>
            	<a title="编辑" class="btn" href="<?php echo U('kit/edit_locus', array('locus_id' => $val['locus_id']));?>">编辑</a>
            	<a title="删除" class="btn del" url="<?php echo U('kit/ajax_delete_locus');?>" del_id="<?php echo ($val["locus_id"]); ?>">删除</a>
            </td>
	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php else: ?>
	<td colspan="4" class="text-center">没有相关内容! </td><?php endif; ?>
    </tbody>
  </table>
  <div style="height:10px;">&nbsp;</div>
  
  <div class="pagenum"><?php echo ($pager); ?></div>
  
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