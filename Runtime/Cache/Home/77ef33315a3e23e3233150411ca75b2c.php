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
<link rel="stylesheet" href="/style/login.css" type="text/css"/>
<link rel="stylesheet" href="/style/passport.css" type="text/css"/>

<script src="/javascript/passport.js" type="text/javascript"></script>
<!--注册开始-->
	
	<div class="l_main">
		<div class="main_cont clear">
			<!--注册左边部分开始-->
			<div class="left">
				<ul class="tab">
					<li class="current"><a href="<?php echo U("/user/m_register");?>">手机注册</a></li>
					<li class="default"><a href="<?php echo U("/user/e_register");?>">邮箱注册</a></li>
				</ul>
				<div class="contain">
				<form action="" method="post" id="myform" >
					<ul class="reg_list clear">
						<!--手机号码-->
						<li>
							<span class="w_1">手机号码</span>
							<div class="w_2">
								<input type="text" id="user_name_mobile" name="user_name" />
							</div>
							<div class="t_m" id="tip_user_name"></div>
						</li>
						<!--短信验证码-->
						<li>
							<span class="w_1">短信验证码</span>
							<div class="w_2"><input type="text" name="verify" id="verify" />
								<span id="get_verify_button">
									<a href="javascript:void(0)" onclick="getVerifyByMobile();" class="btn">获取短信验证码</a>
								</span>
							</div>
							<div class="tip" id="tip_verify"></div>
						</li>
						<!--图片验证码
						<li>
							<span class="w_1">图片验证码</span>
							<div class="w_2">
								<input type="text" name="email" value="请输入验证码"  />
							</div>
							<div class="pic"></div>
							<div class="text">看不清楚，<a href="">换一张</a></div>
						</li> -->
						<!--密码-->
						<li>
							<span class="w_1">密码</span>
							<div class="w_2">
								<input type="password" id="password" name="password"  />
							</div>
							<div class="t_m txt" id="tip_password"></div>
							<!--  
							<div class="tip">
								<b class="current">弱</b><b>中</b><b>强</b>
							</div>
							-->
						</li>
						
						
						<!--确认密码-->
						<li class="verify">
							<span class="w_1">确认密码</span>
							<div class="w_2">
								<input type="password" id="passwordconfirm" name="passwordconfirm"  />
							</div>
							<div class="t_m txt" id="tip_passwordconfirm"></div>
						</li>
						<!--同意协议-->
						<li>
							<span class="w_1"></span>
							<div class="w_2">
								<input type="checkbox" checked="checked" class="checkbox" />
								<a href="">同意"服务协议"和"用户须知"</a>
							</div>
						</li>
					</ul>
					<div class="loginbtn but">
          			<input type="button" onclick="checkForm(2);" value="立即注册" class="btn"/>
          			</div>
          			</form>
				</div>
				<!--注册左边部分结束-->
			</div>
			<!--注册左边部分结束-->
			<!--注册右边部分开始-->
			<div class="right">
				<p class="p1"><i class="ico_error"></i>已有账号</p>
				<div class="loginbtn but">
          			<a href="<?php echo U('/user/login');?>">登录</a>
				</div>
				<p class="p2">若<a href="<?php echo U('user/retrieve');?>">忘记密码？</a>可以通过邮箱或手机找回</p>
				</div>

			</div>
			<!--注册右边部分结束-->	
			</div>
			
			
			</div>
		</div>
	</div>
	<!--注册结束-->
	


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>