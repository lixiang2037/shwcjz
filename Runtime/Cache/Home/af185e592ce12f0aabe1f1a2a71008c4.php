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
								<li [l2]><a href="<?php echo U('/service/goods');?>">套餐介绍</a></li>
								<li [l3]><a href="<?php echo U('/service/sample');?>">采样视频</a></li>
								<li class="current"><a href="<?php echo U('/service/help');?>">常见问题</a></li>
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
							<div class="decn">C</div>
							<div class="bt">
								<p>常见问题</p>
								<span>ommon problem</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/service/index');?>">客户服务</a> | <a href="" class="current">常见问题</a></p>
						</div>
						<!--标题结束-->
						<div class="infor">
							<h3>1.什么是基因？</h3>
							<p>基因是DNA 分子上携带有遗传信息的功能片断。简而言之，基因是生命的基本因子；基因是生命的操纵者和调控者，基因是生命之源，生命之本，基因主宰生命。一切生命的存在或衰亡形式都是由基因决定的。比如您的长相、身高、体重、肤色、性格等均与基因有关。</p>
							<h3>2.什么是基因检测？</h3>
							<p>所谓基因检测，就是取被检测者的口腔黏膜细胞，经提取和扩增其基因信息后，通过特定技术和设备对被检测者细胞中的DNA分子等基因信息作检测，分析他所含有的各种疾病易感基因的情况，从而使人们能及时了解自己的基因信息，预测身体患疾病的风险，从而改善自己的生活环境和生活习惯，让自己活得明明白白。基因检测可以在身体没有患病的情况下，找到隐藏在您体内的“基因地雷”。</p>
							<h3>3.基因检测的准确率有多少？</h3>
							<p>DNA的基因检测技术和SNP分析技术近年来得到迅速发展，使用基因检测技术进行SNP分析，具有快速、高效、准确、可产业化等特点，特定基因序列对生命功能的影响，是全世界科学家共同研究的成果，其科学性毋庸置疑。从技术参数上看，准确率在99.99%以上。
							</p>
							<h3>4.我怎么知道你们的公司对结果如何做到保密？</h3>
							<p>我们充分意识到您对隐私保护的权益，所以我们对检测者的所有个人信息都通过加密后严格保护，在服务的整个流程中，对您进行问卷调查、取样、基本信息核对、DNA抽取和基因分型、基因型评估与报告制作的人互相隔断，以保证没有人能够获取检测者的全部信息。我们郑重承诺：不将检测者的结果用于任何其他商业用途。
							</p>
							<h3>5.采样是采集血液吗？足不出户怎么理解？</h3>
							<p>不是，我们推荐使用口腔粘膜采样。因为口腔粘膜采样简便、无创伤性，特别是对于婴幼儿来说比较容易操作，安全性高，也不会给人们造成不必要的心理压力。</br>
							当您订购基因检测服务后，我们会邮寄采样盒到您那边，之后再进行采样邮寄回公司即可，无需到店检测，不受地点限制，方便快捷。
							</p>
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