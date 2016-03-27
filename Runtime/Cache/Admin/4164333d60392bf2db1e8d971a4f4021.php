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
<script type="text/javascript" src="/javascript/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="/javascript/kindeditor/lang/zh_CN.js"></script>
<div class="main_title">
	<ul class="type_list clear">
    <li><a href="<?php echo U('user/index');?>">会员列表 </a></li>
    <li class="current"><a href="">添加会员 </a></li>
    </ul>
</div>
<div class="margin10px">
    <form name="form1" method="post" action="<?php echo U('user/add');?>" onsubmit="return checkForm();">
        <table class="mytable">
            <tr>
                <th colspan="2">添加会员</th>
            </tr>
            <tr>
            	<td width="100" class="tdf">用户名</td>
            	<td> 
            		<input type="text" id="user_name" name="user_name" size="40" /> <span></span>
            	</td>
            </tr>
            <tr>
            	<td width="100" class="tdf">密码</td>
            	<td> 
            		<input type="text" id="password" name="password" size="40" /> <span></span>
            	</td>
            </tr>
            <tr>
                <td width="100" class="tdf">真实姓名：</td>
				<td> 
				    <input type="text" id="real_name" name="real_name" size="40" /><span></span>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">邮箱：</td>
				<td> 
				    <input type="text" id="email" name="email" size="40" /><span></span>
                </td>
            </tr>
            <tr>
            	<td width="100" class="tdf">生日</td>
            	<td>
            		<select name="byear" id="byear" style="width:120px;">
						<?php echo ($year); ?>
					</select>  
					年
					<select name="bmonth" id="bmonth" style="width:120px;">
						<?php echo ($month); ?>
					</select> 
					月
					<select name="bday" id="bday" style="width:120px;">
						<?php echo ($day); ?>
					</select> 
					日
            	</td>
            </tr>

            <tr>
                <td class="tdf">状态：</td>
                <td>
                    <?php if(is_array($search_option["status"])): $i = 0; $__LIST__ = $search_option["status"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$inf): $mod = ($i % 2 );++$i;?><input type="radio" name="status" value="<?php echo ($inf['id']); ?>" <?php if($inf['default'] == '1'): ?>checked="checked"<?php endif; ?> />&nbsp;<?php echo ($inf["val"]); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">手机：</td>
				<td> 
				    <input type="text" id="mobile" name="mobile" size="40" onkeyup="this.value=this.value.replace(/[^\d]/g,'') " /><span></span>
                </td>
            </tr>
			
            <tr>
            	<td width="100" class="tdf">所在地：</td>
            	<td>
            		<select name="province_id" id="J_province" style="width:120px;">
						<option value=''>-请选择省份-</option>
					</select>  
					省
					<select name="city_id" id="J_city" style="width:120px;" >
					</select> 
					市
            	</td>
            </tr>
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
$(function(){
	var pid=0;  //默认省份id
	var cid=0;  //默认城市id

    function change_province(pid){
        $.post("<?php echo U('/user/getProvince');?>", {pid: pid}, function(result){
                $("#J_province").html(result);
            });
        }
    function change_city(p_pid,p_cid){
        $.post('<?php echo U("/user/getCity");?>', {pid: p_pid, cid: p_cid}, function(result){
            $("#J_city").show().html(result);
        });
        var cid_g=$(this).children('option:selected').val();
    }

    change_province(pid);
    change_city(pid,cid);

	$('#J_province').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g)
	});
});
function checkForm()
{
	$('#user_name').next('span').html('');
	$('#password').next('span').html('');
	$('#email').next('span').html('');
	$('#mobile').next('span').html('');
	
	var user_name_ = $('#user_name').val();
	var password_  = $('#password').val();
	var email_ = $('#email').val();
	var mobile_ = $('#mobile').val();
	
	if (user_name_ == '') {
        $('#user_name').css('background-color','#ffc');
        $('#user_name').next('span').html('<font color=red> 用户名不能为空</font>');
        $('#user_name').focus();
        return false;
    }
	if (password_ == '') {
        $('#password').css('background-color','#ffc');
        $('#password').next('span').html('<font color=red> 用户密码不能为空</font>');
        $('#password').focus();
        return false;
    }

	// 验证用户名
	var checkmobile = /(^1+(\d){10}$)|(^0+(\d){11}$)/;
	var checkemail  = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
	if(!checkmobile.test(user_name_))
	{
		if(!checkemail.test(user_name_))
		{
			$('#user_name').css('background-color','#ffc');
			$('#user_name').next('span').html('<font color=red> 用户名必须为正确的手机号码或邮箱，请确认</font>');
	        $('#user_name').focus();
			return false;
		}
	}

	// 验证密码
	var checkpassword = /^[a-zA-Z]\w{5,17}$/;
	if(!checkpassword.test(password_))
	{
		$('#password').css('background-color','#ffc');
        $('#password').next('span').html('<font color=red> 密码必须以字母开头，长度在6-18之间，只能包含字符、数字和下划线，请确认</font>');
        $('#password').focus();
		return false;
	}

	// 验证邮箱(非空情况)
	if(email_ != '')
	{
		if(!checkemail.test(email_))
		{
			$('#email').css('background-color','#ffc');
	        $('#email').next('span').html('<font color=red> 请填写正确邮箱</font>');
	        $('#email').focus();
	        return false;
		}
	}

	// 验证手机号码(非空情况)
	if(mobile_ != '')
	{
		if(!checkmobile.test(mobile_))
		{
			$('#mobile').css('background-color','#ffc');
	        $('#mobile').next('span').html('<font color=red> 请填写正确手机号码</font>');
	        $('#mobile').focus();
	        return false;
		}
	}
	
}

</script>