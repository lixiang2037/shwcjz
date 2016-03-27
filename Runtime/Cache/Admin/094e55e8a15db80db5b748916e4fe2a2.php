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
        <table class="mytable">
            	<tr>
                	<th colspan="2"><?php echo ($info['person_name']); ?></th>
            	</tr>
            	<tr>
	            	<td width="100" class="tdf">订单号</td>
	            	<td> 
	            		<?php echo ($info['order_sn']); ?>
	            	</td>
            	</tr>
	           
	            <tr>
	                <td width="100" class="tdf">样品编号：</td>
					<td> 
						<?php echo ($info['sample_sn']); ?>
	                </td>
	            </tr>
	            <tr>
	                <td width="100" class="tdf">性别：</td>
					<td> 
						<?php echo ($info['sex']); ?>
	                </td>
	            </tr>
	            <tr>
	                <td width="100" class="tdf">身份证：</td>
					<td> 
						<?php echo ($info['id_num']); ?>
	                </td>
	            </tr>
	            <tr>
	            	<td width="100" class="tdf">生日：</td>
					<td> 
						<?php echo ($info['birthday']); ?>
	                </td>
	            </tr>
	            <tr>
	            	<td width="100" class="tdf">出生地：</td>
					<td> 
						<?php echo ($info['birth_address']); ?>
	                </td>
	            </tr>
	            
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="button" onclick="javascript:window.print();" value="打印" class="button" >
                </td>
            </tr>
        </table>
</div>