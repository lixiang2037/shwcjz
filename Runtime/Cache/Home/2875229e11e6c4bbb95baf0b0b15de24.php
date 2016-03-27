<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/javascript/index.js"></script>
<link rel="stylesheet" type="text/css" href="/style/global.css">
<link rel="stylesheet" href="/style/index.css" type="text/css"/>
	<title>上海玮聪建筑材料有限公司</title>
</head>
<body>
<!--整体页面头部开始-->
	<div class="header">
		<!--头部开始-->
		<div class="h_top">
			<!--logo-->
			<div class="logo">
				<a href="/"><img src="/"></a>
			</div>
			<!--nav-->
			<div class="nav">
				<a href="/" [t1]>首页</a>
				<a href="<?php echo U('/');?>" [t2]>供应产品</a>
				<a href="<?php echo U('/');?>" [t3]>公司介绍</a>
				<a href="<?php echo U('/');?>" [t4]>联系我们</a>
			</div>
			<!-- <?php if($is_login == 'Y'): ?><div class="user">
				欢迎您，<a href="<?php echo U('/member/security');?>"><?php echo ($user_name); ?></a>
			</div>
			
			<div class="text">
				<a href="javascript:logout();">退出</a>
			</div>
			<?php else: ?>
			<div class="login">
				<a href="javascript:login();">登录</a>
				<a href="javascript:regist();" class="hover" >注册</a>
			</div><?php endif; ?> -->
			
		</div>
		<!--头部结束-->
	</div>
	<!--整体页面头部结束-->
	<!--首页banner开始-->
	<div class="baner">
		<div id="banner">
	
			<!--banner1开始-->
			<div class="img_list" style="background:url('/images/www/baner1.jpg') center">
				
			</div>
			<!--banner1结束-->
			<!--banner2开始-->
			<div class="img_list" style="background:url('/images/www/baner2.jpg') center">
				
			</div>
			<!--banner2结束-->

			<!--banner3开始-->
			<div class="img_list" style="background:url('/images/www/baner3.jpg') center">
				
			</div>
			<!--banner3结束-->
		
			<!--轮播的按扭-->
			<ul class="button">
				<li class="first"></li>
				<li></li>
				<li></li>
		    </ul>

	</div>
	</div>
	<!--首页banner结束-->
	<!-- 供应产品 开始 -->
	<!-- <div class="recompro loading">
		<div class="proPicTit">热销产品</div>
	    <div class="proPic">
			<div class="proTit" style="">
				<span class="more"><a href="#"  target='_blank'>更多 &gt;&gt;</a></span></div>
		   <ul>
			   	<li>
			   		
			   	</li>
		   </ul>
    	</div>
	    
	</div> -->
	<div class="recompro">
		<div class="proPicTit">
			<span>热销产品</span>
			<span class="more"><a href="#">更多 &gt;&gt;</a></span>
		</div>
	</div>
	<!-- 供应产品 结束 -->
	
</body>
</html>
<script type="text/javascript">
	// $('.h_top nav a').hover()
</script>