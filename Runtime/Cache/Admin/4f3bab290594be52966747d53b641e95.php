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
    <li><a href="<?php echo U('kit/index');?>">试剂盒列表</a></li>
    <li class="current"><a href="">编辑试剂盒</a></li>
</ul>
</div>
<div class="margin10px">
    <form name="form1" method="post" action="<?php echo U('kit/edit');?>" onsubmit="return check();">
        <table class="mytable">
            <tr>
                <th colspan="2">编辑试剂盒</th>
            </tr>
            <tr>
                <td width="100" class="tdf">名称：</td>
				<td> 
				    <input type="text" id="kit_name" name="kit_name" value="<?php echo ($info['kit_name']); ?>" size="40" /><span></span>
                </td>
            </tr>
            
            <tr>
                <td width="100" class="tdf">状态：</td>
				<td> 
				     <?php if(is_array($search_option["status"])): $i = 0; $__LIST__ = $search_option["status"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><input type="radio" name="status" value="<?php echo ($d['id']); ?>" <?php if($d['id'] == $info['status']): ?>checked="checked"<?php endif; ?> />&nbsp;<?php echo ($d["val"]); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <input type="hidden" name="kit_id"  value="<?php echo ($info['kit_id']); ?>" />       
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="submit" name="formsubmit" value="提交" class="button" />
                </td>
            </tr>
        </table>
    </form>
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

<script type="text/javascript">

function check()
{
   var kit_name_ = $.trim($("#kit_name").val());
   if (kit_name_ == '') {
       $('#kit_name').css('background-color','#ffc');
       $('#kit_name').next('span').html('<font color=red> 试剂盒名称不能为空</font>');
       $('#kit_name').focus();
       return false;
   }
 
   return true;
}

</script>