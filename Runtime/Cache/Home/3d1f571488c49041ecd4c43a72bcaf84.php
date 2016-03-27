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
					<li><a href="<?php echo U('/index/about');?>" class="current">公司简介</a></li>
					<li><a href="<?php echo U('/index/qualification');?>" [t_a2]>权威资质</a></li>
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
			<div class="lt">
				<img src="/images/www/aboutImg.jpg" width="400" height="267"/>
			</div>
			<div class="rt">
				<h2>国内领先的基因检测公司</h2>
				<h3>拥有国际顶尖测序检测平台、技术和专家</h3>
				<p>公司同时拥有Illumina高通量测序平台，ABI3730xl测序平台，罗氏454高通量测序平台，集合了3500、3730xl、454、Miseq、Hiseq2500、Hiseq4000等平台，进行广角度、深精度的基因检测研究。</p>
				<h3>通过国家法律法规经营许可，拥有多种资质</h3>
				<p>获得医疗机构执业许可证，司法鉴定许可证，CMA资质认证，质量管理体系认证，拥有发明专利9项，软件著作权61项，上海市“高新技术成果转化项目”，被评为上海名牌，最具发展潜力服务机构，上海科技企业创新奖。</p>
				<h3>专业从事基因检测技术研发、云计算和基因健康服务</h3>
				<p>运用STR技术，在美国联邦调查局（FBI）公布的13个核心位点基础上添加了7个个体识别位点，对这20对个体识别基因进行检测，从而获得高准确度的比对信息，将信息进行数据编码，生成代号，确定个体的唯一性。DNA检测的科学与快捷将大大减少寻亲人群的精力、财力，只要把个人及DNA信息输入数据库，便可自动匹配相似基因，DNA信息将永久保存，一劳永逸。</p>
				<h3>为一流的医疗机构、科研单位和健康类公司提供检测服务</h3>
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