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
				<li [t_top1]><a href="<?php echo U('/index/child');?>">亲子保护</a></li>
				<li [t_top2]><a href="<?php echo U('/index/tracing');?>">寻亲团圆</a></li>
				<li class="current"><a href="<?php echo U('/index/celebrity');?>">名人基因</a></li>
			</ul>
		</div>
	</div>
	<!--专题页导航结束-->
	
	<!--主体部分开始-->
	<!--主体部分开始-->
	<div class="main_body clear">
		<div class="content">
			<!--第一部分开始-->
			<div class="part1">
				<div class="pic"></div>
				<div class="text">
					<h3>您不知道的事</h3>
					<p>你是孔子的后人吗？或许你的前人是诗仙？<br/>
					也许你是名人的后代却不自知，恩···不急<br/>
					我们为你提供服务，看了你就知道了
					</p>
				</div>
				<div class="drct">
					<a href="">直接检索</a>
				</div>
			</div>
			<!--第一部分结束-->
		</div>
		<!--搜索字母开始-->
		<div class="full">
			<div class="full_cont">
				<div class="whole">
					<a href="">全部</a>
				</div>
				<div class="option">
					<a href="" class="current">A</a>
					<a href="">B</a>
					<a href="">C</a>
					<a href="">D</a>
					<a href="">E</a>
					<a href="">F</a>
					<a href="">G</a>
					<a href="">H</a>
					<a href="">J</a>
					<a href="">K</a>
					<a href="">M</a>
					<a href="">N</a>
					<a href="">O</a>
					<a href="">P</a>
					<a href="">Q</a>
					<a href="">S</a>
					<a href="">T</a>
					<a href="">U</a>
					<a href="">W</a>
					<a href="">X</a>
					<a href="">Y</a>
					<a href="">Z</a>
				</div>
				<!--搜索开始-->
				<div class="search">
					<form>
						<input type="text" class='txt' value="请输入搜索的字母"/>
						<a href="" class="but"></a>
					</form>
				</div>
				<!--搜索结束-->
			</div>
		</div>
		<!--搜索字母结束-->
		<div class="part2 clear">
			<div class="cont clear">
				<!--曹操-->
				<ul class="wall">

					<li class="current"><img src="/images/www/person_1.jpg"/>
						<div class="text">
							<p>曹操&nbsp;&nbsp;汉族</p>
							<p>沛国谯县（今安微毫州）人<br/>
								政治家、军事家、文学家、书法家
							</p>
						</div>
					</li>
					<div class="trast"><a href="" class="current">立即对比</a></div>	
				</ul>
				
				<!--刘邦-->
				<ul class="wall">
					<li><img src="/images/www/person_2.jpg"/>
						<div class="text">
							<p>刘邦&nbsp;&nbsp;汉族</p>
							<p>沛丰邑中阳里（今江苏丰县）人<br/>
								皇帝、政治家
							</p>
						</div>
					</li>
					<div class="trast clear"><a href="">立即对比</a></div>		
					<div class="shade"></div>
				</ul>
				<!--鲁讯-->
				<ul class="wall">
					<li><img src="/images/www/person_3.jpg"/>
						<div class="text">
							<p>鲁讯&nbsp;&nbsp;汉族</p>
							<p>浙江绍兴人<br/>
								思想家、文学家
							</p>
						</div>
					</li>
					<div class="trast clear"><a href="">立即对比</a></div>	
					<div class="shade"></div>
				</ul>
				<!--李白-->
				<ul class="wall">
					<li><img src="/images/www/person_4.jpg"/>
						<div class="text">
							<p>李白&nbsp;&nbsp;汉族</p>
							<p>陇西成纪（今甘肃天水市秦安县）人<br/>
							   诗仙，世界文化名人
							</p>
						</div>
					</li>
					<div class="trast"><a href="">立即对比</a></div>
					<div class="shade"></div>
				</ul>
				<!--叶问-->
				<ul class="wall">
					<li><img src="/images/www/person_5.jpg"/>
						<div class="text">
							<p>叶问&nbsp;&nbsp;汉族</p>
							<p>广东省南海县人人<br/>
							   中国武术家 咏春拳宗师
							</p>
						</div>
					</li>
					<div class="trast clear"><a href="">立即对比</a></div>	
					<div class="shade"></div>
				</ul>
				<!--霍元甲-->
				<ul class="wall">
					<li><img src="/images/www/person_6.jpg"/>
						<div class="text">
							<p>霍元甲&nbsp;&nbsp;汉族</p>
							<p>天津市西青区人<br/>
							   武术家
							</p>
						</div>
					</li>
					<div class="trast clear"><a href="">立即对比</a></div>	
					<div class="shade"></div>
				</ul>
			</div>
		</div>
	</div>	
	<!--主体部分结束-->
	<!--主体部分结束-->

	
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