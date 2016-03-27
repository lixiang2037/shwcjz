$(document).ready(function(){
    //加载完成只显示左边第一个菜单
    $('.left_top_menu:gt(0)').hide();

    //顶部菜单
    $('.top_menu a').click(function(){
        //顶部菜单高亮选中
        $(this).addClass('top_curr').siblings().removeClass('top_curr');
        var ind = $(this).index();
        //左边菜单相应隐藏
        $('.left_top_menu').hide();//先都隐藏
        $('.left_top_menu:eq('+ind+')').show();//单独显示
    })

    //左边菜单折叠
    $('.left_top_menu div p').click(function(){
        if($(this).next('ul').is(":hidden")){
            $(this).removeClass('left_menu_on');
            $(this).next('ul').slideDown(100);
        }else{
            $(this).addClass('left_menu_on');
            $(this).next('ul').slideUp(50);
        }
    });

    //左边菜单a标签点击高亮
    $('.left_top_menu div ul li a').click(function(){
        $('.left_top_menu div ul li a').removeClass('left_curr');//先都去掉left_curr
        $(this).addClass('left_curr');//单独添加left_curr
    });

    //鼠标经过table.tr换颜色
    $('.mytable tr:gt(0)').hover(function(){
        $(this).css("background","#F8FDFE");
    },function(){
        $(this).css("background","");
    })

    judgeFrame();
    $(window).resize(function(){judgeFrame();});
});
//调整iframe的高度( - 125 是指顶部菜单区的高度)
function judgeFrame()
{
    $('#main_iframe').height($(window).height() - 125);
}
//控制main_iframe前进、后退、刷新
function Gurl(key){
    if(!key){key = 'backward';}
    var obj = window.top.frames.main_iframe;
    switch (key){
        case 'backward' :
            obj.history.back();
            break;
        case 'forward' :
            obj.history.forward();
            break;
        case 'refresh' :
            obj.location.reload();
            break;
    }
}
//全选
function checkAll(obj, n){
    var flag = false;
    if(obj.checked == true){flag = true;}
    checkAllCheckBox(n, flag);
}
//
function checkAllCheckBox(n, flag)
{
    n = $.trim(n); if(n == ''){ return; }
    if(flag!== true && flag!==false){ flag = false; }
    var names = document.getElementsByName(n);
    var len = names.length;
    for(var i=0; i<len; i++){
        names[i].checked = flag;
    }
}
//tr
function showHideTr(id)
{
    if($('#hide_tr_'+id).is(":hidden")){
        $('#the_td_'+id).addClass('plus_sub_on');
        $('#hide_tr_'+id).slideDown(200);
    }else{
        $('#the_td_'+id).removeClass('plus_sub_on');
        $('#hide_tr_'+id).slideUp(10);
    }
}








