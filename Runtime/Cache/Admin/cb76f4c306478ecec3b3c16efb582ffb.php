<?php if (!defined('THINK_PATH')) exit();?><div class="margin10px">
    <table class="mytable" style="width:365px;">
        <tr>
            <th colspan="2">修改资料</th>
        </tr>
        <tr>
            <td class="tdf">原密码：</td>
            <td><input type="password" name="formpassword" id="formpassword" /></td>
        </tr>
        <tr>
            <td class="tdf">新密码：</td>
            <td><input type="password" name="admin_password" id="admin_password" /></td>
        </tr>
        <tr>
            <td class="tdf">重复新密码：</td>
            <td><input type="password" name="rppassword" id="rppassword" /></td>
        </tr>
        <tr>
            <td class="tdf">&nbsp;</td>
            <td><input type="submit" name="submit_account_edit" value="修改" class="button" onclick="checkUserPassword()" /></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
	//验证
	function checkUserPassword(){
		var formpassword = $.trim($('#formpassword').val());
		var admin_password = $.trim($('#admin_password').val());
		var rppassword = $.trim($('#rppassword').val());
		if(formpassword == ''){
			alert('请输入原密码');
			$('#formpassword').focus();
			return false;
		}
		if(admin_password == ''){
			alert('请输入新密码');
			$('#admin_password').focus();
			return false;
		}
		if(rppassword == ''){
			alert('请重复输入新密码');
			$('#rppassword').focus();
			return false;
		}
		if(admin_password != rppassword){
			alert('两次输入密码不一致，请重新输入');
			$('#admin_password').val('');
			$('#rppassword').val('');
			return false;
		}
		$.ajax({
			url:"<?php echo U('index/pub_change_password');?>",
			data:{'formpassword':formpassword, 'admin_password':admin_password, 'rppassword':rppassword, 'do':1},
            type:'POST',
			success:function(msg){
				if(msg=='ok'){
					clearPopoutBox();
					alert('操作成功');
				}else if(msg=='pwderr'){
					alert('原密码错误');
					window.location = "<?php echo U('auth/logout');?>";
				}else{
					clearPopoutBox();
					alert(msg);
				}
			},
			error:function(){
				clearPopoutBox();
				alert('网络繁忙，请稍后重试');
			}
		});
		return false;
	}
</script>