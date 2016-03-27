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