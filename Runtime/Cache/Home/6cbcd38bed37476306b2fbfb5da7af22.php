<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--声明当前页面的编码格式 国际编码 UTF-8  中文编码 GBK-->
	<meta charset="utf-8">
	<!--声明当前页面的三要素-->
	<title><?php if(!empty($page_title)): echo ($page_title); else: ?> <?php echo C(PAGE_TITLE); endif; ?></title>
	<meta name="keywords" content="<?php if(!empty($page_keywords)): echo ($page_keywords); else: echo C(PAGE_KEYWORD); endif; ?>"/>
	<meta name="description" content="<?php if(!empty($page_description)): echo ($page_description); else: echo C(PAGE_DESCRIPTION); endif; ?>" />
	<!--样式css-->
	<link rel="stylesheet" href="/style/global.css" type="text/css"/>
	
	<script type="text/javascript" src="/javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/javascript/ad.js"></script>
</head>	
<body>

	<?php  $is_login = 'N'; if(is_user_login() !== 0) { $is_login = 'Y'; } $user_name = get_show_name(); ?>

	<!--整体页面头部开始-->
	<div class="header">
		<!--头部开始-->
		<div class="h_top">
			<!--logo-->
			<div class="logo">
				<a href="/"><img src="/images/global/logo_.png"/></a>
			</div>
			<!--nav-->
			<div class="nav">
				<a href="/" [t1]>首页</a>
				<a href="<?php echo U('/index/about');?>" [t2]>关于我们</a>
				<a href="<?php echo U('/order/gene');?>" class="current">我的检索</a>
				<a href="<?php echo U('/service/index');?>" [t4]>客户服务</a>
			</div>
			<?php if($is_login == 'Y'): ?><div class="user">
				欢迎您，<a href="<?php echo U('/member/security');?>"><?php echo ($user_name); ?></a>
			</div>
			
			<div class="text">
				<a href="javascript:logout();">退出</a>
			</div>
			<?php else: ?>
			<!--登录\注册-->
			<div class="login">
				<a href="javascript:login();">登录</a>
				<a href="javascript:regist();" class="hover" >注册</a>
			</div><?php endif; ?>
			
		</div>
		<!--头部结束-->
	</div>
	<!--整体页面头部结束-->

<script type="text/javascript">

function login()
{
	location.href = "<?php echo C(WWW_GK_COM);?>/user/login?return_url="+this.location.href;
}
function regist()
{
	location.href = "<?php echo C(WWW_GK_COM);?>/user/m_register?return_url="+this.location.href;
}
function logout(){
	location.href = "<?php echo C(WWW_GK_COM);?>/user/logout?return_url="+this.location.href;
}

</script>
	<script src="/javascript/showDialog.js" type="text/javascript"></script>
	<link href="/style/layer.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/style/internal.css" type="text/css"/>
	
	<!--banner开始-->
	<div class="banner2">
	</div>
	<!--banner结束-->

	<!--内容区开始-->
	<div class="l_main">
		<div class="main_cont clear">
			<div class="content">
				<!--左边导航开始-->
							<div class="left">
				<div class="title"><img src="/images/www/js_title.gif"/></div>
				<div class="middle">
					<div class="m_c">
						<ul>
							<li [l1]><a href="<?php echo U('/gene/gene_file');?>">提交基因信息</a></li>
							<li class="current"><a href="<?php echo U('/order/goods');?>">申请基因检测</a></li>
							<li [l3]><a href="<?php echo U('/order/gene');?>">我的订单</a></li>
							<li [l4]><a href="<?php echo U('/gene/result');?>">我的检索单</a></li>
						</ul>
					</div>
				</div>
				<div class="tel">
					<p class="text">联系我们</p>
					<p class="t_phone">400-800-8888</p>
				</div>
			</div>

				<!--左边导航结束-->
				<!--右边内容开始-->
				<div class="right">
					<!--标题开始-->
					<div class="title">
						<div class="decn">G</div>
							<div class="bt">
								<p>申请基因检测</p>
								<span>ene detection</span>
							</div>
						<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> |<a href="<?php echo U('/order/gene');?>">我的检索</a> |<a href="" class="current">申请基因检测</a></p>
					</div>
					<!--标题结束-->
					<div class="wrap_jc">
						<!--  
						<div class="top_one">
							<div class="tit">检测套餐说明</div>
						</div>	
						<div class="text">
							美吉亲子基因检测套餐是美吉生物科技实验室采用全球顶尖技术，通过国际一流的DNA鉴定设备，对采集到的合格样本进行DNA检测...  
						</div>
						<div class="see"><a href="<?php echo U('/service/introduce');?>" target="_blank">查看详情</a></div>
						-->
						<div class="top_one">
							<div class="tit">确认订单信息</div>
						</div>	
						
						<div class="form">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<th class="first">商品信息</th>
									<th>单价</th>
									<th>数量</th>
									<th>金额</th>
								</tr>
								<tr>
									<td class="first"><?php echo ($goods['goods_name']); ?></td>
									<td>￥<span id="b_price"><?php echo ($goods['goods_price']); ?></span></td>
									<td>
									 <a href="javascript:void(0)" onclick="less_num();" >-</a>
									   <span><input type="text" name="p_num" id="p_num" value="1" style="width:30px;" /></span>
									   <a href="javascript:void(0)" onclick="add_num();" class="rt" >+</a>
									</td>
									<td>￥<span id="p_price"><?php echo ($goods['goods_price']); ?></span>元</td>
								</tr>
							</table>
						</div>
						
						<div class="button_mld ado clear">
							<a href="javascript:void(0);" onclick="to_add_person();" >添加</a>
						</div>
						
						<!--填写个人信息开始-->
						<form id="p_person_" action="<?php echo U('/order/add_person');?>" method="post" >
						<div id="person_info_add" class="data" style="display:none;">
							<div class="personal clear" >
								<div class="top_tit clear">
									<h3>填写个人信息</h3>
								</div>
								<div class="tet">
									<p><span>姓名</span><input type="text" name="person_name" id="person_name" class="wb"/></p>
									<p><span>性别</span>
										<input type="radio" value="1" name="sex" checked />男
										<input type="radio" value="2" name="sex" />女
									</p>
									<p><span>生日</span>
										<select style="width:100px;" name="byear" id="byear"><?php echo ($year); ?></select>年&nbsp;
										<select style="width:100px;" name="bmonth" id="bmonth"><?php echo ($month); ?></select>月&nbsp;
										<select style="width:100px;" name="bday" id="bday"><?php echo ($day); ?></select>日
									</p>
									<p><span>身份证</span><input type="text" name="id_num" id="id_num" class="wb"/></p>
									<p><span>出生地</span>
										<select style="width:100px;" name="province_id1" id="J_province1" ></select>&nbsp;
										<select style="width:100px;" name="city_id1" id="J_city1"></select>&nbsp;
										<select style="width:100px;" name="district_id1" id="J_district1"></select>&nbsp;
										<select style="width:100px;" name="community_id1" id="J_community1"></select>
									</p>
									<p>
										<span></span>
										<input type="text" name="address1" id="address1"  class="wb"/>
									</p>
									
								</div>
								<div class="top_tit">
									<h3>填写联系人信息</h3>
								</div>
								<div class="tet">
									<p><span>联系人</span>
										<span id="sel_contact_id">
											<select style="width:100px;" name="contact_id" id="contact_id">
												<option value="">--请选择--</option>
												<?php if(is_array($search_option["contacts"])): $k = 0; $__LIST__ = $search_option["contacts"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$contact_): $mod = ($k % 2 );++$k;?><option value="<?php echo ($contact_['contact_id']); ?>" ><?php echo ($contact_['contact_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</span>
										<span>关系</span>
										<select style="width:100px;" name="contact_type" id="contact_type">
											<option value="">--请选择--</option>
											<?php if(is_array($search_option["contact_type"])): $k = 0; $__LIST__ = $search_option["contact_type"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type_): $mod = ($k % 2 );++$k;?><option value="<?php echo ($type_['id']); ?>" <?php if($type_['id'] == 4): ?>selected="selected"<?php endif; ?> ><?php echo ($type_['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
						
									</p>
								</div>
								<div class="person">
									<a href="javascript:void(0);" onclick="showWindow('添加联系人','<?php echo U('/member/add_check_contact');?>',600)">
										<img src="/images/www/icon_lxr.png"  width="40px" height="40px"/>添加联系人
									</a>
								</div>	
								<div class="button_mld btn">
									<input type="button" class="tj" onclick="add_order_person();"  value="添加"/>
								</div>
							</div>
						</div>
						</form>
						<!--填写个人信息结束-->
						
						<form  action="<?php echo U('/order/apply');?>" border='1px;' method="post" onsubmit="return checkForm();">
						
						<div class="bm_h">
							<table id="person_list"  cellspacing="0" cellpadding="0" width="100%" >
								<?php if(!empty($persons)): if(is_array($persons)): $k = 0; $__LIST__ = $persons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$per): $mod = ($k % 2 );++$k;?><tr >
												<td><?php echo ($per['person_name']); ?><input type="hidden" name="person_id_<?php echo ($k); ?>" value="<?php echo ($per['person_id']); ?>" /></td>
												<td><?php if($per['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
												<td><?php echo ($per['byear']); ?>-<?php echo ($per['bmonth']); ?>-<?php echo ($per['bday']); ?></td>
												<td width="70" style="text-align:center;"><a href="javascript:void(0)" onclick="delete_check_person(<?php echo ($per['person_id']); ?>);" >删除</a></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									<input type="hidden" name="check_nums" id="check_nums" value="<?php echo ($persons_count); ?>" />
								<?php else: ?>
									<tr>
										<td colspan="4">检测人为空!</td>
										<input type="hidden" name="check_nums" id="check_nums" value="0" />
									</tr><?php endif; ?>
								
							</table>
						</div>
						
						<input type="hidden" name="goods_id" id="goods_id" value="<?php echo ($goods['goods_id']); ?>" />
						<input type="hidden" name="goods_num" id="goods_num" />
						<!--填写采样地址开始-->
						<div class="top_one">
							<div class="tit">确认采样地址</div>
							<span>请填写正确的收件信息，以便及时收取我们提供的采集盒 </span>
						</div>
						<div class="data">
							<div class="tet">
							<p>
								<span>联系人</span>
								<input type="text" name="contact_name" id="contact_name" class="wb"/>
								&nbsp;&nbsp;&nbsp;
								<a href="javascript:void(0)" onclick="clear_address();" >清除</a>
							</p>
							<p>
							<span>手机</span>
							<input type="text" name="phone" id="phone" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" class="wb"/>
							</p>
							<p>
							<span>电话</span>
							<input type="text" name="tel1" id="tel1" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" class="tel"/><i>—</i>
							<input type="text" name="tel2" id="tel2" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" class="tel"/><i>—</i>
							<input type="text" name="tel3" id="tel3" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" class="tel"/>
							</p>
							<p>
							<span>地址</span>
							<select class="se" name="province_id" id="J_province" ></select>
							<select class="se" name="city_id" id="J_city"></select>
							<select class="se" name="district_id" id="J_district"></select>
							<select class="se" name="community_id" id="J_community"></select>
							</p>
							<p>
								<span></span>
								<input type="text" name="address" id="address" class="wb" />
							</p>
							<?php if(!empty($address_infos)): ?><p>
								<span>历史地址</span>
							</p>
							<?php if(is_array($address_infos)): $i = 0; $__LIST__ = $address_infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($i % 2 );++$i;?><p class="tr">
									<span></span>
									<input type="radio" id="h_address_<?php echo ($address['address_id']); ?>" name="h_address" value="<?php echo ($address['address_id']); ?>" onclick="set_address(<?php echo ($address['address_id']); ?>)"  />&nbsp;&nbsp;<?php echo ($address['address_info']); ?>(<?php echo ($address['contact_name']); ?>)--<?php echo ($address['phone']); ?>
									<input type="hidden" id="province_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['province_id']); ?>" />
									<input type="hidden" id="city_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['city_id']); ?>" />
									<input type="hidden" id="district_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['district_id']); ?>" />
									<input type="hidden" id="community_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['community_id']); ?>" />
									<input type="hidden" id="address_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['address']); ?>" />
									
									<input type="hidden" id="contact_name_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['contact_name']); ?>">
									<input type="hidden" id="phone_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['phone']); ?>">
									<input type="hidden" id="tel1_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['tel1']); ?>">
									<input type="hidden" id="tel2_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['tel2']); ?>">
									<input type="hidden" id="tel3_<?php echo ($address['address_id']); ?>" value="<?php echo ($address['tel3']); ?>">
								</p><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php else: endif; ?>	
							
							</div>
						</div>
						<div class="button_mld sub">
							<input type="submit" class="tj" value="提交订单"/>
						</div>
						</form>
						<!--填写采样地址结束-->
					</div>
				<!--右边内容结束-->
			</div>
		</div>
	</div>
	</div>
	<!--内容区结束-->

<script type="text/javascript">
function change_province(pid){
    $.post("<?php echo U('/member/getArea/area/province');?>", {pid: pid}, function(result){
            $("#J_province").html(result);
        });
    }
function change_city(p_pid, p_cid){
    $.post('<?php echo U("/member/getArea/area/city");?>', {pid: p_pid, cid: p_cid}, function(result){
        $("#J_city").show().html(result);
    });
}
function change_district(p_cid, p_did){
	$.post('<?php echo U("/member/getArea/area/district");?>', {cid: p_cid, did:p_did}, function(result){
        $("#J_district").show().html(result);
    });
}
function change_community(p_did, p_tid){
	$.post('<?php echo U("/member/getArea/area/community");?>', {did:p_did, tid:p_tid}, function(result){
        $("#J_community").show().html(result);
    });
}

// 添加检测人***
function change_province1(pid){
    $.post("<?php echo U('/member/getArea/area/province');?>", {pid: pid}, function(result){
            $("#J_province1").html(result);
        });
    }
function change_city1(p_pid, p_cid){
    $.post('<?php echo U("/member/getArea/area/city");?>', {pid: p_pid, cid: p_cid}, function(result){
        $("#J_city1").show().html(result);
    });
}
function change_district1(p_cid, p_did){
	$.post('<?php echo U("/member/getArea/area/district");?>', {cid: p_cid, did:p_did}, function(result){
        $("#J_district1").show().html(result);
    });
}
function change_community1(p_did, p_tid){
	$.post('<?php echo U("/member/getArea/area/community");?>', {did:p_did, tid:p_tid}, function(result){
        $("#J_community1").show().html(result);
    });
}

$(function(){
	$('#p_num').val(1);
	clear_address();
	var pid=0;  // 默认省份id
	var cid=0;  // 默认城市id
	var did=0;  // 默认地区id
	var tid=0;  // 默认镇乡id

    change_province(pid);
    change_city(pid,cid);
    change_district(cid,did);
    change_community(did,tid);

	$('#J_province').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g);
	});

	$('#J_city').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_district(pid_g);
	});
	$('#J_district').change(function(){
		var did_g=$(this).children('option:selected').val();
		change_community(did_g );
	});

	change_province1(pid);
    change_city1(pid,cid);
    change_district1(cid,did);
    change_community1(did,tid);
	// 添加检测人***
	$('#J_province1').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city1(pid_g);
	});

	$('#J_city1').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_district1(pid_g);
	});
	$('#J_district1').change(function(){
		var did_g=$(this).children('option:selected').val();
		change_community1(did_g );
	});
});

function add_num(){
	var b_price = $('#b_price').html();
	var p_num = parseInt($('#p_num').val());
	if(p_num == 10){
		alert('每个订单检测数量不可超过10，请确认');
		return false;
	}
	p_num = p_num+1;
	$('#p_num').val(p_num);
	$('#p_price').html(b_price*p_num);
}

function less_num(){
	var b_price = $('#b_price').html();
	var p_num = parseInt($('#p_num').val());
	if(p_num == 1){
		alert('每个订单单检测数量不可小于1，请确认');
		return false;
	}
	p_num = p_num-1;
	$('#p_num').val(p_num);
	$('#p_price').html(b_price*p_num);
}

function clear_address(){
	$('input').removeAttr("readonly");
    $("#J_province").removeAttr("disabled"); 
    $("#J_city").removeAttr("disabled");
    $("#J_district").removeAttr("disabled");
    $("#J_community").removeAttr("disabled"); 

    $("input:radio[name='h_address']").attr("checked",false);

    $('#contact_name').val('');
    $('#phone').val('');
    $('#tel1').val('');
    $('#tel2').val('');
    $('#tel3').val('');
    change_province(0);
    change_city(0,0);
    change_district(0,0);
    change_community(0,0);
    $('#address').val('');
}

function set_address(address_id){
	var pid = $('#province_'+address_id).val();
	var cid = $('#city_'+address_id).val();
	var did = $('#district_'+address_id).val();
	var tid = $('#community_'+address_id).val();
	change_province(pid);
	change_city(pid,cid);
    change_district(cid,did);
    change_community(did,tid);
    $('#address').val($('#address_'+address_id).val());

    $('#contact_name').val($('#contact_name_'+address_id).val());
    $('#phone').val($('#phone_'+address_id).val());
    $('#tel1').val($('#tel1_'+address_id).val());
    $('#tel2').val($('#tel2_'+address_id).val());
    $('#tel3').val($('#tel3_'+address_id).val());

//    $('input').attr("readonly","readonly");
	$('#contact_name').attr("readonly","readonly");
	$('#phone').attr("readonly","readonly");
	$('#tel1').attr("readonly","readonly");
	$('#tel2').attr("readonly","readonly");
	$('#tel3').attr("readonly","readonly");
	$('#address').attr("readonly","readonly");
	
    $("#J_province").attr("disabled",true); 
    $("#J_city").attr("disabled",true);
    $("#J_district").attr("disabled",true);
    $("#J_community").attr("disabled",true); 

}

function checkForm(){
	var contact_name_ = $.trim($('#contact_name').val());
	var phone_ = $.trim($('#phone').val());
	var j_province_ = $('#J_province').val();
	var j_city_ = $('#J_city').val();
	var j_district_ = $('#J_district').val();
	var j_community_ = $('#J_community').val();
	var address_ = $.trim($('#address').val());
	
	//验证姓名
	if(contact_name_ == ''){
		alert('请填写联系人名称');
		return false;
	}else if(!contact_name_ == ''  && !/^([\u4e00-\u9fa5]){2,5}$/.test(contact_name_)){
			alert('请填写正确的中文姓名');
			return false;
		}
	// 验证手机和电话
	if(phone_ == ''){
		if($.trim($('#tel1').val())=='' && $.trim($('#tel2').val())==''){
			alert('手机和电话至少填写一项');
			return false;
		}else if(!$.trim($('#tel1').val())=='' && $.trim($('#tel1').val()).length != 3){
			alert('请填写正确的区号');
			return false;
		}else if(!$.trim($('#tel1').val()) == '' && $.trim($('#tel2').val()) == ''){
			alert('请填写正确的电话号码');
			return false;
		}else if(!$.trim($('#tel2').val()) == '' && $.trim($('#tel2').val()).length < 7 ){
			alert('请填写7至8位数的电话号码');
			return false;
		}else if(!$.trim($('#tel2').val()) == '' && $.trim($('#tel1').val()) == '' ){
			alert('请填写区号');
			return false;
		}else if(!$.trim($('#tel3').val()) == '' && $.trim($('#tel3').val()).length > 4){
			alert('请填写1至4位数的区号');
			return false;
		}
	}else if(!phone_ ==''){
		if(phone_.length >0 && phone_.length != 11){
			alert('请填写正确的手机号');
			return false;
		}
	}
	if(j_province_ == ''){
		alert('请选择联系地址');
		return false;
	}

	//验证城市

	if(!$('#J_province').val() == '' || !$.trim($('#address').val()) == ''){
		if($('#J_city').val() == '' || $('#J_district').val() == ''){
			alert("请选择正确的城市和州县");
			return false;
		}else if($('#J_community option').length-1 > 0 && $('#J_community').val()=='' ){
			alert("请选择正确的乡镇");
			return false;
		}else if($.trim($('#address').val()) == ''){
			alert("请填写门牌号");
			return false;
		}
	}
	
	var check_nums = $('#check_nums').val();
	var goods_num = $('#p_num').val();
	$('#goods_num').val(goods_num);
	if(check_nums > goods_num){
		var c_num = check_nums-goods_num;
		alert('检测人比套餐数量多'+c_num+'人，请确认!');
		return false;
	}else if(goods_num > check_nums){
		var g_num = goods_num - check_nums;
		alert('还需要添加'+g_num+'个检测人，请确认!');
		return false;
	}
	
	return true;
}

// 切换添加检测人表单
function to_add_person(){
	if($('#person_info_add').css("display") == 'none'){
		$('#person_info_add').css('display','block');
	}else{
		$('#person_info_add').css('display','none');
	}
}

// 添加订单检测人
function add_order_person(){
	if($('#person_name').val() == ''){
		alert('检测人名称不能为空');
		return false
	}

	// 异步添加检测人
	$.ajax({
		url : '/member/ajax_add_person',
		data : $('#p_person_').serialize(),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#person_list').html(msg.message);
			} else {
				alert(msg.message);
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

function delete_check_person(person_id){
	$.ajax({
		url : '/member/ajax_delete_person',
		data : {person_id: person_id},
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#person_list').html(msg.message);
			} else {
				alert(msg.message);
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

</script>	
	


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>