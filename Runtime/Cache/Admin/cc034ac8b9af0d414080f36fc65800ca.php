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
    <li><a href="<?php echo U('order/index');?>">订单列表 </a></li>
    <li class="current"><a href="">详情 </a></li>
    </ul>
</div>
<div class="margin10px">
	<form name="form1" method="post" action="<?php echo U('order/edit');?>" onsubmit="return check();">
        <table class="mytable">
            <tr>
                <th colspan="2">订单信息</th>
            </tr>
            
            <tr>
            	<td width="100" class="tdf">订单号</td>
            	<td> 
            		<?php echo ($info['order_sn']); ?>
            	</td>
            </tr>
            
			<tr>
                <td width="100" class="tdf">下单人：</td>
				<td> 
				    <?php echo ($info['user_name']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">下单时间：</td>
				<td> 
				    <?php echo ($info['add_ts']); ?>
                </td>
            </tr>
            <tr>
            	<td width="100" class="tdf">套餐名：</td>
				<td> 
				    <?php echo ($info['goods_name']); ?>
                </td>
            </tr>
			<tr>
                <td width="100" class="tdf">检测数量(个)：</td>
				<td> 
				    <?php echo ($info['goods_num']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">总价格(元)：</td>
				<td> 
				    <?php echo ($info['total_price']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">支付状态：</td>
				<td> 
				    <?php echo ($info['pay_status_name']); ?>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">订单状态：</td>
				<td> 
				    <?php echo ($info['order_status_name']); ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">联系人信息</th>
            </tr>
            <tr>
                <td width="100" class="tdf">联系人：</td>
				<td> 
				    <input type="text" id="contact_name" name="contact_name" value="<?php echo ($info['contact_name']); ?>" size="40"  /><span></span>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">联系电话：</td>
				<td> 
				    <input type="text" id="tel" name="tel" value="<?php echo ($info['tel']); ?>" size="40"  /><span></span>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">手机号码：</td>
				<td> 
				    <input type="text" id="phone" name="phone" value="<?php echo ($info['phone']); ?>" size="40"  /><span></span>
                </td>
            </tr>
            <tr>
                <td width="100" class="tdf">采样地址：</td>
				<td> 
				        省:<select name="province_id" id="J_province" width="180" ></select>
				        市：<select   name="city_id" id="J_city" width="180" ></select>
				        区：<select   name="district_id" id="J_district" width="180" ></select>
				        乡镇：<select   name="community_id" id="J_community" width="180" ></select>
				        详细地址：<input type="text" name="address" id="address" class="search-input" style="width:220px;" value="<?php echo ($info['address']); ?>" >
                </td>
            </tr>
            <input type="hidden" name="pay_status" value="<?php echo ($info['pay_status']); ?>" />
            <input type="hidden" name="order_id" value="<?php echo ($info['order_id']); ?>" />
            <tr>
                <td class="tdf">&nbsp;</td>
                <td>
                    <input type="submit" name="formsubmit" value="确认订单" class="button" />
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
	var pid=<?php if($info['province_id'] != ''): echo ($info['province_id']); else: ?>0<?php endif; ?>;  //默认省份id
	var cid=<?php if($info['city_id'] != ''): echo ($info['city_id']); else: ?>0<?php endif; ?>;  //默认城市id
	var did=<?php if($info['district_id'] != ''): echo ($info['district_id']); else: ?>0<?php endif; ?>;  //默认区县市id
	var coid=<?php if($info['community_id'] != ''): echo ($info['community_id']); else: ?>0<?php endif; ?>;  //默认乡镇id
    function change_province(pid){
            $.post("<?php echo U('/area/getProvince');?>", {pid: pid}, function(result){
                $("#J_province").html(result);
            });
        }
    function change_city(p_pid,p_cid){
        $.post('<?php echo U("/area/getCity");?>', {pid: p_pid, cid: p_cid}, function(result){
            $("#J_city").show().html(result);
        });
        var cid_g=$(this).children('option:selected').val();
//        change_district(cid_g)
    }
    function change_district(p_cid,p_did){
        $.post('<?php echo U("/area/getDistrict");?>', {cid: p_cid, did: p_did}, function(result){
            $("#J_district").show().html(result);
        });
        var did_g=$(this).children('option:selected').val();
//        change_community(did_g)
    }
	function change_community(p_did,p_coid){
        $.post('<?php echo U("/area/getCommunity");?>', {did: p_did, coid: p_coid}, function(result){
            $("#J_community").show().html(result);
        });
    }
    change_province(pid);
    change_city(pid,cid);
    change_district(cid,did);
    change_community(did,coid);

	$('#J_province').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g)
	});
	$('#J_city').change(function(){
		var cid_g=$(this).children('option:selected').val();
		change_district(cid_g)
	});
	$('#J_district').change(function(){
		var did_g=$(this).children('option:selected').val();
	    change_community(did_g)
	});
});

function check(){
	var contact_name_ = $.trim($('#contact_name').val());
	var phone_ = $.trim($('#phone').val());
	var tel_ = $.trim($('#tel').val());
	var j_province_ = $('#J_province').val();
	var j_city_ = $('#J_city').val();
	var j_district_ = $('#J_district').val();
	var j_community_ = $('#J_community').val();
	var address_ = $.trim($('#address').val());

	var pay_status_ = $('#pay_status').val();

	if(pay_status_ == 1){
		alert('订单还未支付，不可确认订单');
		return false;
	}

	if (contact_name_ == '') {
        $('#contact_name').css('background-color','#ffc');
        $('#contact_name').next('span').html('<font color=red>请填写联系人</font>');
        $('#contact_name').focus();
        return false;
    }
	if (tel_ == '') {
        $('#tel').css('background-color','#ffc');
        $('#tel').next('span').html('<font color=red>请填写联系电话</font>');
        $('#tel').focus();
        return false;
    }
	if (phone_ == '') {
        $('#phone').css('background-color','#ffc');
        $('#phone').next('span').html('<font color=red>请填写手机号码</font>');
        $('#phone').focus();
        return false;
    }
	
	if(j_province_ == ''){
		alert('请选择省份');
		return false;
	}
	if(j_city_ == ''){
		alert('请选择城市');
		return false;
	}
	if(j_district_ == ''){
		alert('请选择地区');
		return false;
	}
	if(j_community_ == ''){
		alert('请选择镇乡');
		return false;
	}
	if(address_ == ''){
		alert('请填写详细联系人地址');
		return false;
	}
	return true;
}
</script>