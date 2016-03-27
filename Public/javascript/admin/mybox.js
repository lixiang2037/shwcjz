(function($){
    $.extend($.fn, {
        //扩展：弹框
        sbox : function(setting){
            var op = $.extend({
                title : '标题',
                content : '内容',
                ctype : 'common',
                width : 300,
                height : 200,
                mask : true,
                drag : true,
                pos : 'center',//center,rightdown
                fix : false,
                url : '',
                n : 1,
                cha : 30,
				type: 'post'
            }, setting);
            //
            var sn = op.n;
            if($("#popbox"+sn).length > 0){ return false;}
            //模板
            var tpl = $('<div class="popbox" id="popbox'+sn+'"><div class="popboxtop" id="popboxtop'+sn+'"><span class="popboxtopclose" id="popboxtopclose'+sn+'">&times;</span><span class="popboxtoptitle" id="popboxtoptitle'+sn+'"></span><div style="clear:both;"></div></div><div class="popboxcontent" id="popboxcontent'+sn+'"></div></div>');
            //调整位置
            var position = function(){
                var fix = op.fix ? 'fixed' : 'absolute';
                if(op.pos == 'rightdown'){/*右下*/
                    $('#popbox'+sn).css({'position':fix, 'right':0, 'bottom':0, 'width':op.width, 'height':op.height});
                }else{/*默认居中*/
                    var left = ($(window).scrollLeft() + $(window).width()/2 - (op.width/2))+'px';
                    var top = ($(window).scrollTop() + $(window).height()/2 - (op.height/2))+'px';
                    $('#popbox'+sn).css({'position':fix, 'top':top, 'left':left, 'width':op.width, 'height':op.height});
                }
                $('#popboxcontent'+sn).css({height:(op.height-op.cha)+'px'});
            }
            //填充内容
            var content = function(){
                $('#popboxtoptitle'+sn).html(op.title);
                if(op.ctype == 'url'){/*ajax请求*/
                    if(!op.url){$('#popboxcontent'+sn).html('请确认url地址');return;}
                    $.ajax({
                        url:op.url,
                        beforeSend : function(){$('#popboxcontent'+sn).html('加载中...');},
                        type : op.type,
                        success : function(msg){$('#popboxcontent'+sn).html(msg);},
                        error : function(){$('#popboxcontent'+sn).html('加载失败:(');}
                    });
                }else if(op.ctype == 'id'){
                    $('#popboxcontent'+sn).html($('#'+op.content).html());
                }else{/*默认*/
                    $('#popboxcontent'+sn).html(op.content);
                }
            }
            //关闭
            var closed = function(){
                $('#popboxtopclose'+sn).bind('click', function(){
                    setTimeout("$('#maskLayer').fadeOut(500)",0);
                    setTimeout("$('#popbox"+sn+"').fadeOut(500)",0);
                    setTimeout("$('#maskLayer').remove()",500);
                    setTimeout("$('#popbox"+sn+"').remove()",500);
                });
            }
            //拖拽
            var dragMove = function(){
                $('#popboxtop'+sn).mousedown(function(e){
                    var e = e || window.event;
                    if(!op.drag || op.pos=='rightdown'){return;}
                    leftD = e.clientX - $('#popbox'+sn).offset().left;
                    topD = e.clientY - $('#popbox'+sn).offset().top;
                    $(document).mousemove(function(e){
                        $('#popbox'+sn).css({left:(e.clientX - leftD),top:(e.clientY - topD)});
                    });
                });
                $('#popboxtop'+sn).mouseup(function(){
                    $(document).unbind(	"mousemove");
                });
            }
            //弹出
            var popout = function(){
                if(op.mask){ if($('#maskLayer').length <= 0){ $.fn.maskLayer(); } }
                $("body").prepend(tpl);
                position();
                content();
                closed();
                if(op.drag){ dragMove(); }
            }
            //执行弹出
            popout();
        },
        //扩展：遮罩
        maskLayer : function(color){
            if(!color){color='#000000';}
            var tmpMask = $('<div id="maskLayer"></div>');
            tmpMask.css({
                /*'width':$(document).width()+'px',*/
                'width':'100%',
                'height':$(document).height()+'px',
                'position':'absolute',
                'top':'0px',
                'left':'0px',
                'z-index':'60',
                'background-color':color,
                'filter':'alpha(opacity=10)',
                'opacity':'0.1'
            });
            $("body").prepend(tmpMask);
        }
    })
})(jQuery);

//关闭所有弹窗
function clearPopoutBox(){
    setTimeout("$('#maskLayer').fadeOut(500)",0);
    setTimeout("$('.popbox').fadeOut(500)",0);
    setTimeout("$('#maskLayer').remove()",500);
    setTimeout("$('.popbox').remove()",500);
}

//关闭遮罩层
function clearMaskLayer()
{
    setTimeout("$('#maskLayer').fadeOut(500)", 0);
    setTimeout("$('#maskLayer').remove()", 500);
}