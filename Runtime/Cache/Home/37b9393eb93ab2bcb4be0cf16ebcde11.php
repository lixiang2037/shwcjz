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
<link rel="stylesheet" href="/style/passport.css" type="text/css"/>
<script src="/javascript/passport.js" type="text/javascript"></script>
	<!--banner开始-->
	<div class="banner"></div>
	<!--banner结束-->

	<!--内容部分开始-->
	<div class="l_main clear">
		<div class="main_cont clear">
			<div class="user_l"></div>
			<div class="user_r">
				<p class="user_title">登录</p>
				<p class="user_info">如果您还没有账号，请立即<a href="<?php echo U("/user/m_register");?>">注册</a></p>
				<div class="contain">
					<form class="login" action="<?php echo U('user/login');?>" method="post" name="myform" id="myform" onsubmit="return checkLoginForm();" >
						<!--邮箱帐号或手机号开始-->
						<ul class="reg_list clear">
							<li>
								<span class="w_1">用户名</span>
								<div class="w_2">
									<input type="text" id="user_name_login" name="user_name"  />
								</div>
								<div class="tip" id="tip_user_name"></div>
							</li>
							<li>
								<span class="w_1">密码</span>
								<div class="w_2">
									<input type="password" id="password_login" name="password" type="password"  />
								</div>
								<div class="tip" id="tip_password"></div>
								<div class="forget clear">
									<a href="<?php echo U('user/retrieve');?>" class="word">忘记密码?</a>
								</div>
							</li>

						</ul>
						<div class="loginbtn">
          					<input type="submit" value="登录"/>
						</div>
						<!--邮箱帐号或手机号结束-->
						
					</form>
				</div>
			</div>
	</div>

	<!--内容部分结束-->


	<!--登录框开始
	<div id="loginbox" style="position: absolute; z-index: 100; left: 40%; top: 500px; margin-left:-50px;">
		<div class="login_content">
			<div class="newlogin">
				<div class="close">
						<a href="/"><img src="/images/close.png"/></a>
						</div>
				 <div class="newlogin_content">
					<img src="/images/login_t.gif"/>
					<div class="f-cb">
						<a href="<?php echo U("/user/m_register");?>">注册</a>
						<a href="<?php echo U("/user/login");?>" class="hover">登录</a>
					</div>
					
					<form class="login" action="<?php echo U('user/login');?>" method="post" name="myform" id="myform" >
					
					<input type="text" id="user_name_login" name="user_name" placeholder="邮箱/手机号" class="loginEmail"/>
					<span id="tip_user_name"></span>
					<input type="password" id="password_login" name="password" type="password" placeholder="密码" class="loginpassword"/>
					<span id="tip_password"></span>
						<div class="hint" id="error_msg" style="display:none;"><p class="m-tip"><em></em>账号或密码不正确！</p></div>
						
						<div class="login_w">
							<input type="checkbox" value="1" name="is_remember" id="is_remember" id="login"/><label for="login" class="lg">两周内免登录</label>
							<a href="<?php echo U('user/retrieve');?>" class="word">忘记密码?</a>
						</div>
						
						<div class="btn">
							<input class="u-btn" onclick="checkLoginForm();" type="button" value="登录"/>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
	
<div class="wrap"></div>
-->



<!--  
<div class="main passport">
	<div class="box_shadow box_login">
		<div class="title"><h2>登录</h2></div>
		<div class="contain">
			<div class="hint" id="error_msg" style="display:none;"><p>用户名或密码错误！</p></div>
			<form class="login" action="<?php echo U('user/login');?>" method="post" name="myform" id="myform" >
			<ul class="reg_list clear">
				<li id="li_user_name">
					<label class="w_1"><i class="ico_user"></i>邮箱/手机：</label>
					<div class="w_2"><input type="text" id="user_name_login" name="user_name" /></div>
					<span id="tip_user_name"></span>
				</li>	
				<li id="li_password">
					<label class="w_1"><i class="ico_password"></i>密码：</label>
					<div class="w_2"><input id="password_login" name="password" type="password" /></div>
					<span id="tip_password"></span>
				</li>
				<li id="li_verify" class="verify">
					<label class="w_1"><i class="ico_verify"></i>验证码：</label>
					<div class="w_2"><input type="text" name="verify" id="verify_login" onkeyup="this.value=this.value.toUpperCase()" />
						<img id="verifyImg" src="<?php echo U('/user/verify');?>" border="0"  onclick="javascript:fleshVerify();" style="cursor:pointer;width:150px; margin:0 auto;" />
						<a href="javascript:void(0)" onclick="javascript:fleshVerify();">换一个</a>
					</div>
					<span id="tip_verify"></span>
				</li>
				<li><label class="w_1"></label> <div class="w_2"><label><input type="checkbox" style="width:auto" value="1" name="is_remember" id="is_remember"><span class="color_gray">&nbsp;两周内免登录</span></label></div></li>
			</ul>
			<div class="con_footer"><a href="<?php echo U('user/retrieve');?>">忘记密码？</a>
			<input type="button" onclick="checkLoginForm();" value="登录" class="btn btn_bigest btn_blue" />
			</div>
			</form>
		</div>
	</div>
</div>	
-->




	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>