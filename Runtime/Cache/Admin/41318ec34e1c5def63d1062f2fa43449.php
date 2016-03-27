<?php if (!defined('THINK_PATH')) exit();?><div class="margin10px">
		<table class="mytable" style="width:450px;">
			<tr>
				<th colspan="2">短信</th>
			</tr>
			<tr>
				<td class="tdf">手机号码：</td>
				<td><input type="text" name="mobile_number" id="mobile_number" /></td>
			</tr>
			<tr>
				<td class="tdf">信息内容：</td>
				<td><textarea name="sms_content" id="sms_content" style=" width:280px; height:80px;" onkeyup="document.getElementById('count').innerHTML=this.value.length" ></textarea><span id="count" style="color:red;">0</span>/50</td>
			</tr>
			<tr>
				<td class="tdf"></td>
				<td><input type="submit" value="发送" class="button" onclick="checkSms()" /></td>
			</tr>
		</table>
</div>
<script type="text/javascript">
	//验证
	function checkSms(){
		var mobile_number = $.trim($('#mobile_number').val());
		var sms_content = $.trim($('#sms_content').val());

		if(mobile_number == ''){
			alert('请输入手机号码');
			$('#mobile_number').focus();
			return false;
		}
		if(sms_content == ''){
			alert('请输入短信内容');
			$('#sms_content').focus();
			return false;
		}
		$.ajax({
			url:"<?php echo U('index/pub_send_sms');?>",
			data:{'mobile_number':mobile_number, 'sms_content':sms_content, 'do':1},
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