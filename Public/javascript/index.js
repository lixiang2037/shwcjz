//=======广告轮播图的实现=======
	var _index=0;
	var timePlay=null;
	$("#banner .img_list").eq(0).show().siblings("div").hide();

	$("ul.button li").hover(function(){
		clearInterval(timePlay);
		_index=$(this).index();

		$(this).addClass("hover").siblings().removeClass("hover");
 
		$("#banner .img_list").eq(_index).fadeIn().siblings("div").fadeOut();
	},function(){
		autoPlay();
	});

	//自动轮播

	function autoPlay(){

		timePlay=setInterval(function(){
			_index++;
			if(_index<4){
				if(_index==3){_index=-1; }
				$("ul.button li").eq(_index).addClass("hover").siblings().removeClass("hover");
				$("#banner .img_list").eq(_index).fadeIn().siblings("div").fadeOut();
				 
			}else{_index=-1;}
		},2000);	
	};
	autoPlay();


//=======立马注册 ======= 
$(function(){
	var iHeight = $(document).height()-$(window).height();
	var oFixBox = $('.fixedbox');

	
	$(window).scroll(function(){

		if($(this).scrollTop()>=iHeight){
			oFixBox.css({bottom:45});	
		}else{
			oFixBox.css({bottom:0});
		}		
	});
	
});

