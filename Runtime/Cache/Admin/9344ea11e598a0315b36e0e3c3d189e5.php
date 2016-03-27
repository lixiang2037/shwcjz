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
    <li><a href="<?php echo U('sample/confirm_repoet');?>">待确认报告 </a></li>
    <li class="current"><a href="">报告详情 </a></li>
    </ul>
</div>
<div class="margin10px">
	<form name="form1" method="post" action="<?php echo U('sample/view_report');?>" onsubmit="return check();">
        <table class="mytable">
            <tr>
            	<td width="100" class="tdf">样品编号</td>
            	<td> 
            		<?php echo ($sample['sample_sn']); ?>
            	</td>
            </tr>
            <tr>
                <td width="100" class="tdf">被检测人：</td>
				<td> 
				    <?php echo ($sample['person_name']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">报告时间：</td>
				<td> 
				    <?php echo ($info['add_ts']); ?>
                </td>
            </tr>
           
            <tr>
                <td width="100" class="tdf">gender：</td>
				<td> 
				    <?php echo ($info['gender']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">yboth：</td>
				<td> 
				    <?php echo ($info['yboth']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D19S433：</td>
				<td> 
				    <?php echo ($info['D19S433']); ?>
                </td>
            </tr>

            <tr>
                <td width="100" class="tdf">D5S818：</td>
				<td> 
				    <?php echo ($info['D5S818']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D21S11：</td>
				<td> 
				    <?php echo ($info['D21S11']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D18S51：</td>
				<td> 
				    <?php echo ($info['D18S51']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D6S1043：</td>
				<td> 
				    <?php echo ($info['D6S1043']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D3S1358：</td>
				<td> 
				    <?php echo ($info['D3S1358']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D13S317：</td>
				<td> 
				    <?php echo ($info['D13S317']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D7S820：</td>
				<td> 
				    <?php echo ($info['D7S820']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">D16S539：</td>
				<td> 
				    <?php echo ($info['D16S539']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">CSF1PO：</td>
				<td> 
				    <?php echo ($info['CSF1PO']); ?>
                </td>
            </tr>
          	<input type="hidden" name="sample_id" value="<?php echo ($info['sample_id']); ?>" />
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="submit" name="formsubmit" value="确认" class="button" />
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