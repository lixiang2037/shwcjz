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
				<a href="<?php echo U('/order/gene');?>" class="current">我的检索</a>
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

	<!--banner开始-->
	<div class="banner2">
	</div>
	<!--banner结束-->

	<!--内容区开始-->
		<div class="l_main">
			<div class="main_cont clear">
				<div class="content">
					<!--左边导航开始-->
								<div class="left">
				<div class="title"><img src="/images/www/js_title.gif"/></div>
				<div class="middle">
					<div class="m_c">
						<ul>
							<li [l1]><a href="<?php echo U('/gene/gene_file');?>">提交基因信息</a></li>
							<li [l2]><a href="<?php echo U('/order/goods');?>">申请基因检测</a></li>
							<li [l3]><a href="<?php echo U('/order/gene');?>">我的订单</a></li>
							<li class="current"><a href="<?php echo U('/gene/result');?>">我的检索单</a></li>
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
							<div class="decn">M</div>
							<div class="bt">
								<p>我的检索单</p>
								<span>y search</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/order/gene');?>">我的检索</a> | <a href="" class="current">我的检索单</a></p>
						</div>
						<!--标题结束-->
						<div class="wrap_k">
							<div class="tab">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<th width="40%" class="title_bj">检索单号</th>
									<th class="title_bj">上传时间</th>
									<th class="title_bj">姓名</th>
									<th class="title_bj">是否被检索</th>
									<th class="title_bj">操作</th>
								</tr>
								<?php if(!empty($infos)): if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
												<td width="30%" class="clr"><?php echo ($info['retrieval_sn']); ?></td>
												<td><?php echo ($info['add_ts']); ?></td>
												<td><?php echo ($info['person_name']); ?></td>
												<td><?php echo ($info['is_search_name']); ?></td>
												<td class="clr bold"><a href="<?php echo U('/gene/search');?>">检索</a></td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									</table>
									</div>
								<?php else: ?>
									</table>
									</div>
									<div class="photo">
										<img src="/images/www/search_none.jpg"/>
									</div><?php endif; ?>
							
							
								<!--  
								<div class="photo">
									<img src="/images/www/search_none.jpg"/>
								</div>
								-->
							</div>
					</div>
				    <!--右边内容结束-->
				</div>
			</div>
		</div>
	<!--内容区结束-->


<?php ?>



	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>