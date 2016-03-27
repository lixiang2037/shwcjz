				var currFFZoom = 1;
				var currIEZoom = 100;
				var currFFScale = 1;

	$(document).ready(function(){

				var not_ie_width = 0;
				$('#zoom-in').click( function() {
					if (navigator.userAgent.indexOf('Firefox') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Firefox') + 8)) >= 3.6) {//Firefox
						var step = 0.1;
						if(currFFZoom<1){
							currFFZoom += step;
							$('#zoom-out').removeAttr("disabled");
						}else{
							$('#zoom-in').attr("disabled"," disabled");
							return false;
						}
						jsPlumb.setZoom(currFFZoom);
						currFFScale = currFFZoom;
						if (currFFZoom != 1) {
							$('.edit_contain').draggable({disabled:true});
							$('.shape').draggable({disabled:true});
						} else {
							$(".edit_contain").draggable({disabled:false});
							$('.shape').draggable({disabled:false});
						}
						$('.edit_contain').css('MozTransform', 'scale(' + currFFZoom + ')');
						$('.edit_contain').css("-moz-transform-origin"," left top");
						if (currFFScale != 1) {
							$('.mask').fadeIn(1000);
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$(".edit_main").css('overflow', 'hidden');
						} else {
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$('.mask').fadeOut(1000);
							$(".edit_main").css('overflow', 'auto');
						}
					} else {
						var step = 10;
						if(currIEZoom<100){
							currIEZoom += step;
							$('#zoom-out').removeAttr("disabled");
						}else{
							$('#zoom-in').attr("disabled"," disabled");
							return false;
						}

						jsPlumb.setZoom(currIEZoom/100);
						currFFScale = currIEZoom/100;
						if (currFFZoom != 1) {
							$('.edit_contain').draggable({disabled:true});
							$('.shape').draggable({disabled:true});
						} else {
							$(".edit_contain").draggable({disabled:false});
							$('.shape').draggable({disabled:false});
						}
						$('.edit_contain').css('zoom', ' ' + currIEZoom + '%');
						if (currFFScale != 1) {
							$('.mask').fadeIn(1000);
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$(".edit_main").css('overflow', 'hidden');
						} else {
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$('.mask').fadeOut(1000);
							$(".edit_main").css('overflow', 'auto');
						}
					}
				});
				$('#zoom-out').click( function() {
					if (navigator.userAgent.indexOf('Firefox') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Firefox') + 8)) >= 3.6) {//Firefox
						var step = 0.1;
						if(currFFZoom>0.2){
							currFFZoom -= step;
							$('#zoom-in').removeAttr("disabled");
							$('#edit_main').scrollLeft(1);
						}else{
							$('#zoom-out').attr("disabled"," disabled");
							return false;
						}
						
						jsPlumb.setZoom(currFFZoom);
						currFFScale = currFFZoom;
						if (currFFZoom != 1) {
							$('.edit_contain').draggable({disabled:true});
							$('.shape').draggable({disabled:true});
						} else {
							$(".edit_contain").draggable({disabled:false});
							$('.shape').draggable({disabled:false});
						}
						$('.edit_contain').css('MozTransform', 'scale(' + currFFZoom + ')');
						$('.edit_contain').css("-moz-transform-origin"," left top");
						if (currFFScale != 1) {
							$('.mask').fadeIn(1000);
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$(".edit_main").css('overflow', 'hidden');
						} else {
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$('.mask').fadeOut(1000);
							$(".edit_main").css('overflow', 'auto');
						}
					} else {
						var step = 10;
						
						if(currIEZoom>20){
							currIEZoom -= step;
							$('#zoom-in').removeAttr("disabled");
						}else{
							$('#zoom-out').attr("disabled"," disabled");
							return false;
						}
						
						jsPlumb.setZoom(currIEZoom/100);
						currFFScale = currIEZoom/100;
						if (currFFZoom != 1) {
							$('.edit_contain').draggable({disabled:true});
							$('.shape').draggable({disabled:true});
						} else {
							$(".edit_contain").draggable({disabled:false});
							$('.shape').draggable({disabled:false});
						}
						$('.edit_contain').css('zoom', ' ' + currIEZoom + '%');
						if (currFFScale != 1) {
							$('.mask').fadeIn(1000);
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$(".edit_main").css('overflow', 'hidden');
						} else {
							$('.mask').find('span').html(parseInt(currFFScale * 100) +'%');
							$('.mask').fadeOut(1000);
							$(".edit_main").css('overflow', 'auto');
						}
					}
					
				});

});