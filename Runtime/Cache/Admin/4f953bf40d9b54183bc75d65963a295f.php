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
    <li><a href="<?php echo U('sample/receive_list');?>">待收样品 </a></li>
    <li class="current"><a href="">确定收样 </a></li>
    </ul>
</div>
<div class="margin10px">
    <form name="form1" method="post" action="<?php echo U('sample/edit');?>" onsubmit="return checkForm();">
        <table class="mytable">
            <tr>
                <th colspan="2">样品信息</th>
            </tr>
            <tr>
            	<td width="100" class="tdf">样品编号</td>
            	<td> 
            		<?php echo ($info['sample_sn']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">订单编号</td>
            	<td> 
            		<?php echo ($info['order_sn']); ?>
            	</td>
            </tr>
            <tr>
                <th colspan="2">检测人信息</th>
            </tr>
			<tr>
            	<td width="100" class="tdf">姓名</td>
            	<td> 
            		<?php echo ($info['person_name']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">性别</td>
            	<td> 
            		<?php echo ($info['sex']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">身份证</td>
            	<td> 
            		<?php echo ($info['id_num']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">生日</td>
            	<td> 
            		<?php echo ($info['birthday']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">出生地</td>
            	<td> 
            		<?php echo ($info['birth_address']); ?>
            	</td>
            </tr>
            <!--  
            <tr>
                <td width="100" class="tdf">状态：</td>
				<td> 
				   <select name="status" id="status" style="width:120px;">
				   		<option value="" >请选择</option>
				   		<option value="2">检测中</option>
				   		<option value="3">报告已发送</option>
				   		<option value="4">失败</option>
				   </select><span></span>
                </td>
            </tr> -->
			<tr>
                <th colspan="2">联系人信息</th>
            </tr>
            <tr>
            	<td width="100" class="tdf">与联系人关系</td>
            	<td> 
            		<?php echo ($info['person_contact_name']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">联系人</td>
            	<td> 
            		<?php echo ($info['contact_name']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">身份证</td>
            	<td> 
            		<?php echo ($info['id_num']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">联系电话</td>
            	<td> 
            		<?php echo ($info['tel']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">手机号码</td>
            	<td> 
            		<?php echo ($info['phone']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">QQ</td>
            	<td> 
            		<?php echo ($info['qq']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">EMAIL</td>
            	<td> 
            		<?php echo ($info['email']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">联系地址</td>
            	<td> 
            		<?php echo ($info['contact_address']); ?>
            	</td>
            </tr>
            <tr>
                <th colspan="2">快递信息</th>
            </tr>
            <tr>
            	<td width="100" class="tdf">快递公司</td>
            	<td> 
            		<?php echo ($info['logistics_name']); ?>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">快递单号</td>
            	<td> 
            		<?php echo ($info['logistics_sn']); ?>
            	</td>
            </tr>
           	<input type="hidden" name="sample_id" value="<?php echo ($info['sample_id']); ?>" />
           	
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="submit" name="formsubmit" value="确定" class="button" />
                    <a title="补发采样器" class="btn" href="<?php echo U('sample/repair',array('sample_id'=>$info['sample_id']));?>" >补发采样器</a>
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

function checkForm()
{
//	var status_ = $('#status').val();
//	
//	if (status_ == '') {
//        $('#status').css('background-color','#ffc');
//        $('#status').next('span').html('<font color=red>请设置状态</font>');
//        $('#status').focus();
//        return false;
//    }

    return true;
}

</script>