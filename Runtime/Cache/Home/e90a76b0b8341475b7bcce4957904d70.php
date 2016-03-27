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
<script src="/javascript/passport.js" type="text/javascript"></script>
<link rel="stylesheet" href="/style/internal.css" type="text/css"/>

	<!--banner开始-->
	<div class="banner1">
	</div>
	<!--banner结束-->

	<!--内容区开始-->
		<div class="l_main">
			<div class="main_cont clear">
				<div class="content">
					<!--内容开始-->
					<div class="fram">
						<!--标题开始-->
						<div class="title">
							<div class="decn">N</div>
							<div class="bt">
								<p>设置新密码</p>
								<span>ew password</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="">首页</a> | <a href="">个人中心</a> | <a href="" class="current">账户信息</a></p>
						</div>
						<!--标题结束-->

						<!--验证步骤开始-->
						<ul class="switch">
							<li class="active"><i><img src="/images/www/icon_user.png"/></i>填写账户名</li>
							<li class="active"><i><img src="/images/www/icon_yz.png"/></i>验证身份</li>
							<li><i><img src="/images/www/icon_ys.png"/></i>重置密码</li>
							<li><i><img src="/images/www/icon_over.png"/></i>完成</li>
						</ul>
						<!--验证步骤结束-->
						<form  id="retrieve"  method="post" action="<?php echo U('/user/retrieve_validate');?>" onsubmit="return checkRetrieveValidateForm();" >
							<ul class="wrap clear">
								<li>
									<span class="w_1">找回方式：</span>
									<div class="w_2">
										<select name="retrieve_type" id="retrieve_type" style="width:150px;" onchange="changeRetrieveType()">
										    <?php if(is_array($bind_type)): $i = 0; $__LIST__ = $bind_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type_['id']); ?>" ><?php echo ($type_['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									    </select>  
									</div>
								</li>
											
								<div class="box" id="type_email" style='display:<?php if($default_type == 'email'): ?>block<?php else: ?>none<?php endif; ?>'>
									<li>
										<span class="w_1">绑定邮箱：</span>	
										<div class="w_2">
											<b><?php echo ($info['bind_email']); ?></b>
										</div>
									</li>
								</div>
								<div class="box" id="type_mobile" style='display:<?php if($default_type == 'mobile'): ?>block<?php else: ?>none<?php endif; ?>'>
									<li>
										<span class="w_1">绑定手机：</span>
										<div class="w_2">
											<b><?php echo ($info['bind_mobile']); ?></b>
										</div>
									</li>
								</div>
								<input type="hidden" id="bind_email" value="<?php echo ($info['bind_email']); ?>" />
								<input type="hidden" id="bind_mobile" value="<?php echo ($info['bind_mobile']); ?>" />
								
								<li>
									<span class="w_1">验证码</span>
									<div class="w_2" >
										<input type="text" style="width:90px;" name="verify" id="verify"  class="txt"/>
										<span id="get_verify_button">
											<input type="button" onclick="getRetrieveVerify();" value="获取验证码" class="btn" >
										</span>
									</div>
									<div id="tip_verify" class="t_m txt"></div>
								</li>
								
							</ul>
							<div class="button tj">
          					<input type="submit" value="下一步" /></div>
							</div>
						</form>
					
					</div>
				    <!--内容结束-->
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