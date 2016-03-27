// 获取长度 (区分中英文)
function getLength(str) { 
    var cArr = str.match(/[^\x00-\xff]/ig); 
    return str.length + (cArr == null ? 0 : cArr.length); 
}  

// 个人基本信息表单验证
// function checkInfoForm(){
// 	var real_name_ = $('#real_name').val();
	
	
// 	var nick_name_ = $('#nick_name').val();
	
// 	var email_ = $('#email').val();
// 	var mobile_ = $('#mobile').val();
// 	var qq_ = $('#qq').val();

// 	var checkmobile = /(^1+(\d){10}$)|(^0+(\d){11}$)/;
// 	var checkemail  = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
	
	
// 	if(email_ != '' && !checkemail.test(email_)){
// 		$('#li_email').addClass('error');
// 		$('#tip_email').html('<div class="tip"><i class="ico_error"></i>请填写正确邮箱</div>');
// 		return false;
// 	}
// 	if(mobile_ != '' && !checkmobile.test(mobile_)){
// 		$('#li_mobile').addClass('error');
// 		$('#tip_mobile').html('<div class="tip"><i class="ico_error"></i>请填写正确手机号码</div>');
// 		return false;
// 	}
// 	if(qq_ != ''){
// 		if(getLength(qq_)>12 || getLength(qq_)<4){
// 			$('#li_qq').addClass('error');
// 			$('#tip_qq').html('<div class="tip"><i class="ico_error"></i>请填写正确QQ号码</div>');
// 			return false;
// 		}
// 	}
// 	if(getLength(real_name_)>3){
// 		$('#tip_real_name').html('<div class="t_m">真实姓名不超过30个字符</div>');
// 		return false
// 	}
// 	/*
// 	if(getLength(nick_name_)>30){
// 		$('#li_nick_name').addClass('error');
// 		$('#tip_nick_name').html('<div class="tip"><i class="ico_error"></i>昵称不超过30个字符</div>');
// 		return false;
// 	}
// 	*/
// 	return true;
// }
function checkInfoForm(){
	var real_name = $.trim($('#real_name').val());
	var byear = $.trim($('#byear').val());
	var bmonth = $.trim($('#bmonth').val());
	var bday = $.trim($('#bday').val());



	if(real_name == ''){
		$("#tip_real_name").html("<div class='tip'><i class='ico_error'></i>请填写联系人名称</div>");
		return false;
	}else if(!/^([\u4e00-\u9fa5]){2,5}$/.test(real_name) ){
		$("#tip_real_name").html("<div class='tip'><i class='ico_error'></i>请输入正确的中文姓名</div>");
		return false;
	}
	else{
		$("#tip_real_name").html("");
	}

	var month = new Date().getMonth()+1;
	var year = new Date().getFullYear();
	var day = new Date().getDate();

	//验证生日
	if(!byear == ''){
		if(bmonth =='' || bday ==''){
			$("#tip_birthday").html("<div class='tip'><i class='ico_error'></i>请选择完整的出身日期</div>");
			return false;
		}
	}else{
		$("#tip_birthday").html("");
	}
	if(byear == ''){
		if(!bmonth == '' || !bday == ''){
			$("#tip_birthday").html("<div class='tip'><i class='ico_error'></i>请选择完整的出身日期</div>");
			return false;
		}
	}else{
		$("#tip_birthday").html("");
	}
	//选择的时间大于实际时间
	if(!byear == '' && byear == year ){
		if (bmonth > month) {
			$("#tip_birthday").html("<div class='tip'><i class='ico_error'></i>请选择正确的出身日期</div>");
			return false;
		}else if(bday > day){
			$("#tip_birthday").html("<div class='tip'><i class='ico_error'></i>请选择正确的出身日期</div>");
			return false;
		}
	}else{
		$("#tip_birthday").html("");
	}

	//验证城市
	if(!$('#J_province').val() == ''){
		if($('#J_city').val() == '' || $('#J_district').val() == ''){
			$("#tip_address").html("<div class='tip'><i class='ico_error'></i>地址选择不完整！请重新选择</div>");
			return false;
		}
	}else{
		$("#tip_address").html("");
	}
	return true;
}
// 修改密码表单验证
function checkPwForm() {
	$('#tip_password').html('');
	$('#tip_password1').html('');
	$('#tip_password2').html('');

	var checkpassword = /^\w{5,15}$/;

	var password_ = $('#password').val();
	var password1_ = $('#password1').val();
	var password2_ = $('#password2').val();

	if (password_ == '') {
		$('#tip_password').html('<i class="ico_error"></i>请填写密码');
		return false;
	}
	if (password1_ == '') {
		$('#tip_password1').html('<i class="ico_error"></i>请填写新密码');
		return false;
	}
	if (password2_ == '') {
		$('#tip_password2').html('<i class="ico_error"></i>请填写确认新密码');
		return false;
	}
	var error_info = '密码长度在6-16之间，只能包含字母、数字和下划线';
	if (!checkpassword.test(password_)) {
		$('#tip_password').html('<i class="ico_error"></i>' + error_info);
		return false;
	}
	if (!checkpassword.test(password1_)) {
		$('#tip_password1').html('<i class="ico_error"></i>' + error_info);
		return false;
	}
	if (!checkpassword.test(password2_)) {
		$('#tip_password2').html('<i class="ico_error"></i>' + error_info);
		return false;
	}
	if (password1_ != password2_) {
		$('#tip_password2').html('<i class="ico_error"></i>新密码和确认新密码不一致，请确认');
		return false;
	}
	if (password_ == password1_) {
		$('#tip_password1').html('<i class="ico_error"></i>新密码和旧密码相同，请确认');
		return false;
	}
	return true;
}

// 绑定邮箱表单验证
function checkBindEmailForm() {
	var email_ = $('#bind_email').val();
	if (email_ == '') {
		$('#li_bind_email').addClass('error');
		$('#tip_bind_email').html('<div class="tip"><i class="ico_error"></i>请填写邮箱地址</div>');
		return false;
	}
	var checkemail = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
	if (!checkemail.test(email_)) {
		$('#li_bind_email').addClass('error');
		$('#tip_bind_email').html('<div class="tip"><i class="ico_error"></i>请填写正确邮箱</div>');
		return false;
	}
	return true;
}

//验证手机号
function checkMobile(mobile_) {
	var checkmobile = /(^1+(\d){10}$)|(^0+(\d){11}$)/;

	if (mobile_ == '') {
		$('#tip_bind_mobile').html('<i class="ico_error"></i>请填写手机号码');
		//alert('请填写手机号码');
		return false;
	} else if (!checkmobile.test(mobile_)) {
		//alert('请填写正确的手机号码');
		$('#tip_bind_mobile').html('<i class="ico_error"></i>请填写正确的手机号码');
		return false;
	}else{
		$('#tip_bind_mobile').html('');
	}
	return true;
}

function checkEmail(user_name_) {

	var checkemail = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;

	if (user_name_ == '') {
		alert('请填写邮箱');
//		$('#tip_user_name').html('<p class="m-tip" ><em></em>请填写邮箱</p>');
		return false;
	} else if (!checkemail.test(user_name_)) {
		alert('请填写正确的邮箱');
//		$('#tip_user_name').html('<p class="m-tip" ><em></em>请填写正确的邮箱</p>');
		return false;
	}
	return true;
}

//验证验证码
function checkVerify(verify_) {
	if (verify_ == '') {
		//alert('请填写验证码');
		$('#tip_verify').html('<div class="tip"><i class="ico_error"></i>请填写验证码</div>');
		return false;
	}else{
		$('#tip_verify').html('');
	}
	return true;
}

//通过邮箱获取 验证码
function getVerifyByEmail(){
	$('#verify').val('');
	$('#tip_verify').html('');
	var email_ = $('#bind_email').val();
	// 检查邮箱
	if(!checkEmail(email_)){
		return false;
	}
	$('#get_verify_button').html('<a href="javascript:void(0)" class="btn btn_disabled">发送中...</a>');

	// 获取验证码
	$.ajax({
		url : '/member/bind_email_verify',
		data : ({
			'email' : email_
		}),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#get_verify_button').html('<span id="time" color="red;">60</span>秒钟后可重新获取');
				$('#tip_verify').html('<span style="color:red;">验证码已发送</span>');
				setTimeout("ch_verify_button(1);", 1000);
			} else {
				alert(msg.message);
				$('#get_verify_button').html('<input type="button" value="获取邮箱验证码" onclick="getVerifyByEmail();" class="btn" />');
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

//通过手机短信获取验证码
function getVerifyByMobile(){
	$('#verify').val('');
	$('#tip_verify').html('');
	var mobile_ = $('#bind_mobile').val();
	// 检查手机号码
	if(!checkMobile(mobile_)){
		return false;
	}
	$('#get_verify_button').html('<a href="javascript:void(0)" class="btn btn_disabled">发送中...</a>');
	// 获取验证码
	$.ajax({
		url : '/member/bind_mobile_verify',
		data : ({
			'mobile' : mobile_
		}),
		type : 'post',
		success : function(msg) {
			if (msg.success == '1') {
				$('#get_verify_button').html('<span id="time" color="red;">60</span>秒钟后可重新获取');
				$('#tip_verify').html('<div class="tip" style="color:red;">验证码已发送</div>');
				setTimeout("ch_verify_button(2);", 1000);
			} else {
				alert(msg.message);
				$('#get_verify_button').html('<input type="button" value="获取短信验证码" onclick="getVerifyByMobile();" class="btn" />');
			}
		},
		error : function() {
			alert('系统出错!');
		}
	})
}

//60秒后，重新获取验证码
function ch_verify_button(reg_type){
	var time_ = parseInt($('#time').html());
	if(time_ > 0)
	{
		$('#time').html(time_-1);
		setTimeout("ch_verify_button("+reg_type+");",1000);
	}else
	{
		if(reg_type == 1)
			$('#get_verify_button').html('<input type="button" value="获取邮箱验证码" onclick="getVerifyByEmail();" class="btn" />');
		if(reg_type == 2)
			$('#get_verify_button').html('<input type="button" value="获取短信验证码" onclick="getVerifyByMobile();" class="btn" />');
		$('#tip_verify').html('');
		return null;
	}
}

// 绑定手机表单验证
function checkBindMobileForm(){
	if(!checkMobile($('#bind_mobile').val())){
		return false;
	}
	if (!checkVerify($('#verify').val())){
		return false;
	}
	return true;	
}
