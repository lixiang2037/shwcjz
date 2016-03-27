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
    <form name="batch_locus" id="batch_locus" method="post" action="<?php echo U('kit/batch_locus2');?>" onsubmit="return checkForm();">
        <table class="mytable">
        	<tbody>
            <tr>
                <th colspan="3">批量添加位点信息</th>
            </tr>
            <tr>
                <td class="tdf" width="120">试剂盒：</td>
                <td colspan="2">
                	<select name="kit_id" id="kit_id">
                      <option value="">--请选择--</option>
                      <?php if(is_array($search_option["kit_select"])): $i = 0; $__LIST__ = $search_option["kit_select"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><option value="<?php echo ($k['kit_id']); ?>" <?php if($kit_id == $k['kit_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($k['kit_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>	
                    <span></span>
                </td>
            </tr>
            <tr>
            	<td class="tdf" width="120">已添加的位点：</td>
            	<td colspan="2">
            	<span id="has_locus">
	            <?php if(!empty($locus_)): if(is_array($locus_)): $i = 0; $__LIST__ = $locus_;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cus): $mod = ($i % 2 );++$i; echo ($cus['locus_name']); ?>;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>
			     </span>
			     </td>
            </tr>
            
            <tr>
            	<td></td>
				<td width="30%"><strong>名称：</strong><input type="text" id="locus_name_1" name="locus_name_1" /></td>
				<td><a href="javascript:void(0);" class="btn btn_green add">新增</a></td>
			</tr>
            </tbody>
             <tr>
                <td class="tdf">&nbsp;</td>
                <td  colspan="2">
                    <input type="submit" value="提交" class="button" />
                </td>
            </tr>
         
        </table>
    </form>
</div>

<script type="text/javascript">

	$(function(){
		var index = 2;
	    $(".mytable tbody .add").click(function(){
	        if(index == 21){
	            alert('每次只可添加20个位点');
	            return false;
	        }
	        $(this).parent().parent().parent().parent().append('<tr><td></td><td><strong>名称：</strong><input type="text" id="locus_name_'+index+'" name="locus_name_'+index+'" /></td><td><a class="btn release" href="javascript:void(0);">移除</a></td></tr>');
			index++;
	    });
	
	    $(".release").live('click', function(){
	        $(this).parent().parent().remove();
	        index--;
	    });

	    $('#kit_id').change(function(){
			var kit_id_=$(this).children('option:selected').val();
			$.post("<?php echo U('/kit/ajax_get_locus');?>", {kit_id: kit_id_}, function(result){
                $("#has_locus").html(result);
            });
		});
	});

    function checkForm()
    {
    	var kit_id_ = $('#kit_id').val();
        if(kit_id_ == ''){
        	$('#kit_id').css('background-color','#ffc');
            $('#kit_id').next('span').html('<font color=red>请选择试剂盒</font>');
            $('#kit_id').focus();
            return false;
        }

        var ch = 1;
    	for(var i=1; i<21; i++){
    		if($('#locus_name_'+i).length>0){
    			ch++;
    			var locus_name_ = $('#locus_name_'+i).val();
    			if(locus_name_ == ''){
    				alert('第'+i+'行名称必须填写');
    				return false;
    			}
    		}else{
    			break;
    		}
    	}
    	if(ch == 1){
    		alert('请填写位点信息');
    		return false;
    	}

    	// 批量添加
    	$.ajax({
    		url : '/kit/batch_locus',
    		data : $('#batch_locus').serialize(),
    		type : 'post',
    		success : function(msg) {
    			if (msg.success == '1') {
    				alert(msg.message);
    				location.href = '/kit/locus_list/kit_id/'+kit_id_;
    			} else {
    				alert(msg.message);
    			}
    		},
    		error : function() {
    			alert('系统出错!');
    		}
    	})

        return false;;
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