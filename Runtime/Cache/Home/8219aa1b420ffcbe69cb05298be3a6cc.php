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

<script src="/javascript/member.js" type="text/javascript"></script>

<!--banner开始-->
	<div class="banner1">
	</div>
	<!--banner结束-->

	<!--内容区开始-->
		<div class="l_main">
			<div class="main_cont clear">
				<div class="content">
					<!--左边导航开始-->
								<!--左侧栏开始-->
			<div class="left">
						<div class="title"><img src="/images/www/cy_title.gif"/></div>
						<div class="middle">
							<div class="m_c">
								<ul>
									<li [l1]><a href="<?php echo U('/member/security');?>">账户信息</a></li>
									<li class="current"><a href="<?php echo U('/member/info');?>">基本资料</a></li>
									<li [l3]><a href="<?php echo U('/member/address');?>">采样地址</a></li>
									<li [l4]><a href="<?php echo U('/member/contact');?>">我的联系人</a></li>
								</ul>
							</div>
						</div>
						<div class="tel">
							<p class="text">联系我们</p>
							<p class="t_phone">400-800-8888</p>
						</div>
					</div>
			
			<!--左侧栏结束-->
					<!--左边导航结束-->
					
					<!--右边内容开始-->
					<div class="right">
						<!--标题开始-->
						<div class="title">
							<div class="decn">B</div>
							<div class="bt">
								<p>基本资料</p>
								<span>asic data</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/member/security');?>">个人中心</a> | <a href="" class="current">基本资料</a></p>
						</div>
						<!--标题结束-->

						<form  action="<?php echo U('/member/info');?>" method="post" onsubmit="return checkInfoForm();">
							<ul class="wrap clear">
								<li>
									<span class="w_1">姓名</span>
									<div class="w_2">
										<input type="text" id="real_name" name="real_name" value="<?php echo ($info['real_name']); ?>" class="txt"/>
									</div>
									<div id="tip_real_name">
									</div>
								</li>
								<li>
									<span class="w_1">性别</span>
									<div class="w_2">
										<input type="radio" name="sex" value="1" class="radio" <?php if($info['sex'] == '1'): ?>checked="checked"<?php endif; ?> />男
										<input type="radio" name="sex" value="2" class="radio woman" <?php if($info['sex'] == '2'): ?>checked="checked"<?php endif; ?> />女
									</div>
								</li>
								<li>
									<span class="w_1">生日</span>
									<div class="w_2">
										<select class="se" name="byear" id="byear"><?php echo ($year); ?></select>年&nbsp;
										<select class="se" name="bmonth" id="bmonth"><?php echo ($month); ?></select>月&nbsp;
										<select class="se" name="bday" id="bday"><?php echo ($day); ?></select>日
									</div>
									<div id="tip_birthday"></div>
								</li>
								<li>
									<span class="w_1">出生地</span>
									<div class="w_2">
										<select class="se" name="province_id" id="J_province" ></select>省&nbsp;
										<select class="se" name="city_id" id="J_city"></select>市
									</div>
									<div id="tip_address"></div>
								</li>
							</ul>
							<div class="button_mld btn_bc clear">
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

    function change_province(pid){
        $.post("<?php echo U('/member/getArea/area/province');?>", {pid: pid}, function(result){
                $("#J_province").html(result);
            });
        }
    function change_city(p_pid,p_cid){
        $.post('<?php echo U("/member/getArea/area/city");?>', {pid: p_pid, cid: p_cid}, function(result){
            $("#J_city").show().html(result);
        });
        var cid_g=$(this).children('option:selected').val();
    }

    change_province(pid);
    change_city(pid,cid);

	$('#J_province').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g)
	});
});

</script>
 


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>