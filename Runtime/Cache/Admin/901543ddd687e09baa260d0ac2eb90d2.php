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
	<ul class="type_list clear"><li class="current"><a href="">会员列表</a></li><li><a href="<?php echo U('user/add');?>">添加会员</a></li></ul>
</div>
<script type="text/javascript" src="/javascript/My97DatePicker/WdatePicker.js"></script>
<div class="margin10px searchbox">
	<form action="<?php echo U('user/index');?>" method="get">
	<table border=0>
		<tr><td>
		<select name="search_type" id="search_type">
		<option value="key" selected="selected">按关键字搜索</option>
		<option value="reg_date" >按注册日期范围搜索</option>
		<option value="login_date" >按最后登陆日期范围搜索</option>
		</select>
		</td>
		<td>
		<span id="key-search">关键字：<input type="text" id="search_key" name="search_key" class="search-input" value="<?php echo ($params['search_key']); ?>" placeholder="注册名、昵称或姓名"></span>
		<span id="date-search" style="display: none"><table border=0 style="width:400px;"><tr><td>日期范围：</td><td><input type="text" id="start_date" name="start_date" class="date_section"  value="<?php echo ($params['start_date']); ?>" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" placeholder="日期起"/></td><td><input type="text" id="end_date" name="end_date"  class="date_section" value="<?php echo ($params['end_date']); ?>"  onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" placeholder="日期止"/></td></tr></table> </span>
		</td>
		<td><input type="submit" name="so" class="button" value="搜索" />
		</td>
		</tr>
	</table>
	</form>
</div>
<div class="margin10px">
	<table class="mytable sorttable">
			<thead>
				<tr>
					<th width="100">用户ID</th>
					<th>注册用户名</th>
					<th>真实姓名</th>					
					<th>性别</th>
					<th>会员状态</th>
					<th>注册时间</th>
					<th>最后登陆时间</th>
					<th>登陆次数</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($info['user_id']); ?></td>
						<td><?php echo ($info['user_name']); ?></td>
						<td><?php echo ($info['real_name']); ?></td>
						<td><?php echo ($info['sex_name']); ?></td>
						<td><span class="cursorpointer" onclick="changestatus(<?php echo ($info['user_id']); ?>)"><font color="<?php echo ($info['status']==1?'green':'red'); ?>"><?php echo ($info['status_name']); ?></font></span></td>
                        <td><?php echo ($info['reg_ts']); ?></td>
						<td><?php echo ($info['last_login_ts']); ?></td>
						<td><?php echo ($info['login_num']); ?></td>
						<td>
							<a title="详情" class="btn" href="javascript:;" onClick="to_view('<?php echo U("user/view", array("user_id" => $info["user_id"]));?>');" >详情</a>
							<a title="编辑" class="btn" href="<?php echo U('user/edit', array('user_id' => $info['user_id']));?>">编辑</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				<td colspan="8" class="text-center"> 暂时还没有内容! </td><?php endif; ?>
			</tbody>
		</table>
    <div style="height:10px;">&nbsp;</div>
    <div class="pagenum"> <?php echo ($page); ?> </div>
</div>
<script>
$(function(){		
   $("#search_type").change(function(){
	var type= $(this).val();
	if(type == "key"){
		$("#key-search").show();
		$("#date-search").hide();
	}else{
		$("#key-search").hide();
		$("#date-search").show();
	}
   });
    $("#search_type").val("<?php echo ($search_type); ?>");
    $("#search_type").change();
});


function changestatus(id){
	var url="<?php echo U('user/ajax_change_status');?>";
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

function to_view(s_url)
{
	$.fn.sbox({n:'a',title:'会员详情',width:430,height:430,ctype:'url',url:s_url});
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