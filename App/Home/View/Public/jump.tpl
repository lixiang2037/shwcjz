<include file="Inc/header" />
<link rel="stylesheet" href="/style/internal.css" type="text/css"/>

<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
	
	<div class="cont_wrap">
		<div class="main">
		
			<?php if(isset($message)) {?>
				<img src="/images/www/over_icon.jpg"/>
				<p><?php echo($message); ?>，页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p>
			<?php }else{?>
				<h3><?php echo($error); ?></h3>
				<p>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></p>
			<?php }?> 
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

<include file="Inc/footer" />