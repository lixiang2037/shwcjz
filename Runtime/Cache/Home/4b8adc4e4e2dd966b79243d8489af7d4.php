<?php if (!defined('THINK_PATH')) exit();?>		<div class="tet">
				
				
					<p><span>联系人</span><input type="text" id="contact_name_1" name="contact_name"   class="wb"/></p>
							<p><span>身份证</span><input type="text" id="id_num_1" name="id_num"   class="wb"/></p>
							<p><span>E-mail</span><input type="text" id="email_1" name="email"  class="wb"/></p>
							<p><span>QQ</span><input type="text" id="qq_1" name="qq"  class="wb" maxlength="11" onkeyup="value=this.value.replace(/\D+/g,'')" /></p>
							<p><span>手机</span><input type="text" id="phone_1" name="phone"   class="wb" onkeyup="value=this.value.replace(/\D+/g,'')" maxlength="11" /></p>
							<p><span>电话</span>
								<input type="text" id="tel_1" name="tel1" class="tel" onkeyup="value=this.value.replace(/\D+/g,'')" maxlength="3">
								<i>—</i>
								<input type="text" id="tel_2" name="tel2" class="tel" onkeyup="value=this.value.replace(/\D+/g,'')" maxlength="8">
								<i>—</i>
								<input type="text" id="tel_3" name="tel3" class="tel" onkeyup="value=this.value.replace(/\D+/g,'')" maxlength="4"> 
							</p>
							<p><span>地址</span>
								<select style="width:90px;" name="province_id" id="J_province_1" ></select>
								<select style="width:90px;" name="city_id" id="J_city_1"></select>
								<select style="width:90px;" name="district_id" id="J_district_1"></select>
								<select style="width:90px;" name="community_id" id="J_community_1"></select>
							</p>
							<p><span></span><input type="text" name="address" id="address_1" class="wb"/></p>
					
		</div>
		
		
<script type="text/javascript">
$(function(){
	var pid=0;  // 默认省份id
	var cid=0;  // 默认城市id
	var did=0;  // 默认地区id
	var tid=0;  // 默认镇乡id

    function change_province(pid){
        $.post("<?php echo U('/member/getArea/area/province');?>", {pid: pid}, function(result){
                $("#J_province_1").html(result);
            });
        }
    function change_city(p_pid, p_cid){
        $.post('<?php echo U("/member/getArea/area/city");?>', {pid: p_pid, cid: p_cid}, function(result){
            $("#J_city_1").show().html(result);
        });
    }
    function change_district(p_cid, p_did){
    	$.post('<?php echo U("/member/getArea/area/district");?>', {cid: p_cid, did:p_did}, function(result){
            $("#J_district_1").show().html(result);
        });
    }
    function change_community(p_did, p_tid){
    	$.post('<?php echo U("/member/getArea/area/community");?>', {did:p_did, tid:p_tid}, function(result){
            $("#J_community_1").show().html(result);
        });
    }

    change_province(pid);
    change_city(pid,cid);
    change_district(cid,did);
    change_community(did,tid);

	$('#J_province_1').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g);
	});

	$('#J_city_1').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_district(pid_g);
	});
	$('#J_district_1').change(function(){
		var did_g=$(this).children('option:selected').val();
		change_community(did_g );
	});
});

$("#SD_confirm").on("click",function(){
	var url = "<?php echo U('/member/add_contact1');?>";
	var contact_name_ = $.trim($('#contact_name_1').val());
	var id_num_ = $.trim($('#id_num_1').val());
	var phone_ = $.trim($('#phone_1').val());
	var tel1_ = $.trim($('#tel_1').val());
	var tel2_ = $.trim($('#tel_2').val());
	var tel3_ = $.trim($('#tel_3').val());
	var tel = tel1_.length +tel2_.length;
	var qq = $.trim($('#qq_1').val());
	var email_ = $.trim($('#email_1').val());
	var check_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 

	if(contact_name_ == ''){
		alert('请填写联系人名称');
		return false
	}
	
	//验证身份证
	if(id_num_ == ''){
		alert('请填写身份证号码');
		return false;
	}else if(id_num_.length <18){
		alert('请填写正确的身份证号码');
		return false;
	}

	//验证邮箱
	if(!email_==''){
		if(!check_email.exec(email_)){
			alert('请填写正确的邮箱地址');
			return false;
		}
	}
	
	//验证qq
	if(!qq.length==''){
		if(qq.length < 4){
			alert('请填写正确的QQ号码');
			return false;
		}
	}

	// 验证手机和电话
	if(phone_ == ''){
		if(tel1_=='' || tel2_ == ''){
			alert('手机和电话至少填写一项');
			return false;
		}
	}
	if(phone_.length >0 && phone_.length != 11){
		alert('请填写正确的手机号');
		return false;
	}
	if(!tel1_ == '' || !tel2_ == ''){
		if(tel1_.length < 3 || tel2_.length < 7){
			alert('请填写正确的电话号码');
			return false;
		}
	}

	//验证城市
	if(!$('#J_province_1').val() == '' || !$.trim($('#address_1').val()) == ''){
		if($('#J_city_1').val() == '' || $('#J_district_1').val() == ''){
			alert('地址选择错误！请重新选择');
			return false;
		}else if($('#J_community_1 option').length-1 > 0 && $('#J_community_1').val()=='' ){
			alert('地址选择错误！请选择街道');
			return false;
		}else if($.trim($('#address_1').val()) == ''){
			alert('请填写门牌号');
			return false;
		}
	}

	

    $.post(url, $("#dialogForm").serialize(), function(data){
        if (data.success == '1') {
            $('#sel_contact_id').html(data.message);
            $('#SD_cancel').click();
            return false;
        } else {
        	alert(data.message);
        } 
    });
});
	
</script>