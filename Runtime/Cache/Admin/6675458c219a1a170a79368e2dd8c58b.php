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
<script type="text/javascript" src="/javascript/ajaxfileupload.js"></script>
<div class="main_title">
<ul class="type_list clear">
    <li><a href="<?php echo U('goods/index');?>">套餐列表</a></li>
    <li class="current"><a href="">编辑套餐</a></li>
</ul>
</div>
<div class="margin10px">
    <form name="form1" method="post" action="<?php echo U('goods/edit');?>" onsubmit="return check();">
        <table class="mytable">
            <tr>
                <th colspan="2">编辑套餐</th>
            </tr>
            <tr>
                <td width="100" class="tdf">套餐名称：</td>
				<td> 
				    <input type="text" id="goods_name" name="goods_name" size="40" value="<?php echo ($info['goods_name']); ?>" /><span></span>
                </td>
            </tr>
            
            <tr>
		        <td width="100" class="tdf">套餐图标：</td>
				<td> 
				  <img id="loading" src="/images/admin/loading.gif" style="display:none;">
			      <div id="showimage">
				    <img src="<?php echo ($info['goods_img']); ?>" border=0 width="70" height="40"  />
				  </div>
				  <input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"/><span></span> 	 　
		          <input id="goods_img" type="hidden" name="goods_img" value="<?php echo ($info['goods_img']); ?>"/> <span></span> 				   
		        </td>
      		</tr>
            
            <tr>
                <td width="100" class="tdf">价格：</td>
				<td> 
				    <input type="text" id="goods_price" name="goods_price" size="15" value="<?php echo ($info['goods_price']); ?>" /><span></span>
                </td>
            </tr>
            
            <tr>
                <td width="100" class="tdf">状态：</td>
				<td> 
				     <?php if(is_array($search_option["status"])): $i = 0; $__LIST__ = $search_option["status"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><input type="radio" name="status" value="<?php echo ($d['id']); ?>" <?php if($d['id'] == $info['status']): ?>checked="checked"<?php endif; ?> />&nbsp;<?php echo ($d["val"]); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
                                  
             <tr>
                <td class="tdf">描述：</td>
                <td>
	                <textarea name="goods_desc" id="goods_desc" style="width:680px; height:200px;" ><?php echo ($info['goods_desc']); ?></textarea>	
					<script type="text/javascript">
						KindEditor.ready(function(K) {
							K.create('textarea[name="goods_desc"]', {
							    filterMode : false,
									allowFileManager : true
								});
						});
					</script>	
                </td>
            </tr>
           <input type="hidden" name="goods_id" value="<?php echo ($info['goods_id']); ?>" />
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
	   $("#fileToUpload").on('change',function(){
	     ajaxFileUpload();
	   });
	 });

function ajaxFileUpload()
{
	$("#loading")
		.ajaxStart(function(){
		  $(this).show();
		  $("#fileToUpload").next('span').empty();
		})
	 .ajaxComplete(function(){
	   $(this).hide();
	 });

	$.ajaxFileUpload
	(
	 {
	   url:'<?php echo U('goods/ajax_upload_image');?>',
	   secureuri:false,
	   fileElementId:'fileToUpload',
	   dataType: 'json',
	   success: function (data, status)
	   {
		 if(! data.success)
		 {
		   $("#fileToUpload").css('background-color','#ffc');
		   $("#fileToUpload").next('span').html('<font color=red> '+data.msg+'</font>');
		   $("#fileToUpload").focus();
		   return false;
		 }else
		 {
		   $("#goods_img").val(data.url);
		   $("#showimage").empty().append(('<img  src="'+data.url+'" border=0 width="70" height="40">') );
		 }
	   },
	   error: function (data, status, e)
	   {
		 alert(e);
		 return false;
	   }
	 }
	)
}
function check()
{
	$('#goods_name').next('span').html('');
	$('#goods_price').next('span').html('');
	
	var goods_name_ = $.trim($("#goods_name").val());
	var goods_price_ = $.trim($("#goods_price").val());
	if (goods_name_ == '') {
       $('#goods_name').css('background-color','#ffc');
       $('#goods_name').next('span').html('<font color=red> 套餐名称不能为空</font>');
       $('#goods_name').focus();
       return false;
    }
  
    if (goods_price_ == '') {
       $('#goods_price').css('background-color','#ffc');
       $('#goods_price').next('span').html('<font color=red> 套餐价格不能为空</font>');
       $('#goods_price').focus();
       return false;
    }
	return true;
}

</script>