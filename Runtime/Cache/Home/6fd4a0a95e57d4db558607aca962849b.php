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
				<a href="<?php echo U('/index/about');?>" class="current">关于我们</a>
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
	
	<!--商品列表banner开始-->
	<div class="banner3">
	</div>
	<!--内页banner结束-->

	<!--导航nav切换开始-->
		<div class="about_nav">
		<div class="nav">
			<div class="abXnav">
				<ul>
					<li><a href="<?php echo U('/index/about');?>" [t_a1]>公司简介</a></li>
					<li><a href="<?php echo U('/index/qualification');?>" class="current">权威资质</a></li>
					<li><a href="<?php echo U('/index/conceal');?>" [t_a3]>隐私声明</a></li>
					<li style="background:none;"><a href="<?php echo U('/index/contact');?>" [t_a4]>联系我们</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--导航nav切换结束-->

	<!--主体部分开始-->
	<div class="l_main">
		<div class="main_cnt">
			<h2 class="title"><span>权威资质</span><em>/</em><em>Authority qualification</em></h2>
			<div class="cont clear">
				<ul class="wall">
					<li><img src="/images/www/u37.jpg" width="320" height="222"/>
						<p class="mc">司法鉴定许可证</p>
					</li>
						<li><img src="/images/www/u37.jpg" width="320" height="222"/>
						<p class="mc">司法鉴定许可证</p>
					</li>
					</li>
						<li><img src="/images/www/u37.jpg" width="320" height="222"/>
						<p class="mc">司法鉴定许可证</p>
					</li>
					</li>
						<li><img src="/images/www/u37.jpg" width="320" height="222"/>
						<p class="mc">司法鉴定许可证</p>
					</li>
					</li>
						<li><img src="/images/www/u37.jpg" width="320" height="222"/>
						<p class="mc">司法鉴定许可证</p>
					</li>
					</li>
						<li><img src="/images/www/u37.jpg" width="320" height="222"/>
						<p class="mc">司法鉴定许可证</p>
					</li>
				</ul>

			</div>
		</div>
	</div>	
	<!--主体部分结束-->
	


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>