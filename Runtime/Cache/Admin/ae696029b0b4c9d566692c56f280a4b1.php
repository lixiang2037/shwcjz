<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>美吉寻亲网后台管理系统</title>
    <base target="main_iframe">
    <link href="/style/admin/admin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/javascript/admin/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="/javascript/admin/admin.js"></script>
    <script type="text/javascript" src="/javascript/admin/mybox.js"></script>
</head>

<body>
<div class="header clear">
    <div class="left_top"><h1><a href="http://www.gk.com/" target="_blank">I-Sanger</a></h1><h2>美吉寻亲网后台管理系统</h2></div>
    <div class="right_top">
        <div class="login_info">
            <span>欢迎你，<strong><?php echo session('admin_name');?></strong></span>
            <a title="发送短信" href="javascript:;" onClick="$.fn.sbox({n:'a',title:'发送短信',width:480,height:330,ctype:'url',url:'<?php echo U('index/pub_send_sms');?>'})"><i class="ico_msg"></i></a>
            <a title="发送邮件" href="javascript:;" onClick="$.fn.sbox({n:'a',title:'发送邮件',width:650,height:480,ctype:'url',url:'<?php echo U('index/pub_send_email');?>'})"><i class="ico_email"></i></a>
            <a title="修改密码" href="javascript:;" onClick="$.fn.sbox({n:'a',title:'修改资料',width:400,height:350,ctype:'url',url:'<?php echo U('index/pub_change_password');?>'})"><i class="ico_passport"></i></a>
            <a title="网站首页" href="<?php echo C(WWW_SG_COM);?>" target="_blank"><i class="ico_home"></i></a>
            <a title="退出" href="<?php echo U('auth/logout');?>" target="_top"><i class="ico_logout"></i></a>
            <a title="清除缓存" onClick="clear_cache('')" ><i class="ico_clear"></i></a>
        </div>
        <a class="btn_web" href="http://www.gk.com/" target="_blank"><i class="ico_web"></i>美吉寻亲网后台管理系统</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%" height="100%" id="frm">
    <tr>
        <td align="left" valign="top" width="155" height="100%" id="frm_left">
            <div class="left_menu">
                <?php if( ! empty($submenus)){foreach($submenus as $v){?>
                <!--菜单-->
                <div class="left_top_menu">
                    <?php if($v)foreach($v as $vv){?>
                    <div>
                        <p><?php echo $vv['node_name'];?></p>
                        <ul <?php if($vv['expand'] == '0'){ echo 'style="display:none;"'; }?>>
                            <?php if( ! empty($vv['_child'])){foreach($vv['_child'] as $vvv){ ?>
                            <li><a href="<?php echo U($vvv['m_c_a']);?>"><span class="zs_arrow">&raquo;</span><?php echo $vvv['node_name'];?></a></li>
                            <?php }}?>
                        </ul>
                    </div>
                    <?php }?>
                </div>
                <!--//菜单-->
                <?php }}?>
            </div>
        </td>
        <td align="left" valign="top" height="100%" id="frm_right">
            <div class="top_menu">
                <div class="top_menu_wrap">
                    <?php
 if($topmenus){ $ix=1; foreach($topmenus as $v){ ?>
                    <a href="javascript:;" <?php if($ix === 1){ echo 'class="top_curr"'; }?>><?php echo $v['node_name'];?></a>
                    <?php $ix++;} }?>
                </div>
            </div>
            <div class="act_area">
                <div class="act_area_wrap">
                    <span class="top_bar_b" title="后退" onClick="Gurl('backward')"></span>
                    <span class="top_bar_r" title="刷新" onClick="Gurl('refresh')"></span>
                    <span class="top_bar_f" title="前进" onClick="Gurl('forward')"></span>
                </div>
            </div>
            <iframe src="<?php echo U('index/home');?>" id="main_iframe" name="main_iframe" width="100%" height="100%" frameborder="0" scrolling="yes" style="overflow:visible;"></iframe>
        </td>
    </tr>
</table>
</body>
</html>



<script type="text/javascript">
	//清除缓存
	function clear_cache(){
		$.ajax({
			url:"<?php echo U('index/clear_cache');?>",
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