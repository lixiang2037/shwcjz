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
				<a href="<?php echo U('/order/gene');?>" [t3]>我的检索</a>
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
	<link rel="stylesheet" href="/style/internal.css" type="text/css"/>
	<script type="text/javascript" src="/javascript/checkform.js"></script>
	<!--banner开始-->
	<div class="banner1">
	</div>
	<!--banner结束-->

<!--内容区开始-->
		<div class="l_main">
			<div class="main_cont clear">
				<div class="content">
				
								<!--左侧栏开始-->
			<div class="left">
						<div class="title"><img src="/images/www/cy_title.gif"/></div>
						<div class="middle">
							<div class="m_c">
								<ul>
									<li [l1]><a href="<?php echo U('/member/security');?>">账户信息</a></li>
									<li [l2]><a href="<?php echo U('/member/info');?>">基本资料</a></li>
									<li [l3]><a href="<?php echo U('/member/address');?>">采样地址</a></li>
									<li class="current"><a href="<?php echo U('/member/contact');?>">我的联系人</a></li>
								</ul>
							</div>
						</div>
						<div class="tel">
							<p class="text">联系我们</p>
							<p class="t_phone">400-800-8888</p>
						</div>
					</div>
			
			<!--左侧栏结束-->
					
					<!--右边内容开始-->
					
					<div class="right">
						<!--标题开始-->
						<div class="title">
							<div class="decn">M</div>
							<div class="bt">
								<p>我的联系人</p>
								<span>y contact person</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/member/security');?>">个人中心</a>  | <a href="" class="current">我的联系人</a></p>
						</div>
						<!--标题结束-->
						
							<form  action="<?php echo U('/member/edit_contact');?>" method="post" onsubmit="return checkForm();">
								<ul class="wrap clear">
									<li>
										<span class="w_1">联系人</span>
										<div class="w_2">
											<input type="text" id="contact_name" name="contact_name" value="<?php echo ($info['contact_name']); ?>" class="txt"/>
										</div>
										<div class="tip clear" id="tip_contact_name"></div>
									</li>
									<li>
										<span class="w_1">身份证</span>
										<div class="w_2">
											<input type="text" id="id_num" name="id_num" value="<?php echo ($info['id_num']); ?>" class="txt"/>
										</div>
										<div class="tip clear" id="tip_id_num"></div>
									</li>
									<li>
										<span class="w_1">E-mail</span>
										<div class="w_2">
											<input type="text" id="email" name="email" value="<?php echo ($info['email']); ?>" class="txt"/>
										</div>
										<div class="tip clear" id="tip_email"></div>
									</li>
									<li>
										<span class="w_1">QQ</span>
										<div class="w_2">
											<input type="text" id="qq" name="qq" value="<?php echo ($info['qq']); ?>" class="txt" onkeyup="value=this.value.replace(/\D+/g,'')" maxlength="11" />
										</div>
										<div class="tip clear" id="tip_qq"></div>
									</li>
									<li>
										<span class="w_1">手机号码</span>
										<div class="w_2">
											<input type="text" id="phone" name="phone" value="<?php echo ($info['phone']); ?>" class="txt" onkeyup="value=this.value.replace(/\D+/g,'')"maxlength="11" min="11" />
										</div>
										<div class="tip clear" id="tip_phone"></div>
									</li>
									<li>
										<span class="w_1">电话</span>
										<div class="w_2">
											<input type="text" id="tel1" name="tel1" value="<?php echo ($info['tel1']); ?>" class="ti" maxlength="3" min="3"onkeyup="value=this.value.replace(/\D+/g,'')"/>
											<i>—</i>
											<input type="text" id="tel2" name="tel2" value="<?php echo ($info['tel2']); ?>" class="ti" maxlength="8" min="8" onkeyup="value=this.value.replace(/\D+/g,'')"/>
											<i>—</i>
											<input type="text" id="tel3" name="tel3" value="<?php echo ($info['tel3']); ?>" class="ti" maxlength="4" onkeyup="value=this.value.replace(/\D+/g,'')"/>
										</div>
										<div class="tip clear" id="tip_tel"></div>
									</li>
									<li>
										<span class="w_1">地址</span>
										<div class="w_2">
											<select  name="province_id" id="J_province" ></select>&nbsp;
											<select  name="city_id" id="J_city"></select>&nbsp;
											<select  name="district_id" id="J_district"></select>&nbsp;
											<select  name="community_id" id="J_community"></select>
										</div>
									</li>
									<li>
										<span class="w_1"></span>
										<div class="w_2">
											<input type="text" name="address" id="address" value="<?php echo ($info['address']); ?>" class="txt address"/>
										</div>
										<div class="tip clear" id="tip_address"></div>
									</li>
								</ul>
								<input type="hidden" name="contact_id" value="<?php echo ($info['contact_id']); ?>" />
								<div class="button_mld btn_person clear">
									<input type="submit" value="保存" />
								</div>
							</form>
						</div>
						
					<!--右边内容结束-->
				</div>
			</div>
		</div>
	<!--内容区结束-->

<script type="text/javascript">

$(function(){
	var pid=<?php if($info['province_id'] != ''): echo ($info['province_id']); else: ?>0<?php endif; ?>;  // 默认省份id
	var cid=<?php if($info['city_id'] != ''): echo ($info['city_id']); else: ?>0<?php endif; ?>;  // 默认城市id
	var did=<?php if($info['district_id'] != ''): echo ($info['district_id']); else: ?>0<?php endif; ?>;  // 默认地区id
	var tid=<?php if($info['community_id'] != ''): echo ($info['community_id']); else: ?>0<?php endif; ?>;  // 默认镇乡id

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
});

// function checkForm(){
// 	var contact_name_ = $.trim($('#contact_name').val());
// 	var id_num_ = $.trim($('#id_num').val());
// 	var email_ = $.trim($('#email').val());
// 	var check_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
// 	var phone_ = $.trim($('#phone').val());
// 	var tel1_ = $.trim($('#tel1').val());
// 	var tel2_ = $.trim($('#tel2').val());
// 	var tel3_ = $.trim($('#tel3').val());
// 	var tel = tel1_.length +tel2_.length;
// 	var qq = $.trim($('#qq').val());
	
// 	if(contact_name_ == ''){
// 		alert('请填写联系人名称');
// 		return false;
// 	}else if(!/^([\u4e00-\u9fa5]){2,5}$/.test(contact_name_)){
// 			alert('输入的姓名不符合标准');
// 			return false;
// 		}

// 	//验证邮箱
// 	if(!email_==''){
// 		if(!check_email.exec(email_)){
// 			alert('邮箱格式不正确');
// 			return false;
// 		}
// 	}
	
// 	//验证qq
// 	if(!qq.length==''){
// 		if(qq.length < 4){
// 			alert('QQ账号输入有误');
// 			return false;
// 		}
// 	}
	

// 	//验证身份证
// 	if($.trim($('#id_num').val()) == ''){
// 		alert('请填写身份证号码');
// 		return false;
// 	}else if($.trim($('#id_num').val()).length <18){
// 		alert('身份证数位不正确，请重新输入');
// 		return false;
// 	}
// 	// 验证手机和电话
// 	if(phone_ == ''){
// 		if(tel1_=='' || tel2_ == ''){
// 			alert('手机和电话至少填写一项');
// 			return false;
// 		}
// 	}
// 	if(phone_.length >0 && phone_.length != 11){
// 		alert('手机格式不对');
// 		return false;
// 	}
// 	if(tel > 0 && tel != 11){
// 		alert('电话格式不对');
// 		return false;
// 	}
	
// 	//验证城市
// 	if(!$('#J_province').val() == '' || !$.trim($('#address').val()) == ''){
// 		if($('#J_city').val() == '' || $('#J_district').val() == ''){
// 			alert('地址选择错误！请重新选择');
// 			return false;
// 		}else if($('#J_community option').length-1 > 0 && $('#J_community').val()=='' ){
// 			alert('地址选择错误！请选择街道');
// 			return false;
// 		}else if($.trim($('#address').val()) == ''){
// 			alert('请填写门牌号');
// 			return false;
// 		}
// 	}

// 	return true;
// }

</script>



	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>