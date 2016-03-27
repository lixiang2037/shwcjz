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
								<li class="current"><a href="<?php echo U('/service/index');?>">服务流程</a></li>
								<li [l2]><a href="<?php echo U('/service/goods');?>">套餐介绍</a></li>
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
							<div class="decn">S</div>
							<div class="bt">
								<p>服务流程</p>
								<span>ervice process</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/service/index');?>">客户服务</a> | <a href="" class="current">基本资料</a></p>
						</div>
						<!--标题结束-->
						<div class="infor">
							<div class="tit">
								<h2>检测流程</h2>
								<p style="color:#fca000; font-weight:bold; text-align:center;">申请并填写基本信息——采样——样本寄回——基因检测——网络查询结果——寄送书面报告——提供资询服务</p>
								
							</div>
							<div class="continer">
								<img src="/images/www/sample.jpg"/>
								<h2>采样流程</h2>
								<div class="lc_img">
								</div>
								<h2>注意事项</h2>
								<h3>【复查处理流程】</h3>
								<p>若客户对检测结果有疑问，请在标本的保存期内提出，检验所评估后予以复查。</p>
								<h3>【标本补送处理流程】</h3>
								<p>1)由于标本量少、标本污染、性状不符等原因导致的检测无法完成，检验所将通知客户		补送标本;</br>　
								   2)客户补送标本时，接收员提供新的条形码以区别于原标本，并在单据上填写“补送”字样;</br>
								   3)检验所将根据相应信息，安排检测。
								</p>
								<h3>【项目加做的处理流程】</h3>
								<p>1）如果客户要求加做项目，在样本有效保存期间和检测结果不受影响的情况下，请联系客服部，客服部通知检验所对样本进行评估；</br>
								2）评估合格后，客服部将通知标本接收员填写标本接收单，请客户签字，之后随当天接收的标本一起运送至检验所；</br>
								3）报告时间以项目册上承诺的时间为准。
								</p>
								<h3>【其他】</h3>
								<p>如客户来电要求或申请单注明需要当晚立即报告结果的，请务必提供准确的联络方式，检验所核对信息后进行口头报告，书面报告单按正常程序发送。</p>
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