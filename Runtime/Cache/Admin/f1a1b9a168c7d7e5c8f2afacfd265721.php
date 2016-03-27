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
    <li class="current"><a>样品列表</a></li>
</ul>
</div>


<div class="margin10px searchbox">
    <form action="<?php echo U('/sample/index');?>" method="get">
        样品编号：<input type="text" id="sample_sn" name="sample_sn" class="search-input" value="<?php echo ($params['sample_sn']); ?>" placeholder="请输入样品编号">
        &nbsp;&nbsp;
         订单编号：<input type="text" id="order_sn" name="order_sn" class="search-input" value="<?php echo ($params['order_sn']); ?>" placeholder="请输入订单编号">
        &nbsp;&nbsp;
        状态：<select name="status">
    <option value="">--请选择--</option>
    <?php if(is_array($search_option["sample_status"])): $i = 0; $__LIST__ = $search_option["sample_status"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>" <?php if($data['id'] == $params['status']): ?>selected="selected"<?php endif; ?> ><?php echo ($data['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>         
        &nbsp;&nbsp;&nbsp;<input type="submit" name="so" class="button" value="搜索" />
    </form>
</div>
<div class="margin10px">
	<table class="mytable">
			<thead>
				<tr>
					<th width="60">ID</th>
					<th>样品编号</th>
					<th>订单编号</th>
					<th>被检测人</th>
					<th>状态</th>
					<th>申请时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($info['sample_id']); ?></td>
							<td><?php echo ($info['sample_sn']); ?></td>
							<td><?php echo ($info['order_sn']); ?></td>
							<td><?php echo ($info['person_name']); ?></td>
							<td><?php echo ($info['status_name']); ?></td>
							<td><?php echo ($info['add_ts']); ?></td>
							<td>
								<a title="详情" class="btn" href="<?php echo U('sample/view',array('sample_id'=>$info['sample_id']));?>" >详情</a>
								<?php if($info['status'] == 1): ?><a title="打印单据" class="btn" href="<?php echo U('/sample/print_sample', array('sample_id'=>$info['sample_id']));?>" target="_blank">打印单据</a><?php endif; ?>
								<?php if($info['status'] == 1 or $info['status'] == 2): ?><a title="补发采样器" class="btn" href="<?php echo U('sample/repair',array('sample_id'=>$info['sample_id']));?>" >补发采样器</a><?php endif; ?>
								<?php if($info['status'] == 4): ?><a title="补发报告" class="btn" href="<?php echo U('sample/send_report',array('sample_id'=>$info['sample_id']));?>" >补发报告</a><?php endif; ?>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<td colspan="10" class="text-center"> 暂时还没有内容! </td><?php endif; ?>
			</tbody>
		</table>
    <div style="height:10px;">&nbsp;</div>
    <div class="pagenum"> <?php echo ($page); ?> </div>
</div>


<script type="text/javascript">
//打印样品单据
var sample_id_ = <?php echo ($params['sample_id']); ?>;

var to_print_ = <?php echo ($params['to_print']); ?>;
if(to_print_ == 1){
	var url_ = '/sample/print_sample/sample_id/'+sample_id_;
	window.open(url_);
}
// end
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