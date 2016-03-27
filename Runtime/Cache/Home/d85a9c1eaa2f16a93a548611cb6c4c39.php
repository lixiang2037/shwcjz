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
<script src="/javascript/showDialog.js" type="text/javascript"></script>

	<!--banner开始-->
	<div class="banner2">
	</div>
	<!--banner结束-->

	<!--内容区开始-->
		<div class="l_main">
			<div class="main_cont clear">
				<div class="content">
					<div class="fram">
						<!--标题开始-->
						<div class="title">
							<div class="decn">R</div>
							<div class="bt">
								<p>检索结果</p>
								<span>etrieval results</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/order/gene');?>">我的检索</a> | <a href="" class="current">我的检测单</a></p>
						</div>
						<!--标题结束-->
						<div class="wrap">
							<ul>
								<li>检索人</li>
								<li>单号:MJA201501003</li>
								<li>数据范围:10万</li>
								<li>检索时间：2015-07-15</li>
							</ul>
							<p>说明：</br>
							检索结果</p>
							<table cellspacing="0" cellpadding="0" class="top main">
								<tr class="main">
									<td class="sex">刘先生  30岁</td>
									<td class="text">累计亲权指数(CPI):15622021514.52</td>
									<td><a href="javascript:void(0);" onclick="showWindow('私信','<?php echo U('/gene/messages',array('user_id'=>'11'));?>',600)"><img src="/images/www/icon_lr.png"/>私信</a></td>
								</tr>
								<tr>
									<td class="sex">(上海)</td>
									<td class="text">累计亲权指数(CPI):15622021514.52</td>
									<td><a href="" class="lx">联系方式</a></td>
								</tr>

							</table>

							<!-- <table cellspacing="0" cellpadding="0" class="top main">
								<tr class="main">
									<td class="sex">刘先生  30岁</td>
									<td class="text">累计亲权指数(CPI):15622021514.52</td>
									<td><a href=""><img src="/images/www/icon_lr.png"/>私信</a></td>
								</tr>
								<tr>
									<td class="sex">(上海)</td>
									<td class="text">累计亲权指数(CPI):15622021514.52</td>
									<td><a href="" class="lx">联系方式</a></td>
								</tr>

							</table>

							<table cellspacing="0" cellpadding="0" class="top main">
								<tr class="main">
									<td class="sex">刘先生  30岁</td>
									<td class="text">累计亲权指数(CPI):15622021514.52</td>
									<td><a href=""><img src="/images/www/icon_lr.png"/>私信</a></td>
								</tr>
								<tr>
									<td class="sex">(上海)</td>
									<td class="text">累计亲权指数(CPI):15622021514.52</td>
									<td><a href="" class="lx">联系方式</a></td>
								</tr>

							</table> -->
							<div class="button_mld btn_js clear">
								<a href="">重新检索</a>
							</div>
						</div>
						<!--聊天窗口开始-->
						<div class="chat" style="display:none">
							<div class="top_title">刘先生
								<img src="/images/www/letter_close.gif"/>
							</div>
							<div class="ck">
								<div class="ck_top"></div>
								<div class="ck_mid">
									<span><img src="/images/www/icon_letter1.gif"/></span>
									<span><img src="/images/www/icon_letter2.gif"/></span>
									<span><img src="/images/www/icon_letter3.gif"/></span>
								</div>
								<div class="ck_btm">
									<div class="btm_ck"></div>
									<div class="btn">发送</div>
								</div>
							</div>
						</div>
					</div>
						<!--聊天窗口结束-->		
				</div>
			</div>
		</div>
	<!--内容区结束-->
<script type="text/javascript">
	//清除缓存
	function clear_cache(){
		$.ajax({
			url:"<?php echo U('gene/clear_cache');?>",
			data:{'do':1},
            type:'POST',
			success:function(msg){
				if(msg=='ok'){
					alert('清除成功');
				}else{
					alert('系统异常');
				}
			},
			error:function(){
				alert('网络繁忙，请稍后重试');
			}
		});
		return false;
	}
 </script>


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>