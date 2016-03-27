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
<script type="text/javascript" src="/javascript/My97DatePicker/WdatePicker.js"></script>
<div class="main_title">
<ul class="type_list clear">
    <li ><a href="<?php echo U('gene/index');?>">基因库列表</a></li>
    <li class="current"><a>详情</a></li>
</ul>
</div>
<div class="margin10px">
	<table class="mytable">
		<tr>
			<th colspan="2">基础信息</th>
		</tr>
		<tr>
			<td width="100" class="tdf">ID</td>
			<td><?php echo ($info['gene_id']); ?></td>
		</tr>
		<tr>
			<td width="100" class="tdf">检测人</td>
			<td><?php echo ($info['person_name']); ?></td>
		</tr>
		<tr>
			<td width="100" class="tdf">是否匿名</td>
			<td><?php echo ($info['is_public']); ?></td>
		</tr>
		<tr>
			<td width="100" class="tdf">是否被检索</td>
			<td><?php echo ($info['is_search']); ?></td>
		</tr>
		<tr>
			<td width="100" class="tdf">上传时间</td>
			<td ><?php echo ($info['add_ts']); ?></td>
		</tr>
		
		<tr>
			<td width="100" class="tdf">基因编码</td>
			<td ><?php echo ($info['retrieval_sn']); ?></td>
		</tr>
		<tr>
			<td width="100" class="tdf">基因比对状态</td>
			<td ><?php echo ($info['retrieval_status']); ?></td>
		</tr>
         <tr>
         	<th>检测人信息</th>
         </tr>
         <tr>
			<td width="100" class="tdf">性别</td>
			<td><?php echo ($person['sex']); ?></td>
		</tr>
         <tr>
         	<td width="100" class="tdf">出生年月</td>
         	<td><?php echo ($person['byear']); ?>年<?php echo ($person['bmonth']); ?>月<?php echo ($person['bday']); ?>日</td>
         </tr>
         <tr>
			<td width="100" class="tdf">身份证号码</td>
			<td><?php echo ($person['id_num']); ?></td>
		</tr>
		<tr>
			<td width="100" class="tdf">出生地</td>
			<td><?php echo ($person['address_info']); ?></td>
		</tr>
		
		<tr>
			<th>联系人信息</th>
		</tr>
		<?php if(!empty($contact["person_contact"])): ?><tr>
			<td width="100" class="tdf">联系人</td>
			<td ><?php echo ($contact["person_contact"]); ?>(<a href="javascript:void(0);" onclick="to_view('<?php echo U('/gene/person_contact',array('contact_id'=>$contact['contact_id']));?>')">查看详情</a>)</td>
		</tr>
		<tr>
			<td width="100" class="tdf">关系</td>
			<td ><?php echo ($contact["person_contact_name"]); ?></td>
		</tr>
		<?php else: ?>
		<tr>
			<td width="100" class="tdf"></td>
			<td colspan="2">暂无数据</td>
		</tr><?php endif; ?>
		<?php if(!empty($locuss)): ?><tr>
            	<th colspan="2">试剂盒信息</th>
        	</tr>
            	
            	<tr>
            		<td width="100" class="tdf"></td>
            		<td>
            			<table width="70%">
            				<tr><td>试剂盒名称</td><td><?php echo ($info['kit_name']); ?></td><td><a href="<?php echo U('gene/exported_file',array('gene_id'=>$info['gene_id']));?>">导出数据</a></td></tr>
            				<tr><td>试剂盒位点</td><td>数值</td></tr>
            				<?php if(is_array($locuss)): $i = 0; $__LIST__ = $locuss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$locus): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($locus['locus_name']); ?></td><td><?php echo ($info[$locus['locus_name']]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
            			</table>
            		</td>
            	</tr><?php endif; ?>
		</table>
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
	function to_view(s_url)
{
	$.fn.sbox({n:'a',title:'查看详情',width:430,height:430,ctype:'url',url:s_url});
}
</script>