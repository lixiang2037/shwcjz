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
    <li class="current"><a>个人列表</a></li>
</ul>
</div>


<div class="margin10px searchbox">
    <form action="<?php echo U('/messages/index');?>" method="get">
    	发件人<input type="text" placeholder="请输入发件人用户名" name="from_user_name" value="<?php echo ($params['from_user_name']); ?>">&nbsp;
    	收件人<input type="text" placeholder="请输入收件人用户名" name="to_user_name" value="<?php echo ($params['to_user_name']); ?>">&nbsp;
    	私信状态&nbsp;<select name="status">
    		<option value="">--请选择--</option>
    		<?php if(is_array($search_option["status"])): $i = 0; $__LIST__ = $search_option["status"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>" <?php if($data['id'] == $params['status']): ?>selected="selected"<?php endif; ?> ><?php echo ($data['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    	</select>&nbsp;
        查看状态&nbsp;<select name="view_status">
		    <option value="">--请选择--</option>
		    <?php if(is_array($search_option["view_status"])): $i = 0; $__LIST__ = $search_option["view_status"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>" <?php if($data['id'] == $params['view_status']): ?>selected="selected"<?php endif; ?> ><?php echo ($data['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		    </select>&nbsp;
    	时间范围：<input type="text" id="add_time" name="add_time" class="date_section"  value="<?php echo ($params['add_time']); ?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" placeholder="开始时间"/>
    	至&nbsp;<input type="text" id="end_time" name="end_time" class="date_section"  value="<?php echo ($params['end_time']); ?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" placeholder="截止时间"/>          
        &nbsp;&nbsp;&nbsp;<input type="submit" name="so" class="button" value="搜索" />
    </form>
</div>
<div class="margin10px">
	<table class="mytable">
			<thead>
				<tr>
					<th width="180">ID</th>
					<th>发件人</th>
					<th>收件人</th>
					<th>标题</th>
					<th>发送时间</th>
					<th>私信状态</th>
					<th>是否查看</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($info['msg_id']); ?></td>
							<td><?php echo ($info['from_user_name']); ?></td>
							<td><?php echo ($info['to_user_name']); ?></td>
							<td><?php echo ($info['title']); ?></td>
							<td><?php echo ($info['add_time']); ?></td>
							<td><?php echo ($info['status_name']); ?></td>
							<td><?php echo ($info['view_status_name']); ?></td>
							<td>
								<!-- <a title="详情" class="btn" href="<?php echo U('messages/view',array('from_user_id'=>$info['from_user_id']));?>" >详情</a> -->
								<a title="私信详情" href="javascript:;" onClick="$.fn.sbox({n:'a',title:'个人私信',width:480,height:330,ctype:'url',url:'<?php echo U('messages/view/',array('msg_id'=>$info['msg_id']));?>'})" class="btn">详情</a>
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