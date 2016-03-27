
$(function() {
	
	// 验证用户名(邮箱)
	$("#user_name_email").blur(function(){
		var user_name_ = $('#user_name_email').val();
		if(checkEmail(user_name_))
		{
			// 验证邮箱是否存在
		    $.ajax({
		        url:'/user/check_email',
		        data:({'user_name':user_name_}),
		        type:'post',
		        success:function(msg){
		            if(msg.success == '1')
			        {
			            $('#tip_user_name').html('<i class="ico_error password_icon"></i>');
			            $("#get_verify_button").css("display","inline"); 
		            }else if(msg.success == '3')
			        {
		            	$('#tip_user_name').html('<i class="ico_error"></i>该邮箱已为注册用户，请重新输入或使用该邮箱直接<a href="/user/login">登录</a>');
		            	$("#get_verify_button").css("display","none"); 
		            }else if(msg.success == '4')
		            {
		            	$('#tip_user_name').html('<i class="ico_error"></i>该邮箱已为绑定邮箱，请重新输入');
		            	$("#get_verify_button").css("display","none"); 
		            }else
		            {
			            alert(msg.message);
		            }
		        },
		        error:function(){
		            alert('系统出错!');
		        }
		    })
		}	
	});
	
	// 验证用户名(手机号码)
	$("#user_name_mobile").blur(function(){
		var user_name_ = $('#user_name_mobile').val();
		if(checkMobile(user_name_))
		{
			// 验证手机号码是否存在
		    $.ajax({
		        url:'/user/check_mobile',
		        data:({'user_name':user_name_}),
		        type:'post',
		        success:function(msg){
		            if(msg.success == '1')
			        {
			            $('#tip_user_name').html('<i class="ico_error password_icon"></i>');
			            $("#get_verify_button").css("display","inline"); 
		            }else if(msg.success == '3')
			        {
		            	$('#tip_user_name').html('<i class="ico_error"></i>该手机号码已为注册用户，请重新输入或使用该号码直接<a href="/user/login">登录</a>');
		            	$("#get_verify_button").css("display","none"); 
		            }else if(msg.success == '4')
		            {
		            	$('#tip_user_name').html('<i class="ico_error"></i>该手机号码已为绑定手机，请重新输入');
		            	$("#get_verify_button").css("display","none"); 
		            }else
		            {
			            alert(msg.message);
		            }
		        },
		        error:function(){
		            alert('系统出错!');
		        }
		    })
		}	
	});

	// 验证密码
	$("#password").blur(function(){
		var password_ = $('#password').val();
		checkPassword1(password_);
	});

	// 验证确认密码
	$("#passwordconfirm").blur(function(){
		checkPasswordconfirm();
	});
	
	// 验证码
	$("#verify").blur(function(){
		var verify_ = $('#verify').val();
		if(checkVerify(verify_)){
			// 验证验证码
		    $.ajax({
		        url:'/user/check_verify',
		        data:({'verify':verify_}),
		        type:'post',
		        success:function(msg){
		            if(msg.success == '1')
			        {
		            	$('#tip_verify').html('');
		            }else
		            {
		    			$('#tip_verify').html('<i class="ico_error"></i>验证码不正确');
		            }
		        },
		        error:function(){
		            alert('系统出错!');
		        }
		    })
		}
	});
	
	
	// 验证登录用户名
	$("#user_name_login").blur(function(){
		var user_name_ = $('#user_name_login').val();
		if(checkUsername(user_name_)){
			$('#tip_user_name').html('');
		}
	});
	
	// 验证登录的密码
	$("#password_login").blur(function(){
		var password_ = $('#password_login').val();
		if(checkPassword1(password_)){
			$('#li_password').addClass('correct');
			$('#tip_password').html('');
		}
	});
	
	// 验证找回密码的密码
	$("#password_retrieve").blur(function(){
		var password_ = $('#password_retrieve').val();
		if(checkPassword1(password_)){
			$('#li_password').addClass('correct');
			$('#tip_password').html('<div class="tip"><i class="ico_correct"></i></div>');
		}
	});
	
	
	// 验证登录验证码
	$("#verify_login").blur(function(){
		var verify_ = $('#verify_login').val();
		if(checkVerify(verify_)){
			$('#li_verify').addClass('correct');
        	$('#tip_verify').html('');
		}
	});
}) 

// 验证邮箱
function checkEmail(user_name_) {

	var checkemail = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;

	if (user_name_ == '') {
		$('#tip_user_name').html('<i class="ico_error"></i>请填写邮箱');
		return false;
	} else if (!checkemail.test(user_name_)) {
		$('#tip_user_name').html('<i class="ico_error"></i>请填写正确的邮箱');
		return false;
	}
	return true;
}

//验证手机号
function checkMobile(user_name_) {
	var checkmobile = /(^1+(\d){10}$)|(^0+(\d){11}$)/;
	if (user_name_ == '') {
		$('#tip_user_name').html('<i class="ico_error"></i>请填写手机号码');
		return false;
	} else if (!checkmobile.test(user_name_)) {
		$('#tip_user_name').html('<i class="ico_error"></i>请填写正确的手机号码');
		return false;
	}
	return true;
}

// 验证登录用户名
function checkUsername(user_name_){
	var checkemail = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
	var checkmobile = /(^1+(\d){10}$)|(^0+(\d){11}$)/;
	
	if (user_name_ == '') {
		$('#tip_user_name').html('<i class="ico_error"></i>请填写用户名(邮箱或手机号码)');
		return false;
	} else if (!checkemail.test(user_name_)) {
		if(!checkmobile.test(user_name_)){
			$('#tip_user_name').html('<i class="ico_error"></i>请正确填写用户名(邮箱或手机号码)');
			return false;
		}else {
	        $('#tip_user_name').html('');
			return true;
		}
	} else {
        $('#tip_user_name').html('');
		return true;
	}
	
}

// 验证密码(简单)
function checkPassword1(password_){
	var checkpassword = /^\w{5,15}$/;
	
	// /^[a-zA-Z]\w{5,15}$/; 密码必须以字母开头，长度在6-16之间，只能包含字母、数字和下划线

	if (password_ == '') {
		$('#tip_password').html('<i class="ico_error"></i>请填写密码');
		return false;
	} else if (!checkpassword.test(password_)) {
		$('#tip_password').html('<i class="ico_error"></i>密码长度在6-16之间，只能包含字母、数字和下划线');
		return false;
	}
	$('#tip_password').html('');
	return true;
}

// 验证密码(区分密码强度)
function checkPassword(password_) {
	if(checkPassword1(password_)) {
//		var lv = -1;
//		if (password_.match(/[a-z]/ig)) {
//			lv++;
//		}
//		if (password_.match(/[0-9]/ig)) {
//			lv++;
//		}
//		if (password_.match(/(.[^a-z0-9])/ig)) {
//			lv++;
//		}
//		var intensity = '<div class="tip"><ul class="psw_state"><li class="weak">弱</li><li>中</li><li>强</li></ul></div>';
//		switch (lv) {
//			case 0:
//				intensity = '<div class="tip"><ul class="psw_state"><li class="weak">弱</li><li>中</li><li>强</li></ul></div>';
//				break;
//			case 1:
//				intensity = '<div class="tip"><ul class="psw_state"><li>弱</li><li class="normal">中</li><li>强</li></ul></div>';
//				break;
//			case 2:
//				intensity = '<div class="tip"><ul class="psw_state"><li>弱</li><li>中</li><li class="strong">强</li></ul></div>';
//				break;
//			default:
//				intensity = '<div class="tip"><ul class="psw_state"><li class="weak">弱</li><li>中</li><li>强</li></ul></div>';
//		}
//		$('#li_password').addClass('correct');
//		$('#tip_password').html(intensity);
		return true;
	}
}

// 验证密码确认
function checkPasswordconfirm() {
	var passwordconfirm_ = $('#passwordconfirm').val();
	var password_ = $('#password').val();
	if (passwordconfirm_ == '') {
		$('#tip_passwordconfirm').html('<i class="ico_error"></i>请填写确认密码');
		return false;
	} else if (passwordconfirm_ != password_) {
		$('#tip_passwordconfirm').html('<i class="ico_error"></i>两次密码输入不一致');
		return false;
	} else {
		$('#tip_passwordconfirm').html('');
		return true;
	}
}

// 验证验证码
function checkVerify(verify_) {
	if (verify_ == '') {
		$('#tip_verify').html('<i class="ico_error"></i>请填写验证码');
		return false;
	}
	return true;
}


// 通过邮箱获取 验证码
function getVerifyByEmail(){
	$('#verify').val('');
	$('#tip_verify').html('');
	var email_ = $('#user_name_email').val();
	// 检查邮箱
	if(!checkEmail(email_)){
		return false;
	}
	$('#get_verify_button').html('<a href="javascript:void(0)" class="btn btn_disabled">发送中...</a>');

	// 获取验证码
	$.ajax({
		url : '/user/get_verify_email',
		data : ({
			'email' : email_
		}),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#get_verify_button').html('<span id="time" color="red;">60</span>秒钟后可重新获取');
				$('#tip_verify').html('<p class="m-tip">验证码已发送</p>');
				setTimeout("ch_verify_button(1);", 1000);
			} else {
				alert(msg.message);
				$('#get_verify_button').html('<a href="javascript:void(0)" onclick="getVerifyByEmail();" class="btn">获取邮箱验证码</a>');
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

// 通过手机短信获取验证码
function getVerifyByMobile(){
	$('#verify').val('');
	$('#tip_verify').html('');
	var mobile_ = $('#user_name_mobile').val();
	// 检查手机号码
	if(!checkMobile(mobile_)){
		return false;
	}
	$('#get_verify_button').html('<a href="javascript:void(0)" class="btn btn_disabled">发送中...</a>');
	// 获取验证码
	$.ajax({
		url : '/user/get_verify_mobile',
		data : ({
			'mobile' : mobile_
		}),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#get_verify_button').html('<span id="time" color="red;">60</span>秒钟后可重新获取');
				$('#tip_verify').html('<p class="m-tip">验证码已发送</p>');
				setTimeout("ch_verify_button(2);", 1000);
			} else {
				alert(msg.message);
				$('#get_verify_button').html('<a href="javascript:void(0)" onclick="getVerifyByMobile();" class="btn">获取短信验证码</a>');
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

// 60秒后，重新获取验证码
function ch_verify_button(reg_type){
	var time_ = parseInt($('#time').html());
	if(time_ > 0)
	{
		$('#time').html(time_-1);
		setTimeout("ch_verify_button("+reg_type+");",1000);
	}else
	{
		if(reg_type == 1)
			$('#get_verify_button').html('<a href="javascript:void(0)" onclick="getVerifyByEmail();" class="btn">获取邮箱验证码</a>');
		if(reg_type == 2)
			$('#get_verify_button').html('<a href="javascript:void(0)" onclick="getVerifyByMobile();" class="btn">获取短信验证码</a>');
		$('#tip_verify').html('');
		return null;
	}
}

// 注册表单验证
function checkForm(reg_type){
	if (reg_type == '1' && !checkEmail($('#user_name_email').val()))
		return false;

	if (reg_type == '2' && !checkMobile($('#user_name_mobile').val()))
		return false;

	if (!checkPassword($('#password').val()))
		return false;

	if (!checkPasswordconfirm())
		return false;

	if (!checkVerify($('#verify').val()))
		return false;

	// 异步注册
	$.ajax({
		url : '/user/ajax_register',
		data : $('#myform').serialize(),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				// alert(msg.message);
				//syncLogin(msg.token, msg.return_url, msg.sub_domain,msg.message);
				location.href = msg.return_url;
			} else {
				alert(msg.message);
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

// 登录表单验证
function checkLoginForm(){
	// 用户名
	var user_name_ = $('#user_name_login').val();
	if(!checkUsername(user_name_))
		return false;
	$('#tip_user_name').html('');
	$('#tip_password').html('');
	$("#error_msg").css("display","none"); 

	// 密码
	var password_ = $('#password_login').val();
	if(!checkPassword1(password_))
		return false;
	
	// 验证码
//	var verify_ = $('#verify_login').val();
//	if(!checkVerify(verify_))
//		return false;
	
	return true;
	
	/*
    $.ajax({
        url:'/user/login',
        data:$('#myform').serialize(),
        type:'post',
        success:function(msg){
            if(msg.success == '1'){
//            	alert('登录成功');
            	location.href = msg.return_url;
//	            syncLogin(msg.token,msg.return_url,msg.sub_domain,'登录成功');
            }else{
                $("#error_msg").css("display","block"); 
                $('#error_msg').html('<p class="m-tip"><em></em>'+msg.message+'</p>');
                // 清除用户名和验证码
                $('#password_login').val('');
//                $('#verify_login').val('');
//                fleshVerify();
            }
        },
        error:function(){
            alert('系统出错!');
        }
    })
    */
}

// 找回密码表单验证
function checkRetrieveForm(){
	// 用户名
	var user_name_ = $('#user_name_re').val();
	if(!checkUsername(user_name_))
		return false;
	
	// 验证码
	var verify_ = $('#verify_re').val();
	if(!checkVerify(verify_))
		return false;
	
	return true;
}

// 切换找回密码方式
function changeRetrieveType(){
	if($('#retrieve_type').val() == '1'){
		$('#type_email').css("display","block");
		$('#type_mobile').css("display","none");
	}else if($('#retrieve_type').val() == '2'){
		$('#type_email').css("display","none");
		$('#type_mobile').css("display","block");
	}
}

// 找回密码获取验证码
function getRetrieveVerify(){
	$('#verify').val('');
	$('#tip_verify').html('');
	var retrieve_type_ = $('#retrieve_type').val();
	var bind_email_ = $('#bind_email').val();
	var bind_mobile_ = $('#bind_mobile').val();

	$('#get_verify_button').html('<a href="javascript:void(0)" class="btn btn_disabled">发送中...</a>');

	// 获取验证码
	$.ajax({
		url : '/user/get_retrieve_verify',
		data : ({
			'retrieve_type' : retrieve_type_,
			'bind_email' : bind_email_,
			'bind_mobile' : bind_mobile_,
		}),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#get_verify_button').html('<span id="time">60</span>秒钟后可重新获取');
				$('#tip_verify').html('<div class="tip">验证码已发送</div>');
				setTimeout("ch_retrieve_verify_button();", 1000);
			} else {
				alert(msg.message);
				$('#get_verify_button').html('<input type="button" onclick="getRetrieveVerify();" value="获取验证码" class="btn" >');
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

//60秒后，重新获取找回密码 验证码
function ch_retrieve_verify_button(){
	var time_ = parseInt($('#time').html());
	if(time_ > 0)
	{
		$('#time').html(time_-1);
		setTimeout("ch_retrieve_verify_button();",1000);
	}else
	{
		$('#get_verify_button').html('<input type="button" onclick="getRetrieveVerify();" value="获取验证码" class="btn" >');
		$('#tip_verify').html('');
		return null;
	}
}

//找回密码-验证身份表单验证
function checkRetrieveValidateForm(){
	if (!checkVerify($('#verify').val()))
		return false;
	return true;
}

// 找回密码-重置密码表单验证
function checkResetPasswordForm(){
	var password_ = $('#password_retrieve').val();
	var passwordconfirm_ = $('#passwordconfirm_retrieve').val();
	if(!checkPassword1(password_))
		return false;
	if(passwordconfirm_ == ''){
		$('#tip_passwordconfirm').html('<i class="ico_error"></i>请输入确认密码');
		return false;
	}
	if(password_ != passwordconfirm_){
		$('#tip_passwordconfirm').html('<i class="ico_error"></i>两次密码输入不一致');
		return false;
	}
	return true;
}


// 注册成功后，同步登录
function syncLogin(token, return_url, sub_domain, message) {
	for (i = 0; i < sub_domain.length; i++) {
		$.getJSON(sub_domain[i] + "/auth/sync_login?token=" + token + "&t="+ new Date() + "&callback=?", function(json) {
			return null;
		});
	}
//	alert(message);
	setTimeout(function(){ location.href = return_url; }, 1500);
	
}

// 获取验证码
function fleshVerify(){
    var timenow = new Date().getTime();
    document.getElementById('verifyImg').src="/user/verify"+"?timenow="+timenow;
}

// 检查字符串为空
function checkBlank(obj, error_obj, msg) {
	if (obj.val() == '') {
		error_obj.html(msg);
		return false;
	}
	return true;
}

// 清除错误
function clear_error_info(error_obj) {
	error_obj.html('');
}

var userAgent = navigator.userAgent,   
rMsie = /(msie\s|trident.*rv:)([\w.]+)/;
function checkIeVersion(ua){  
    var match = rMsie.exec(ua); 
    var version = '';
    if (match != null){  
    	version = match[2] || "0";  
    }
   
    if(version == '7.0' || version == '6.0'){
    	showWindow('IE浏览器版本低','/user/ie_check',700);
    }
}  
checkIeVersion(userAgent.toLowerCase());

