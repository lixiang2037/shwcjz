<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!--声明当前页面的编码格式 国际编码 UTF-8  中文编码 GBK-->
	<meta charset="utf-8">
	<!--声明当前页面的三要素-->
	<title><notempty name="page_title">{$page_title}<else /> {:C(PAGE_TITLE)}</notempty></title>
	<meta name="keywords" content="<notempty name="page_keywords">{$page_keywords}<else />{:C(PAGE_KEYWORD)}</notempty>"/>
	<meta name="description" content="<notempty name="page_description">{$page_description}<else />{:C(PAGE_DESCRIPTION)}</notempty>" />
	<!--样式css-->
	<link rel="stylesheet" href="/style/global.css" type="text/css"/>
	
	<script type="text/javascript" src="/javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/javascript/ad.js"></script>
</head>	
<body>

	<?php 
	
		$is_login = 'N';
		if(is_user_login() !== 0)
		{
			$is_login = 'Y';
		}
		$user_name = get_show_name(); 
	?>

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
				<a href="{:U('/index/about')}" [t2]>关于我们</a>
				<a href="{:U('/order/gene')}" [t3]>我的检索</a>
				<a href="{:U('/service/index')}" [t4]>客户服务</a>
			</div>
			<if condition="$is_login eq 'Y'">
		
			<div class="user">
				欢迎您，<a href="{:U('/member/security')}">{$user_name}</a>
			</div>
			
			<div class="text">
				<a href="javascript:logout();">退出</a>
			</div>
			<else />
			<!--登录\注册-->
			<div class="login">
				<a href="javascript:login();">登录</a>
				<a href="javascript:regist();" class="hover" >注册</a>
			</div>
			
			</if>
			
		</div>
		<!--头部结束-->
	</div>
	<!--整体页面头部结束-->

<script type="text/javascript">

function login()
{
	location.href = "{:C(WWW_GK_COM)}/user/login?return_url="+this.location.href;
}
function regist()
{
	location.href = "{:C(WWW_GK_COM)}/user/m_register?return_url="+this.location.href;
}
function logout(){
	location.href = "{:C(WWW_GK_COM)}/user/logout?return_url="+this.location.href;
}

</script>