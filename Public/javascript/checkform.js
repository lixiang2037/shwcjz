//添加联系人、编辑
function checkForm(){
	var contact_name_ = $.trim($('#contact_name').val());
	var id_num_ = $.trim($('#id_num').val());
	var email_ = $.trim($('#email').val());
	var check_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
	var phone_ = $.trim($('#phone').val());
	var tel1_ = $.trim($('#tel1').val());
	var tel2_ = $.trim($('#tel2').val());
	var tel3_ = $.trim($('#tel3').val());
	var tel = tel1_.length +tel2_.length;
	var qq = $.trim($('#qq').val());
	
	//验证姓名
	if(contact_name_ == ''){
		$("#tip_contact_name").html("<i class='ico_error'></i>请填写联系人名称");
		return false;
	}else if(!/^([\u4e00-\u9fa5]){2,5}$/.test(contact_name_)){
			$("#tip_contact_name").html("<i class='ico_error'></i>请填写正确的中文姓名");
			return false;
		}else{
			$("#tip_contact_name").html("");
		}
	
	//验证身份证
	if(!$.trim($('#id_num').val()) == ''){
		if($.trim($('#id_num').val()).length <18){
			$("#tip_id_num").html("<i class='ico_error'></i>请填写正确的身份证号码");
			return false;
		}
	}else{
		$("#tip_id_num").html("");
	}

	//验证邮箱
	if(!email_==''){
		if(!check_email.exec(email_)){
			$("#tip_email").html("<i class='ico_error'></i>请填写正确的邮箱地址");
			return false;
		}
	}else{
		$("#tip_email").html("");
	}
	
	//验证qq
	if(!qq.length==''){
		if(qq.length < 4 ){
			$("#tip_qq").html("<i class='ico_error'></i>请填写正确的QQ号码");
			return false;
		}
	}else{
		$("#tip_qq").html("");
	}

	// 验证手机和电话
	if(phone_ == ''){
		if(tel1_=='' || tel2_ == ''){
			$("#tip_tel").html("<i class='ico_error'></i>手机和电话至少填写一项");
			$("#tip_phone").html("<i class='ico_error'></i>手机和电话至少填写一项");
			return false;
		}
	}else{
		$("#tip_tel").html("");
		$("#tip_phone").html("");
	}
	if(phone_.length >0 && phone_.length != 11){
		$("#tip_phone").html("<i class='ico_error'></i>请填写正确的手机号");
		return false;
	}else{
		$("#tip_phone").html("");
	}
	
	if(!tel1_ == '' || !tel2_ == ''){
		if(tel1_.length < 3 || tel2_.length < 7){
			$("#tip_tel").html("<i class='ico_error'></i>请填写正确的电话号码");
			return false;
		}
	}
	else{
		$("#tip_tel").html("");
	}
	
	//验证城市
	if(!$('#J_province').val() == '' || !$.trim($('#address').val()) == ''){
		if($('#J_city').val() == '' || $('#J_district').val() == ''){
			$("#tip_address").html("<i class='ico_error'></i>地址选择错误！请重新选择");
			
			return false;
		}else if($('#J_community option').length-1 > 0 && $('#J_community').val()=='' ){
			$("#tip_address").html("<i class='ico_error'></i>地址选择错误！请选择街道");
			return false;
		}else if($.trim($('#address').val()) == ''){
			$("#tip_address").html("<i class='ico_error'></i>请填写门牌号");
			return false;
		}
	}else{
		$("#tip_address").html("");
	}

	return true;
}

//基因上传
function checkGeneForm(){
	var check_type_ = $('#check_type').val();
	if(check_type_ == ''){
		alert('请选择基因检测报告的类型');
		return false;
	}
	if(check_type_ == 1){
		var sample_sn_ =  $.trim($('#sample_sn').val());
		if(sample_sn_ == ''){
			alert('请输入样品编号');
			return false;
		}
	}else if(check_type_ == 2){
		var kit_id_ = $('#kit_id').val();
		if(kit_id_ == ''){
			alert('请选择试剂盒');
			return false;
		}
		if($('.bx_locus').val() == ''){
			alert('所有的位点信息必须填写，请确认');
			return false;
		}
		
		var person_name_ = $.trim($('#person_name').val());
		var id_num_ = $.trim($('#id_num').val());

		var byear = $.trim($('#byear').val());
		var bmonth = $.trim($('#bmonth').val());
		var bday = $.trim($('#bday').val());
		var month = new Date().getMonth()+1;
		var year = new Date().getFullYear();
		var day = new Date().getDate();
		//验证检测人姓名
		if(person_name_ == ''){
			alert('请填写检测人姓名');
			return false;
		}else if(!/^([\u4e00-\u9fa5]){2,5}$/.test(person_name_)){
				alert('输入的姓名不符合标准');
				return false;
		}
		//验证性别
		
		//验证身份证
		if(!id_num_ == ''){
			if(id_num_.length <18){
				alert('身份证数位不正确，请重新输入');
				return false;
			}
		}
		//验证生日
		if(!byear == ''){
			if(bmonth =='' || bday ==''){
				alert('请选择完整的出身日期');
				return false;
			}
		}
		if(byear == ''){
			if(!bmonth == '' || !bday == ''){
				alert('请选择完整的出身日期');
				return false;
			}
		}
		if(!byear == '' && byear == year ){
			if (bmonth > month) {
				alert('请选择正确的出身日期');
				return false;
			}else if(bday > day){
				alert('请选择正确的出身日期');
				return false;
			}
		}
		//验证联系人
		var contact_id = $.trim($('#contact_id').val());
		var contact_type = $.trim($('#contact_type').val());

		if(contact_id == ''){
			alert('联系人不能为空');
			return false;
		}else if(contact_type == ''){
			alert('请选择联系人关系，这对我们的测量很重要');
			return false;
		}
		if(!contact_id == ''){
			if(contact_type == ''){
				alert('请选择联系人关系，这对我们的测量很重要');
				return false;
			}
		}
		//验证城市
		if(!$('#J_province').val() == '' || !$.trim($('#address').val()) == ''){
			if($('#J_city').val() == '' || $('#J_district').val() == ''){
				alert('地址选择错误！请重新选择');
				return false;
			}else if($('#J_community option').length-1 > 0 && $('#J_community').val()=='' ){
				alert('地址选择错误！请选择街道');
				return false;
			}else if($.trim($('#address').val()) == ''){
				alert('请填写门牌号');
				return false;
			}
		}
	}
	return true;
}
