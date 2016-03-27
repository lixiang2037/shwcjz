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
					<li><a href="<?php echo U('/index/qualification');?>" [t_a2]>权威资质</a></li>
					<li><a href="<?php echo U('/index/conceal');?>" class="current">隐私声明</a></li>
					<li style="background:none;"><a href="<?php echo U('/index/contact');?>" [t_a4]>联系我们</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--导航nav切换结束-->

	<!--主体部分开始-->
	<div class="l_main">
		<div class="main_cnt">
			<h2 class="title"><span>服务条款</span><em>/</em><em>Service TS</em></h2>
			<div class="cont clear">
				<p class="first">欢迎阅读妈妈金钥匙http://www.xxx.cn网站(以下简称“本网站”)服务条款，其阐述之内容和条件适用于您使用本网站提供的各项服务。</p>
				<h3>1、服务条款的确认</h3>
				<p>您点击服务条款页面下的“我同意”按钮，即视为您已阅读、了解并完全同意服务条款中的各项内容，包括本网站对服务条款所作的任何修改，自愿遵守各项相关业务。除另行明确声明外，本网站任何服务范围或功能的变化均受服务条款约束。</p>
				<p style="color:#fca000;">本网站在必要时可修改服务条款，并在网站进行公告，一经公告，立即生效。如您继续使用服务，则视为您已接受修订的服务条款。</p>
				<h3>2、用户资格</h3>
				<p>您确认，在您开始注册程序使用本网站前，您应当具备中华人民共和国法律规定的与您行为相适应的民事行为能力。<span style="color:#fca000; font-weight:bold;">若您不具备前述与您行为相适应的民事行为能力，则您及您的监护人应依照法律规定承担因此而导致的一切后果。</span></p>
				<p>如果您未满13岁，则需要征得父母或监护人的同意方可提交和注册个人信息。</p>
				<h3>3、注册说明</h3>
				<p>当您按照注册页面提示填写信息、阅读并同意本协议且完成全部注册程序后，您可获得本网站账户并成为本网站的用户。您有权使用您设置或确认的邮箱、手机号码（以下简称“账户名称”）及您设置的密码（账户名称及密码合称“账户”）登录本网站。</p>
				<h3>4、用户资料及保密</h3>
				<p>考虑到本网站用户服务的重要性，您同意在注册时提供真实、完整及准确的本人资料(包括姓名、性别、国家/地区、证件类型、证件号码、出生日期，以及与身份信息对应的且可通话联络的唯一手机号码、邮箱)，如发生变化请及时更新。<span style="color:#fca000; font-weight:bold;">您了解并同意，您有义务保持您提供信息的真实性及有效性。</span></p>
				<h3>5、通知</h3>
				<dl>
					<dt>您同间本网站以下合理的方式向您送达各类通知：</dt>
					<dd>(一)公示的方案；</dd>
					<dd>(二)推送的消息；</dd>
					<dd>(三)根据您预留于淘宝平台的联系方式发出的电子邮件、短信、函件等；</dd>
				</dl>
				<h3>6、责任限制</h3>
				<dl>
					<dd>(1)遇以下情况，本网站不承担任何责任，包括但不仅限于： ①因不可抗力、系统故障、通讯故障、网络拥堵、供电系统故障、恶意攻击等造成本网站未能及时、准确、完整地提供服务。 ②无论在任何原因下，您通过使用本网站上的信息或由本网站链接的其他网站上的信息，或其他与本网站链接的网站上的信息所导致的任何损失或损害。</dd>
					<dd>(2)本网站负责对本网站上的信息进行核验与更新，但并不就信息的时效性、准确性以及服务功能的完整性和可靠性承担任何义务和赔偿责任。</dd>
					<dd>(3)如用户利用系统差错、故障或其他原因导致的漏洞，损害本网站及任何第三方的权益，本网站将终止该用户资格，并保留法律追究的权利。</dd>
					<dd>(4)如果本网站发现有影响用户信息安全的行为，本网站有权对用户信息实施保护。必要时用户需经重新验证身份后方可继续使用。</dd>
				</dl>
				<h3>7、拒绝提供担保</h3>
				<dl>
					<dt>本网站对以下情形不做任何担保，包括但不仅限于：</dt>
					<dd>(1)服务一定能满足您的要求。</dd>
					<dd>(2)服务不会受中断</dd>
					<dd>(3)服务的安全性、及时性、完整性和准确性。</dd>
					<dd>(4)服务所涉及相关方的服务。</dd>
					<dd>(5)您从本网站收到口头或书面的意见或信息。</dd>
					<dd>(6)您所提供的身份信息一定被注册。</dd>
					<dd>(7)他人使用与您相同的身份信息注册。</dd>
				</dl>
				<h3>8、网站链接</h3>
				<p>本网站包含有链接的第三方网站。这些链接纯粹为用户提供方便。本网站无法就所链接的第三方网站的内容或可用性予以控制或对其负责。如果您决定访问任何与本网站相链接的第三方网站，则应完全自行承担相应风险和责任。</p>
				<h3>9、保障</h3>
				<p>您同意保障和维护本网站的利益，并承担您或其他人使用您的用户资料造成本网站或任何第三方的损失或损害的赔偿责任。</p>
				<h3>10、知识产权</h3>
				<p>本网站所有内容和资源的版权归本网站所有(除非本网站已经标明版权所有人)，页面所有信息受《中华人民共和国著作权法》及相关法律法规和中国加入的所有知识产权方面的国际条约的保护。未经本网站事先的书面许可，任何单位和个人不得就本网站上的相关资源以任何方式、任何文字做全部或局部复制、修改、发送、储存、发布、交流或分发，或利用本网站上的相关资源创建其他商业用途的资源。否则本网站将追究其法律责任。</p>
				<h3>11、法律适用和管辖</h3>
				<p>本服务条款之效力、解释、变更、执行与争议解决均适用中华人民共和国法律。 因您使用本网站而导致的争议，您同意接受本网站注册地人民法院的管辖。 本网站享有对服务条款的最终解释与修改权。</p>
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