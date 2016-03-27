<?php if (!defined('THINK_PATH')) exit();?><div class="margin10px">
    <table class="mytable" style="width:580px;">
        <tr>
            <th colspan="2">电子邮件</th>
        </tr>
        <tr>
            <td class="tdf">邮箱地址：</td>
            <td><input type="text" name="email_addr" id="email_addr" size="35" /></td>
        </tr>
        <tr>
            <td class="tdf">邮件标题：</td>
            <td><input type="text" name="mail_subject" id="mail_subject" size="50" /></td>
        </tr>
        <tr>
            <td class="tdf">邮件内容：</td>
            <td><textarea name="email_content" id="email_content" style=" width:450px; height:150px;" ></textarea></td>
        </tr>
        <tr>
            <td class="tdf"></td>
            <td><input type="submit" value="发送" class="button" onclick="checkEmail()" /></td>
        </tr>
    </table>
</div>

<script type="text/javascript">
	//验证
	function checkEmail(){
		var email_addr = $.trim($('#email_addr').val());
		var mail_subject = $.trim($('#mail_subject').val());
		var email_content = $.trim($('#email_content').val());
		if(email_addr == ''){
			alert('请输入邮箱地址');
			$('#email_addr').focus();
			return false;
		}
		if(mail_subject == ''){
			alert('请输入邮件标题');
			$('#mail_subject').focus();
			return false;
		}
		if(email_content == ''){
			alert('请输入邮件内容');
			$('#email_content').focus();
			return false;
		}
		$.ajax({
			url:"<?php echo U('index/pub_send_email');?>",
			data:{'email_addr':email_addr, 'email_content':email_content, 'mail_subject':mail_subject, 'do':1},
            type:'POST',
			success:function(msg){
				if(msg=='ok'){
                    clearPopoutBox();
					alert('发送成功');
				}else{
                    //clearPopoutBox();
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