<?php if (!defined('THINK_PATH')) exit();?><div class="tet">
		
	<p><span>联系人</span><input type="text" id="user_name" name="user_name" class="wb" value="<?php echo ($info['user_name']); ?>" disabled="disabled" /></p>
	<p><span>标题</span><input type="text" id="title" name="title"   class="wb"/></p>
	<p><span>内容</span><textarea name="content" id="content" style=" width:280px; height:80px;"></textarea></p>
		
</div>

 <script type="text/javascript">
$("#SD_confirm").on("click",function(){
	var url = "<?php echo U('/gene/Send_Message');?>";
	var title = $.trim($('#title').val());
	var content = $.trim($('#content').val());

	if(title == ''){
		alert('标题不能为空');
		return false;
	}else if(!title == '' && title.length > 40){
		alert('标题不能超过40个汉字');
		return false;
	}
	if(content == ''){
		alert('内容不能为空');
		return false;
	}
	
    $.post(url, $("#dialogForm").serialize(), function(data){
        if (data.success == '1') {
            $('#SD_cancel').click();
            alert(data.message);
            return false;
        } else {
        	alert(data.message);
        } 
    });
});


 </script>