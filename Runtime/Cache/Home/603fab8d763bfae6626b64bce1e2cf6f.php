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
				<a href="/" class="current">首页</a>
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

<!--内页banner开始-->
	<div class="ny_banner">
	</div>
	<!--内页banner结束-->
	<!--专题页导航开始-->
	<div class="ny_nav">
		<div class="nav_body">
			<ul>
				<li class="current"><a href="<?php echo U('/index/child');?>">亲子保护</a></li>
				<li [t_top2]><a href="<?php echo U('/index/tracing');?>">寻亲团圆</a></li>
				<li [t_top3]><a href="<?php echo U('/index/celebrity');?>">名人基因</a></li>
			</ul>
		</div>
	</div>
	<!--专题页导航结束-->
	
	<!--首页主体部分开始-->
	<div class="main_body clear">
		<div class="content">
			<!--宝宝安全开始-->
			<div class="child">
				<div class="lt">
					<div class="title"><img src="/images/www/title_01.png"/>
					</div>
					<div class="cont_text">
					宝宝天真的笑脸，清澈的眼神，一切如此美好。<br/>
					妈妈接个电话，几分钟后孩子就离开视线了…<br/>
					为什么会让孩子离开了我的视线？妈妈后悔莫及，可是宝宝的无知和对世界的好<br/>奇会让你防不胜防，该怎么办？<br/>
					存储宝宝基因，通过宝宝的DNA身份档案可以直接快速地找到父母。
					</div>
				</div>
			</div>	
			<!--宝宝安全结束-->

			<!--找到回家的路开始-->
			<div class="road">
				<div class="rt">
					<div class="title"><img src="/images/www/title_02.png"/>
					</div>
					<div class="cont_text">
					宝宝天真的笑脸，清澈的眼神，一切如此美好。<br/>
					妈妈接个电话，几分钟后孩子就离开视线了…<br/>
					为什么会让孩子离开了我的视线？妈妈后悔莫及，可是宝宝的<br/>
					无知和对世界的好奇会让你防不胜防，该怎么办？<br/>
					存储宝宝基因，通过宝宝的DNA身份档案可以直接快速地找到父母。
					</div>
				</div>
			</div>	
			<!--找到回家的路结束-->
			<!--拯救流浪儿童开始-->
			<div class="stray">
				<div class="lt">
					<div class="title"><img src="/images/www/title_03.png"/>
					</div>
					<div class="cont_text">
					宝宝天真的笑脸，清澈的眼神，一切如此美好。<br/>
					妈妈接个电话，几分钟后孩子就离开视线了…<br/>
					为什么会让孩子离开了我的视线？妈妈后悔莫及，可是宝宝的无知和对世界的好<br/>奇会让你防不胜防，该怎么办？<br/>
					存储宝宝基因，通过宝宝的DNA身份档案可以直接快速地找到父母。
					</div>
				</div>
			</div>	
			<!--拯救流浪儿童结束-->
		</div>
	</div>	
	<!--首页主体部分结束-->

	<!--上传基因信息/申请基因检测开始-->
	<div class="gene">
		<div class="cont">
			<ul>
				<li><a href="<?php echo U('gene/gene_file');?>" class="current">上传基因信息</a></li>
				<li><a href="<?php echo U('order/goods');?>">申请基因检测</a></li>
			</ul>
		</div>
	</div>
	<!--上传基因信息/申请基因检测结束-->
		<!--固定广告宣传-马上注册开始-->
	<div class="fixedbox">
		<div class="r_main">
			<div class="reg"><a href="javascript:regist();">马上注册</a></div>
		</div>
	</div>
	<!--固定广告宣传-马上注册结束-->
	


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>