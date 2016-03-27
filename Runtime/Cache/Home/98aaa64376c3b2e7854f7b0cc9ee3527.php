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
							<li class="current"><a href="<?php echo U('/order/gene');?>">我的订单</a></li>
							<li [l4]><a href="<?php echo U('/gene/result');?>">我的检索单</a></li>
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
							<div class="decn">O</div>
							<div class="bt">
								<p>订单确认</p>
								<span>order details</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> |<a href="<?php echo U('/order/gene');?>">我的检索</a> | <a href="" class="current">我的订单</a></p>
						</div>
						<!--标题结束-->
						
						
						
						<div class="order">
							<!--订单号/订单状态说明开始-->
							<div class="order_status">
								<span>订单号：
									<span class="order_status_hint"><?php echo ($info['order_sn']); ?></span>&nbsp;&nbsp;&nbsp;
								</span>
								<!--  
								<span>状态：</span>
								<span class="order_status_hint">订单提交成功</span>
								-->
							</div>
							<div class="order_status_directions">
								<p>该订单将会为您保留2小时（从下单日算起），2小时之后如果还未完成订单，将会自动取消。</p>
							</div>
							<!--订单号/订单状态说明结束-->
						</div>
						<!--订单状态开始-->
						<span class="ject">订单状态</span>
						<div class="order_flow">
							 <ul>
								<li class="active">
									<i></i>
									<span>提交订单</span>
								</li>
								<li>
									<i></i>
									<span>付款</span>
								</li>
								<li>
									<i></i>
									<span>接收采集器</span>
								</li>
								<li>
									<i></i>
									<span>寄送样品</span>
								</li>
								<li>
									<i></i>
									<span>查看报告</span>
								</li>
							 </ul>
							 
						</div>
						<span class="ject">订单信息</span>
						<div class="plain">
							<dl>
								<dd>收件人：<?php echo ($address['contact_name']); ?><dd>
								<dd>采样地址：<?php echo ($address['address_info']); ?></dd>
								<dd>固定电话：<?php echo ($address['tel']); ?></dd>
								<dd>手机号码：<?php echo ($address['phone']); ?></dd>
							</dl>
						</div>
						<span class="ject">支付方式</span>
						<p class="mode">支付方式：支付宝</p>
						<span class="ject">商品清单</span>
						<div class="form">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<th class="first">套餐</th>
									<th>单价</th>
									<th>数量</th>
								</tr>
								<tr>
									<td class="first"><?php echo ($goods['goods_name']); ?></td>
									<td><?php echo ($goods['goods_price']); ?></td>
									<td><?php echo ($info['goods_num']); ?></td>
								</tr>
							</table>
						</div>
						<div class="total">订单总金额：<span>￥<?php echo ($info['total_price']); ?></span></div>
						<!--订单状态结束-->
						
						<div class="next_btn">
							<a href="<?php echo U('/order/pay', array('order_id'=>$info['order_id']));?>">确定</a>
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