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
	<script type="text/javascript" src="/javascript/checkform.js"></script>

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
				<a href="<?php echo U('/service/index');?>" class="current">客户服务</a>
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

	<!--banner开始-->
	<div class="banner4">
	</div>
	<!--banner结束-->

	<!--内容区开始-->
		<div class="l_main">
			<div class="main_cont clear">
				<div class="content">
					<!--左边导航开始-->
								
				<div class="left">
					<div class="title"><img src="/images/www/kh_title.gif"/></div>
					<div class="middle">
						<div class="m_c">
							<ul>
								<li [l1]><a href="<?php echo U('/service/index');?>">服务流程</a></li>
								<li class="current"><a href="<?php echo U('/service/goods');?>">套餐介绍</a></li>
								<li [l3]><a href="<?php echo U('/service/sample');?>">采样视频</a></li>
								<li [l4]><a href="<?php echo U('/service/help');?>">常见问题</a></li>
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
							<div class="decn">P</div>
							<div class="bt">
								<p>套餐介绍</p>
								<span>ackage introduction</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/service/index');?>">客户服务</a> | <a href="" class="current">套餐介绍</a></p>
						</div>
						<!--标题结束-->
						<div class="infor">
							<div class="tit">
								<h2>套餐介绍</h2>
								本套餐包含多项检测项目,通过检测您可以获取遗传信息,并对自身免疫力,药物影响力,环境抵抗力,营养吸收能力得到了解。
							</div>
							<div class="continer">
							<dl>
								<dt>DNA遗传身份信息</dt>
								<dd>生成遗传信息编码，确定个体的唯一性。</dd>
							</dl>
							<dl>
								<dt>健康成长</dt>
								<dd>儿童白血病</dd>
								<dd>儿童哮喘</dd>
								<dd>儿童过敏性鼻炎</dd>
							</dl>
							<dl>
								<dt>用药安全</dt>
								<dd>药物性耳聋</dd>
								<dd>对乙酰氨基酚</dd>
								<dd>布洛芬</dd>
								<dd>阿莫西林</dd>
							</dl>
							<dl>
								<dt>环境耐受</dt>
								<dd>抗铅中毒能力</dd>
								<dd>抗苯中毒能力</dd>
								<dd>抗流感病毒能力</dd>
							</dl>
							<dl>
								<dt>营养代谢</dt>
								<dd>维生素D吸收代谢</dd>
								<dd>铁吸收代谢</dd>
							</dl>
						</div>

						</div>
						
					
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