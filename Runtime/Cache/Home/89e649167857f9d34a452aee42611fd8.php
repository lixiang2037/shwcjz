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

<style>
.express_list {margin-left:20px;}
.express_list li{float:left;margin:5px 5px 0 0;}
.express_list li a{display:block;border:1px dashed #ccc;width:148px;height:48px;}
.express_list li a:hover{border-color:#333;}
</style>

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
								<p>订单详情</p>
								<span>order details</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/order/gene');?>">我的检索</a> | | <a href="" class="current">我的订单</a></p>
						</div>
						<!--标题结束-->
						<div class="plain">
							<dl>
								<dt>订单编号：<span><?php echo ($info['order_sn']); ?></span><dt>
								<dd>数量：<?php echo ($info['goods_num']); ?></dd>
								<dd>总金额：<?php echo ($info['total_price']); ?>元</dd>
								<dd>收件人：<?php echo ($address['contact_name']); ?></dd>
								<dd>手机：<?php echo ($address['phone']); ?></dd>
								<dd>电话：<?php echo ($address['tel']); ?></dd>
								<dd>采样地址：<?php echo ($address['address_info']); ?></dd>
								<?php if($info['order_status'] == 3): ?><br/>
									<dt><span>[采样器已寄]</span><dt>
									<dd>快递公司：<?php echo ($info['logistics_name']); ?></dd>
									<dd>快递单号：<?php echo ($info['logistics_sn']); ?></dd><?php endif; ?>
							</dl>
						</div>
						
						<?php if($info['order_status'] == 3): ?><div class="personal">
								<div class="top_tit">
									<h3>样品信息</h3>
								</div>
							</div>
							<form id="sample_send" action="<?php echo U('/order/send_sample');?>" method="post" onsubmit="return checkForm();" >
							<?php if(!empty($samples)): ?><div class="bm_h">
									<table id="person_list"  cellspacing="0" cellpadding="0" width="100%" >
										<tr>
											<td>样品编号</td>
											<td>检测人</td>
											<td>性别</td>
											<td>生日</td>
											<td>状态</td>
										</tr>
										<?php if(is_array($samples)): $i = 0; $__LIST__ = $samples;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sample): $mod = ($i % 2 );++$i;?><tr>
												<td><?php if($sample['status'] == 1): ?><input type="checkbox" name="sample_id[]" value="<?php echo ($sample['sample_id']); ?>" /><?php endif; echo ($sample['sample_sn']); ?></td>
												<td><?php echo ($sample['person_name']); ?></td>
												<td><?php echo ($sample['sex']); ?></td>
												<td><?php echo ($sample['byear']); ?>-<?php echo ($sample['bmonth']); ?>-<?php echo ($sample['bday']); ?></td>
												<td><?php echo ($sample['status_name']); ?></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									</table>
								</div><?php endif; ?>
							
							
							<div class="personal">
								<div class="top_tit">
									<h3>填写物流信息</h3>
								</div>
								<em>请在采集样品后尽快寄回，寄送地址：上海市浦东新区医学园区康新公路3399号楼021-51875086金钥匙实验室</em>
							</div>
							<ul class="express_list clear">
	                            <?php if(is_array($search_option["logistic_icon"])): $i = 0; $__LIST__ = $search_option["logistic_icon"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li name="<?php echo ($val["name"]); ?>"><a href="javascript:void(0);"><img src="<?php echo ($val["img"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<div class="tet">
								<p>
									<span>物流公司</span>
									<input type="text" class="wb" name="logistics_name" id="logistics_name" />
								</p>
								<p>
									<span>物流单号</span>
									<input type="text" class="wb" name="logistics_sn" id="logistics_sn" />
								</p>
							</div>
							<input type="hidden" name="order_id" value="<?php echo ($info['order_id']); ?>">
							<div class="button_mld btn">
								<input type="submit" value="提交"/>
							</div>
							</form><?php endif; ?>
	
					</div>
				    <!--右边内容结束-->
				</div>
			</div>
		</div>
	<!--内容区结束-->
	
	
<script type="text/javascript">
function checkForm(){
	var sample_num = $("input[name='sample_id[]']:checked").length;
	var logistics_name_ = $.trim($('#logistics_name').val());
	var logistics_sn_ = $.trim($('#logistics_sn').val());

	if(sample_num == 0){
		alert('请选择样品');
		return false;
	}
	
	if(logistics_name_ == ''){
		alert('请填写物流公司');
		return false
	}
	if(logistics_sn_ == ''){
		alert('请填写物流单号');
		return false
	}
	return true;
}
$(function(){

    $(".express_list li").click(function(){
        $(this).find('a').css('border-color', '#ff0000');
        $(this).siblings().find('a').css('border-color', '#ccc');
        $("#logistics_name").val($(this).attr('name'));
    });
})
</script>


	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>