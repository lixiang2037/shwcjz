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
<div class="margin10px">
	<form name="addpage" method="post" action="<?php echo U();?>" onsubmit="return checkNode();">
    	<input type="hidden" name="node_id" value="<?php echo ($detail['node_id']); ?>" />
		<table class="mytable">
			<tr>
				<th colspan="2"><?php echo ($detail['node_id']?'编辑':'新增'); ?>节点</th>
			</tr>
			<tr>
				<td width="100" class="tdf">父节点</td>
				<td><strong><!-- <?php echo ($node_parents); ?> --></strong>   一级节点<select name="first_id" id="first_id" ></select>&nbsp;&nbsp;
									二级节点<select name="second_id" id="second_id"></select>&nbsp;&nbsp;<a class="btn" href="javascript:void;" onclick="Gurl('refresh')">还原</a>   <!-- <input type="hidden" value="<?php echo ($node_pid); ?>" name="node_pid" />--></td>
			</tr>
			<tr>   
				<td class="tdf">节点名称：</td>
				<td><input type="text" id="node_name" name="node_name" value="<?php echo ($detail['node_name']); ?>" /><span></span> 例：xx添加</td>
			</tr>
			<tr>
				<td class="tdf">节点地址：</td>
				<td><input type="text" id="m_c_a" name="m_c_a" size="40" value="<?php echo ($detail['m_c_a']); ?>" /><span></span> 例：以“”分割（模块/控制器/动作），例子： acl/node_add</td>
			</tr>
			<tr>
				<td class="tdf">节点等级：</td>
				<td>
					<select name="node_level" id="node_level">
						<option value="1" <?php if($detail['node_level'] == 1): ?>selected="selected"<?php endif; ?> >顶部菜单</option>
						<option value="2" <?php if($detail['node_level'] == 2): ?>selected="selected"<?php endif; ?> >左边一级菜单</option>
						<option value="3" <?php if($detail['node_level'] == 3): ?>selected="selected"<?php endif; ?> >左边二级菜单</option>
						<option value="4" <?php if($detail['node_level'] == 4): ?>selected="selected"<?php endif; ?> >隐藏式菜单</option>
					</select><span></span>
				</td>
			</tr>
			<tr>
				<td class="tdf">排序：</td>
				<td><input type="text" name="px" size="3" value="<?php echo ($detail['px']); ?>" /></td>
			</tr>
			<tr>
				<td class="tdf">&nbsp;</td>
				<td><input type="submit" value="提交" class="button" /></td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
	$(function(){
		var fid=<?php if($first_pid != ''): echo ($first_pid); else: if($node_pid != ''): echo ($node_pid); else: ?>0<?php endif; endif; ?>;  //一级节点id
		var sid=<?php if($node_pid != ''): echo ($node_pid); else: ?>0<?php endif; ?>;  //二级节点id
	
	    function first_node(fid){
	    	$.post("<?php echo U('/node/get_node_select');?>", {level: 1,pid: 0, selected_id:fid }, function(result){
	            $("#first_id").html(result);
	        });
	    }
	    function second_node(sid,fid){
	    	 $.post('<?php echo U("/node/get_node_select");?>', {level: 2, pid: fid, selected_id:sid}, function(result){
	             $("#second_id").show().html(result);
	         });
	    }
	
	    first_node(fid);
	    second_node(sid,fid);
	
		$('#first_id').change(function(){
			var pid=$(this).children('option:selected').val();
			second_node(pid,pid);
		});
	});

	//检查表单
	function checkNode(){
		if($.trim($('#node_name').val())==''){
			$('#node_name').css('background-color','#ffc');
			$('#node_name').next('span').html('<font color=red> 分组名称不能为空</font>');
			$('#node_name').focus();
			return false;
		}
        if($.trim($('#m_c_a').val())==''){
            $('#m_c_a').css('background-color','#ffc');
            $('#m_c_a').next('span').html('<font color=red> 节点地址不能为空</font>');
            $('#m_c_a').focus();
            return false;
        }
        return true;
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