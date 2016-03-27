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
	<script src="/javascript/showDialog.js" type="text/javascript"></script>
	<link href="/style/layer.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/style/internal.css" type="text/css"/>
	<script type="text/javascript" src="/javascript/checkform.js"></script>
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
							<li class="current"><a href="<?php echo U('/gene/gene_file');?>">提交基因信息</a></li>
							<li [l2]><a href="<?php echo U('/order/goods');?>">申请基因检测</a></li>
							<li [l3]><a href="<?php echo U('/order/gene');?>">我的订单</a></li>
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
							<div class="decn">U</div>
							<div class="bt">
								<p>提交基因信息</p>
								<span>y contact person</span>
							</div>
							<p class="text">您现在所在的位置 | <a href="<?php echo U('/');?>">首页</a> | <a href="<?php echo U('/order/gene');?>">我的检索</a> | <a href="" class="current">提交基因信息</a></p>
						</div>
						<!--标题结束-->
						<div class="wrap_jc">
							<div class="top_one">
								<div class="tit">提交基因信息</div>
							</div>	
							<form action="<?php echo U('/gene/gene_file');?>" method="post" onsubmit="return checkGeneForm();">
							<div class="swth">
								<ul>
									<a href="javascript:void(0);" onclick="show_mj();"><li id="li_mj" class="current">美吉检测</li></a>
									<a href="javascript:void(0);" onclick="show_other();" ><li id="li_other">其他</li></a>
								</ul>
								<input type="hidden" name="check_type" id="check_type" value="1" />
								<!-- 美吉检测 -->
								<div class="bm clear tet" id="mj_">
									<h3>输入样品编码</h3>
									<input type="text" name="sample_sn" id="sample_sn" class="wb" />
								</div>
								
								<!--其他检测-->
								<div id="other_" class="personal clear" style="display:none;">
									<div class="top_tit">
										<h3>填写位点信息</h3>
									</div>
									<div class="tet">
										<p><span>选择试剂盒</span>
										<select name="kit_id" id="kit_id">
											<option value="">--请选择--</option>
											<?php if(is_array($kit_search_option["kit_select"])): $k = 0; $__LIST__ = $kit_search_option["kit_select"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kit): $mod = ($k % 2 );++$k;?><option value="<?php echo ($kit['kit_id']); ?>" ><?php echo ($kit['kit_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										</p>
										<div id="locus_info">
										</div>
									</div>
									<div class="top_tit">
										<h3>填写个人信息</h3>
									</div>
									<div class="tet">
										<p><span>姓名</span><input type="text" name="person_name" id="person_name" class="wb"/></p>
										<p><span>性别</span>
											<input type="radio" value="1" name="sex" checked="check"/>男
											<input type="radio" value="2" name="sex" class="radio"/>女
										</p>
										<p><span>生日</span>
											<select style="width:100px;" name="byear" id="byear"><?php echo ($year); ?></select>年&nbsp;
											<select style="width:100px;" name="bmonth" id="bmonth"><?php echo ($month); ?></select>月&nbsp;
											<select style="width:100px;" name="bday" id="bday"><?php echo ($day); ?></select>日
										</p>
										<p><span>身份证</span><input type="text" name="id_num" id="id_num" class="wb"/></p>
										<p><span>出生地</span>
											<select style="width:100px;" name="province_id" id="J_province" ></select>&nbsp;
											<select style="width:100px;" name="city_id" id="J_city"></select>&nbsp;
											<select style="width:100px;" name="district_id" id="J_district"></select>&nbsp;
											<select style="width:100px;" name="community_id" id="J_community"></select>
										</p>
										<p>
											<span></span>
											<input type="text" name="address" id="address"  class="wb"/>
										</p>
									</div>
									<div class="top_tit">
										<h3>填写联系人信息</h3>
									</div>
									<div class="tet">
										<p><span>联系人</span>
											<span id="sel_contact_id">
												<select style="width:100px;" name="contact_id" id="contact_id">
													<option value="">--请选择--</option>
													<?php if(is_array($search_option["contacts"])): $k = 0; $__LIST__ = $search_option["contacts"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$contact_): $mod = ($k % 2 );++$k;?><option value="<?php echo ($contact_['contact_id']); ?>" ><?php echo ($contact_['contact_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
												</select>
											</span>
											<span>关系</span>
											<select style="width:100px;" name="contact_type" id="contact_type">
												<option value="">--请选择--</option>
												<?php if(is_array($search_option["contact_type"])): $k = 0; $__LIST__ = $search_option["contact_type"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type_): $mod = ($k % 2 );++$k;?><option value="<?php echo ($type_['id']); ?>" <?php if($type_['id'] == 4): ?>selected="selected"<?php endif; ?> ><?php echo ($type_['val']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</p>
									</div>
									<div class="person">
										<a href="javascript:void(0);" onclick="showWindow('添加联系人','<?php echo U('/member/add_check_contact');?>',600)">
											<img src="/images/www/icon_lxr.png" width="40px" height="40px"/>添加联系人
										</a>
									</div>	
									 
								</div>
								<!--其他检测结束-->
								
								<br/>
								<input type="checkbox" checked="checked" name="is_search" id="is_search" value="1"  /><span>允许被检索</span>
						   </div>
						  
						   <div class="btn_upload">
							<input type="submit" value="提交" class="current"/>
							<!--  <a href="">上传并检索</a> -->
						   </div>
						   </form>
						</div>
						
					</div>
				    <!--右边内容结束-->
				</div>
			</div>
		</div>
	<!--内容区结束-->

<script type="text/javascript">
$(function(){
	var pid=<?php if($info['province_id'] != ''): echo ($info['province_id']); else: ?>0<?php endif; ?>;  // 默认省份id
	var cid=<?php if($info['city_id'] != ''): echo ($info['city_id']); else: ?>0<?php endif; ?>;  // 默认城市id
	var did=<?php if($info['district_id'] != ''): echo ($info['district_id']); else: ?>0<?php endif; ?>;  // 默认地区id
	var tid=<?php if($info['community_id'] != ''): echo ($info['community_id']); else: ?>0<?php endif; ?>;  // 默认镇乡id

    function change_province(pid){
        $.post("<?php echo U('/member/getArea/area/province');?>", {pid: pid}, function(result){
                $("#J_province").html(result);
            });
        }
    function change_city(p_pid, p_cid){
        $.post('<?php echo U("/member/getArea/area/city");?>', {pid: p_pid, cid: p_cid}, function(result){
            $("#J_city").show().html(result);
        });
    }
    function change_district(p_cid, p_did){
    	$.post('<?php echo U("/member/getArea/area/district");?>', {cid: p_cid, did:p_did}, function(result){
            $("#J_district").show().html(result);
        });
    }
    function change_community(p_did, p_tid){
    	$.post('<?php echo U("/member/getArea/area/community");?>', {did:p_did, tid:p_tid}, function(result){
            $("#J_community").show().html(result);
        });
    }

    change_province(pid);
    change_city(pid,cid);
    change_district(cid,did);
    change_community(did,tid);

	$('#J_province').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g);
	});

	$('#J_city').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_district(pid_g);
	});
	$('#J_district').change(function(){
		var did_g=$(this).children('option:selected').val();
		change_community(did_g );
	});

	// 加载试剂盒位点
	$('#kit_id').val('');
	$('#kit_id').change(function(){
			var kit_id_=$(this).children('option:selected').val();
			$.post("<?php echo U('/gene/ajax_get_locus');?>", {kit_id: kit_id_}, function(result){
             $("#locus_info").html(result);
         });
		});
});

function download_(){
	var kit_id_ = $('#kit_id').val();
	if(kit_id_ == ''){
		alert('请选择试剂盒');
		return false;
	}
	window.location.href = "<?php echo U('/gene/download_template');?>"+"?kit_id="+kit_id_;
}

function show_mj(){
	$('#check_type').val(1);
	$('#mj_').css("display", "block");
	$('#other_').css("display","none");

	$("#li_other").removeClass('current');
	$("#li_mj").addClass('current');
}

function show_other(){
	$('#check_type').val(2);
	$('#mj_').css("display", "none");
	$('#other_').css("display","block");

	$("#li_mj").removeClass('current');
	$("#li_other").addClass('current');
}

</script>



	<!--版权部分开始-->
	<div class="footer clear">
		<div class="f_conten">Copyright © 2004-2015  美吉Majorbio.com 版权所有</div>
	</div>
	<!--版权部分结束-->

</body>
</html>