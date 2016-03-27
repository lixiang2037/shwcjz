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
    <li class="current"><a>报告上传</a></li>
</ul>
</div>

<div class="margin10px">

    <form name="form1" method="post" action="<?php echo U('sample/upload_report');?>" enctype ="multipart/form-data" onsubmit="return check();">
        <table class="mytable">

            <tr>
            	<td width="100" class="tdf">样品编号</td>
            	<td><?php echo ($info['sample_sn']); ?></td>
            </tr>
            
            <tr>
            	<td width="100" class="tdf">订单号</td>
            	<td><?php echo ($info['order_sn']); ?></td>
            </tr>
            
            <tr>
            	<td width="100" class="tdf">被检测人</td>
            	<td><?php echo ($info['person_name']); ?></td>
            </tr>
            
            <tr>
            	<td width="100" class="tdf">导入模板</td>
            	<td><a href="/template/sample_gene.xls">sample_gene.xls</a></td>
            </tr>
	
            <tr>
                <td width="100" class="tdf">上传文件：</td>
				<td> 
				    <input type="file" name="report_file" id="report_file"/><span></span>
                </td>
            </tr>
            
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="hidden" name="sample_id" value="<?php echo ($info['sample_id']); ?>" />
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
    $('#report_file').val('');
})

function check()
{
    var report_file_ = $.trim($('#report_file').val());
    if (report_file_ == '') {
        alert('上传的文件不能为空');
        return false;
    }

    var file_extension  = report_file_.substring(report_file_.lastIndexOf(".")+1);
    if (report_file_ != '' && file_extension != 'xls') {
        $('#report_file').css('background-color','#ffc');
        $('#report_file').next('span').html('<font color=red> 请上传报告文件(xls格式)</font>');
        $('#report_file').focus();
        return false;
    }
    return true;
}
</script>