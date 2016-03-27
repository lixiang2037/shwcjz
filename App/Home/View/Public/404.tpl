<include file="Inc/header" />
<div class="main jump_page">
	<div class="box_shadow">
		<div class="contain clear">
			<div class="jump jump_error">
				<i class="ico ico_tip"></i>
				<div class="con">
					<h3>哎呀，您访问的页面不存在！</h3>
					<p>页面自动<a id="href" href="/index/index">跳转</a>&nbsp;&nbsp;等待时间：<b id="wait">3</b>秒</p>
				</div>  
			</div>
		</div>
	</div>
</div>
<include file="Inc/footer" />

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