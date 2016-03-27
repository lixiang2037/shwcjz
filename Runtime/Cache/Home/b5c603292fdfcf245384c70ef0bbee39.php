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
									<li class="current"><a href="<?php echo U('/member/security');?>">账户信息</a></li>
									<li [l2]><a href="<?php echo U('/member/info');?>">基本资料</a></li>
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
							<div class="decn">A</div>
							<div class="bt">
								<p>账户信息</p>
								<span>ccount infrmation</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/member/security');?>">个人中心</a>  | <a href="" class="current">账户信息</a></p>
						</div>
						<!--标题结束-->

						<!--验证步骤开始-->
						<ul class="tab">
							<li class="active"><i><img src="/images/www/icon_yz.png"/></i>验证身份</li>
							<li class="active"><i><img src="/images/www/icon_phone_hover.png"/></i>验证手机</li>
							<li><i><img src="/images/www/icon_over.png"/></i>完成</li>
						</ul>
						<!--验证步骤结束-->
						<form  id="bind_mobile_form"  method="post" action="<?php echo U('member/bind_mobile');?>" onsubmit="return checkBindMobileForm();" >
							<ul class="wrap clear">
								<li>
									<span class="w_1">手机号码</span>
									<div class="w_2">
										<input type="text" id="bind_mobile"  name="bind_mobile" value="<?php echo ($bind_mobile); ?>" class="txt"/>
									</div>
									<div class="tip clear" id="tip_bind_mobile"></div>
								</li>
								<li>
									<span class="w_1">短信验证码</span>
									<div class="w_2">
										<input type="text" name="verify" id="verify" class="txt"/>
										
										<span id="get_verify_button">
											<input type="button" onclick="getVerifyByMobile();" value="获取短信验证码" class="btn" >
										</span>
										<span id="tip_verify"></span>
										
									</div>
								</li>
							</ul>
							<div class="button">
          					<input type="submit"  class="tj" value="绑定"/>
          					</div>
							</div>
						</form>
					
					</div>
				    <!--右边内容结束-->
				</div>
			</div>
		</div>
	<!--内容区结束-->
 


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>