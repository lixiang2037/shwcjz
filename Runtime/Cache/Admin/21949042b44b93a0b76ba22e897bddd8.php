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
<script type="text/javascript" src="/javascript/My97DatePicker/WdatePicker.js"></script>
<div class="main_title">
<ul class="type_list clear">
    <li class="current"><a>基因库列表</a></li>
</ul>
</div>


<div class="margin10px searchbox">
    <form action="<?php echo U('/gene/index');?>" method="get">
    	检测人：<input type="text" placeholder="请输入检测人姓名" name="person_name" value="<?php echo ($params['person_name']); ?>">&nbsp;
    	试剂盒：<select name="kit_id">
    		<option value="">--请选择--</option>
    		<?php if(is_array($search_option["kit_select"])): $i = 0; $__LIST__ = $search_option["kit_select"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kit): $mod = ($i % 2 );++$i;?><option value="<?php echo ($kit['kit_id']); ?>" <?php if($kit['kit_id'] == $params['kit_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($kit['kit_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    	</select>
    	是否匿名：<select name="is_public">
    		<option value="">--请选择--</option>
    		<?php if(is_array($search_option["yes_no"])): $i = 0; $__LIST__ = $search_option["yes_no"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>" <?php if($data['id'] == $params['is_public']): ?>selected="selected"<?php endif; ?> ><?php echo ($data['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    	</select>&nbsp;
        是否被检索：<select name="is_search">
		    <option value="">--请选择--</option>
		    <?php if(is_array($search_option["yes_no"])): $i = 0; $__LIST__ = $search_option["yes_no"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>" <?php if($data['id'] == $params['is_search']): ?>selected="selected"<?php endif; ?> ><?php echo ($data['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		    </select>&nbsp;
    	时间范围：<input type="text" id="add_ts" name="add_ts" class="date_section"  value="<?php echo ($params['add_ts']); ?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" placeholder="上传时间"/>
    	至：<input type="text" id="end_ts" name="end_ts" class="date_section"  value="<?php echo ($params['end_ts']); ?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" placeholder="截止时间"/>          
        &nbsp;&nbsp;&nbsp;<input type="submit" name="so" class="button" value="搜索" />
    </form>
</div>
<div class="margin10px">
	<table class="mytable">
			<thead>
				<tr>
					<th width="180">ID</th>
					<th>检测人</th>
					<th>试剂盒</th>
					<th>是否匿名</th>
					<th>是否被检索</th>
					<th>上传时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($info['gene_id']); ?></td>
							<td><?php echo ($info['person_name']); ?></td>
							<td><?php echo ($info['kit_name']); ?></td>
							<td><?php echo ($info['is_public']); ?></td>
							<td><?php echo ($info['is_search']); ?></td>
							<td><?php echo ($info['add_ts']); ?></td>
							<td>
								<a title="详情" class="btn" href="<?php echo U('gene/view',array('gene_id'=>$info['gene_id']));?>" >详情</a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<td colspan="7" class="text-center"> 暂时还没有内容! </td><?php endif; ?>
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