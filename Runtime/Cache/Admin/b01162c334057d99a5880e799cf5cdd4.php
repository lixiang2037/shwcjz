<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
*{ padding: 0; margin: 0; }
a{color: #3399cc;}
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.clear:after{content:".";display:block;clear:both;height:0px;visibility:hidden;}
.clear{zoom:1;}
.hint_box{width: 400px;margin:50px auto;border:1px solid #1682b1;border-radius: 5px;}
.hint_box .title{height:30px;background: #1682b1;}
.hint_box .title h3{line-height:30px;font-weight: normal;font-size: 14px;padding: 0 10px;color: #fff;}
.hint_box .con{padding: 50px 0;}
.jump .ico_tip{float:left;height:80px;width:80px;display:inline;margin-left:60px;background: url(/images/admin/ico_tip.gif) no-repeat}
.jump .contain{display:inline;float:left;margin:10px 0 0 20px;width:200px;}
.jump .contain h3{color:#6dba39;font-family:Microsoft YaHei;font-size:20px;font-weight:normal;margin-bottom:10px;}
.jump .contain p{color:#999;font-size:14px;}
.jump_error .ico_tip{background-position:-80px 0;}
.jump_error .contain h3{color:#da4e49;}
</style>
<div class="hint_box">
	<div class="title"><h3>提示信息</h3></div>
	<div class="con">
		<div class="jump jump_error clear">
			<i class="ico_tip"></i>
			<div class="contain">
				<h3>404,页面没找到！</h3>
				<p>页面自动<a id="href" href="/index/home">跳转</a>&nbsp;&nbsp;等待时间：<strong id="wait"><?php echo($waitSecond); ?></strong>秒
				</p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>