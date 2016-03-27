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
    	<input type="hidden" name="group_id" value="<?php echo ($detail['group_id']); ?>" />
		<table class="mytable">
			<tr>
				<th colspan="2"><?php echo ($detail['group_id']?'编辑':'新增'); ?>分组</th>
			</tr>
            <tr>
                <td width="100" class="tdf">所属分组：</td>
                <td><?php echo ($groups); ?></td>
            </tr>
			<tr>
				<td width="100" class="tdf">分组名称：</td>
				<td><input type="text" id="group_name" name="group_name" size="40" value="<?php echo ($detail['group_name']); ?>" /><span></span></td>
			</tr>
			<tr>
				<td class="tdf" valign="top">分组权限：</td>
				<td>
                    <div class="node_list">
						<?php if(!empty($nodes)): if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div><input class="cb" type="checkbox" name="auth[]" id="n_<?php echo ($v['node_id']); ?>" value="<?php echo ($v['node_id']); ?>" <?php if($v['has']){echo 'checked="checked"';}?>>
						<label for="n_<?php echo ($v['node_id']); ?>" class="color_0 fb f14"><?php echo ($v['node_name']); ?></label>
						    <?php if(is_array($v['_sub'])): $i = 0; $__LIST__ = $v['_sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><div class="mleft30px"><input class="cb" type="checkbox" name="auth[]" id="n_<?php echo ($vv['node_id']); ?>" value="<?php echo ($vv['node_id']); ?>" <?php if($vv['has']){echo 'checked="checked"';}?> />
								<label for="n_<?php echo ($vv['node_id']); ?>" class="fb"><?php echo ($vv['node_name']); ?></label>
                                    <div class="mleft60px bd1sccc">
									   <?php if(is_array($vv['_sub'])): $i = 0; $__LIST__ = $vv['_sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?><input type="checkbox" name="auth[]" id="n_<?php echo ($vvv['node_id']); ?>" value="<?php echo ($vvv['node_id']); ?>" <?php if($vvv['has']){echo 'checked="checked"';}?> />
										<label for="n_<?php echo ($vvv['node_id']); ?>"><?php echo ($vvv['node_name']); ?></label>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					没有数据<?php endif; ?>
                    </div>
                </td>
			</tr>
			<tr>
				<td class="tdf">&nbsp;</td>
				<td><input type="checkbox" id="cka" onclick="checkAll(this, 'auth[]')" />全选&nbsp;&nbsp;&nbsp;<input type="submit" name="formsubmit" value="提交" class="button" /></td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
    $('.cb').click(function(){
        var flag = false;
        if($(this).attr('checked')){ flag = true; }
        $(this).parent().find('input[type="checkbox"]').attr('checked', flag);
    });
	//检查表单
	function checkNode(){
		if($.trim($('#group_name').val())==''){
			$('#group_name').css('background-color','#ffc');
			$('#group_name').next('span').html('<font color=red> 分组名称不能为空</font>');
			$('#group_name').focus();
			return false;
		}
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