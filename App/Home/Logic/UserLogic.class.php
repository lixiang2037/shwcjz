<?php
namespace Home\Logic;

/**
 * 
 * 用户中心模块
 * 添加时间2014/9/16
 *
 */
class UserLogic
{
	public function __construct()
	{
		$this->_db = new \Home\Model\UserModel;
	}
	
	/**
	 * 获取当前登录用户信息
	 * 
	 */
	public function getInfo()
	{
		$user_id = get_user_id();
		$info = $this->_db->get($user_id);
		if (empty($info)) 
		{
            $this->error = '用户信息不存在';
            return false;
        }
		return $info;
	}
	
	/**
	*
	* 根据用户id获取用户信息
	*
	*/
	public function get($user_id)
	{
		return $this->_db->get($user_id);
	}
	/**
	 * 
	 * 编辑用户信息
	 * @param $params
	 */
	public function edit($params)
	{
		if(empty($params))
		{
			$this->error = '编辑内容为空';
			return false;
		}
		
		$user_id = get_user_id();
		$user_params = array(
			'real_name'   => $params['real_name'],
			'sex'         => $params['sex'],
			'byear'       => $params['byear'],
			'bmonth'      => $params['bmonth'],
			'bday'        => $params['bday'],
			'province_id' => $params['province_id'],
			'city_id'     => $params['city_id'],
		);
		if(false === $this->_db->edit($user_id, $user_params))
		{
			$this->error = '编辑用户信息失败';
			return false;
		}
		return true;
	}
	
	/** 
     * 注册用户
     *
     * @param    array
     *
     * @return   boolean
     **/
	public function register($params)
	{
		if (empty($params)) 
		{
            $this->error = '注册的内容为空';
            return false;
        }
        
        $user_name       = strval($params['user_name']);
        $password        = strval($params['password']);
        $passwordconfirm = strval($params['passwordconfirm']);
        
        $verify          = strval($params['verify']);
        /*
        if($this->invite_code != $params['invite_code'])
        {
        	$this->error = '邀请码不正确';
        	return false;
        }
        */
        if(cookie('verify') != $verify)
        {
        	$this->error = '验证码不正确';
            return false;
        }
        
        // 检查密码和重复密码是否一致
        if($password != $passwordconfirm)
        {
        	$this->error = '两次密码输入不统一';
        	return false;
        }
        
        // 验证用户名是否存在
		$info = $this->_db->getByUsername($user_name);
        if (!empty($info)) 
        {
            $this->error = '该注册用户名已经存在';
            return false;
        }
        
        // md5连接后缀字符串，加密
        $password = xr_encode($password);
        
        $bind_email = $bind_mobile = '';
        
        // 验证注册用户名是否为手机号,区分用户名为手机或邮箱
		if(isMobile($user_name))
		{   
	    	$bind_mobile = $user_name;  
			$info = $this->_db->getByBindMobile($bind_mobile);
	        if (!empty($info))
	        {
	        	$this->error = '该手机号码已为绑定手机号码';
	        	return false;
	        }   
		}else
		{   
			$bind_email = $user_name;
			// 验证邮箱是否为绑定邮箱
			$info = $this->_db->getByBindEmail($bind_email);
	        if (!empty($info))
	        {
	        	$this->error = '该邮箱已为绑定邮箱';
	        	return false;
	        }		         
		}
		
		$now = date('Y-m-d H:i:s');
        $register_params = array(
            'user_name'     => $user_name,
            'user_pwd' 	    => $password,
            'bind_email'    => $bind_email,
            'bind_mobile'   => $bind_mobile,
        	'status'        => '1',
        	'reg_ts'        => $now,
        	// 记录用户登录信息
        	'login_num'     => '1',  
		    'last_login_ts' => $now,
        );
        if (0 === ($user_id = $this->_db->add($register_params)))
        {
            $this->error = '注册失败';
            return false;
        }
               
        // 注册成功置用户为登录状态
        session('user_id', $user_id);
		session('user_name', $user_name);
		
		// 记录用户登录日志
		$this->_addLoginOther($user_id, $now);
		
		//销毁注册验证码
		cookie('verify', null);
        
        return true;
	}
	
	/**
	 * 记录用户的登录日志
	 * 
	 */
	private function _addLoginOther($user_id, $now)
	{
		$login_ip = get_client_ip();
		$login_region = get_city_by_ip($login_ip);  
		$user_login_log_params = array(
            'user_id'       => $user_id,
            'login_ip' 	    => $login_ip,
            'login_region'  => $login_region,
        	'login_ts'      => $now,
        );
        $this->_db->addUserLoginLog($user_login_log_params);
	}
	
	
	/**
	 * 
	 * 检查用户名邮箱(1注册用户名是否存在2绑定邮箱是否存在)
	 * 
	 * @param  $email
	 */
	public function checkEmail($email)
	{
		if(empty($email))
		{
			$this->error = '邮箱为空';
			return '2';
		}
		
		// 1、验证用户名是否存在
		$info = $this->_db->getByUsername($email);
        if (!empty($info)) 
        {
            $this->error = '该邮箱已为注册用户名';
            return '3';
        }
        
        // 2、检查绑定邮箱中是否存在
        $info = $this->_db->getByBindEmail($email);
        if (!empty($info))
        {
        	$this->error = '该邮箱已为绑定邮箱';
        	return '4';
        }
        return '1';
	}
	
	/**
	 * 
	 * 检查注册用户名手机号码(1注册用户名是否存在2绑定手机号码是否存在)
	 * @param  $mobile
	 */
	public function checkMobile($mobile)
	{
		if(empty($mobile))
		{
			$this->error = '手机号码为空';
			return '2';
		}
		
		// 1、验证用户名是否存在
		$info = $this->_db->getByUsername($mobile);
        if (!empty($info)) 
        {
            $this->error = '该手机号码已为注册用户名';
            return '3';
        }
        
        // 2、检查绑定手机号码中是否存在
        $info = $this->_db->getByBindMobile($mobile);
        if (!empty($info))
        {
        	$this->error = '该手机号码已为绑定手机号码';
        	return '4';
        }
        return '1';
	}
	
	/**
	 * 
	 * 发送邮箱验证吗(注册)
	 */
	public function getRegVerifyByEmail($email)
	{
		$verify = randomkeys(5, true);
		cookie('verify', $verify, 1800);
		
		$values = array('verify'=>$verify);
		
		$info = get_email_template('reg_verify');
		$title = $info['title'];
		$email_body = html_entity_decode(parseTemplate($info['content'], $values));
		
		$res = send_mail($email, $title, $email_body, '我');

		if($res !== true)
		{
			$this->error = '邮件发送失败';
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 发送邮箱验证码(绑定邮箱)
	 * @param $email
	 */
	public function getVerifyByEmail($email)
	{
		$verify = randomkeys(5, true);
		cookie('verify', $verify, 1800);
		
		$values = array('verify'=>$verify);
		
		$info = get_email_template('bind_mail');
		$title = $info['title'];
		$email_body = html_entity_decode(parseTemplate($info['content'], $values));
		
		$res = send_mail($email, $title, $email_body, '我');

		if($res !== true)
		{
			$this->error = '邮件发送失败';
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * 发送手机短信验证码
	 * @param $mobile
	 */
	public function getVerifyByMobile($mobile)
	{
		$verify = randomkeys(5, true);
		cookie('verify', $verify, 300);
		$msg_content = '您的验证码是：['.$verify.']。请不要把验证码泄露给其他人。如非本人操作，可不用理会！';
		$res = send_sms($mobile, $msg_content);
		if($res['code'] == 'err')
		{
			$this->error = '手机短信发送失败';
			return false;
		}
		return ture;
	}
	
	/**
	 * 
	 * 获取找回密码验证码
	 */
	public function getRetrieveVerify($params)
	{
		$retrieve_type = $params['retrieve_type'];
		$verify = randomkeys(5, true);
		if($retrieve_type == '1')
		{
			$bind_email = $params['bind_email'];
			cookie('verify', $verify, 1800);
			
			$values = array('verify'=>$verify);
		
			$info = get_email_template('get_password');
			$title = $info['title'];
			$email_body = html_entity_decode(parseTemplate($info['content'], $values));
			
			$res = send_mail($bind_email, $title, $email_body, '我');
			
			if($res !== true)
			{
				$this->error = '邮件发送失败';
				return false;
			}
		}elseif ($retrieve_type == '2') 
		{
			$bind_mobile = $params['bind_mobile'];
			cookie('verify', $verify, 300);
			$msg_content = '您的验证码是：['.$verify.']。请不要把验证码泄露给其他人。如非本人操作，可不用理会！';
			$res = send_sms($bind_mobile, $msg_content);
			if($res['code'] == 'err')
			{
				$this->error = '手机短信发送失败';
				return false;
			}
		}else 
		{
			$this->error = '找回密码方式为空，请确定';
			return false;
		}
		return true;
	}
	
	/** 
     * 登录用户
     *
     * @param    array
     *
     * @return   boolean
     **/
	public function login($params)
	{
//		$params = deep_filter($params, 'trim');
		
		// 验证码
//		$verify = new \Think\Verify();
//        $ck = $verify->check($params['verify'], 100);
//        if($ck === false)
//        {
//            $this->error = '验证码不正确!';
//            return false;
//        }
		
		// 验证用户名是否存在
		$info = $this->_db->getByUsername($params['user_name']);
		if(empty($info))
		{
			$this->error = '用户名不存在!';
			return false;
		}else 
		{
			// 检查用户状态
			if($info['status'] == 0)
			{
				$this->error = '用户已经被冻结';
				return false;
			}
			// 验证用户密码
			if($info['user_pwd'] != xr_encode($params['password']))
			{
				$this->error = '密码不正确!';
				return false;
			}else 
			{
				session('user_id', $info['user_id']);
				session('user_name', $info['user_name']);
				
				$now = date('Y-m-d H:i:s');
				// 记录用户登录日志
				$this->_addLoginOther($info['user_id'], $now);
		        
		        // 更新用户登录信息
		        $user_params = array(
		        	'login_num'     => $info['login_num']+1,
		        	'last_login_ts' => $now,
		        );
		        $this->_db->edit($info['user_id'], $user_params);
		        
				return true;
			}
		}
	}
		
	/**
	 * 
	 * 通过邮箱获取其对应的邮箱url地址
	 * @param  $email
	 */
	private function _getDomainByEmail($email)
	{
		$email_arr = explode('@', $email);
		$email_suffix = $email_arr[1];
		$email_domain = email_domain();
		$domain = $email_domain[$email_suffix];
		if(!$domain)
			$domain = 'http://www.baidu.com/';
		return $domain;	
	}
	
	/**
	 * 
	 * 根据用户名获取绑定邮箱
	 * @param $user_name 注册用户名
	 */
	public function getBindInfoByUsername($params)
	{
		     
		// 验证码
		$verify = new \Think\Verify();
        $ck = $verify->check($params['verify'], 100);
        if($ck === false)
        {
            $this->error = '验证码不正确!';
            return false;
        }
        
		$user_name = $params['user_name'];
		if(empty($user_name))
		{
			$this->error = '用户名为空';
			return false;
		}
		// 验证用户名是否存在
		$info = $this->_db->getByUsername($user_name);
		if(empty($info))
		{
			$this->error = $user_name.'该用户名不存在';
            return false;
		}
		
		// 验证用户手机和邮箱是否绑定
		if(empty($info['bind_email']) && empty($info['bind_mobile']))
		{
			$this->error = $user_name.'该用户邮箱和手机都未绑定，请联系客服';
			return false;
		}
		
		return $info;
	}
	
	/**
	 * 
	 * 重置用户密码
	 * @param  $params
	 */
	public function resetPassword($params)
	{
	
		$user_id = session('user_id_retrieve');
		$info = $this->_db->get($user_id);
		if(empty($info))
		{
			$this->error = '该用户不存在';
			return false;
		}else
		{
			if ($params['password'] != $params['passwordconfirm'])
			{
				$this->error = '两次密码输入不统一';
        		return false;
			}else 
			{
				$new_password = xr_encode($params['password']);
				if(false === $this->_db->editUserPassword($user_id, array('user_pwd'=>$new_password)))
				{
					$this->error = '用户密码修改失败';
					return false;
				}else 
				{
					session('[destroy]');
				}
			}
		}
		return true;
	}
	
	/**
	 * 
	 * 获取用户的绑定邮箱
	 * 
	 */
	public function getBindEmail()
	{
		$user_id = get_user_id();
		$info = $this->_db->get($user_id);
		return $info['bind_email'];
	}
	
	
	/**
	 * 
	 * 系统获取默认绑定邮箱
	 */
	public function getDefaultBindEmail()
	{
		$email = '';
		// 如果用户名为邮箱，默认设为绑定邮箱
		$user_name = get_user_name();
		if(isEmail( $user_name ))
		{
			$email = $user_name;
		}
		return $email;
	}
	
	/**
	 * 
	 * 系统获取默认绑定手机号码
	 */
	public function getDefaultBindMobile()
	{
		$mobile = '';
		$user_name = get_user_name();
		if(isMobile($user_name))
		{
			$mobile = $user_name;
		}
		return $mobile;
	}
	
	/**
	 * 
	 * 发送绑定邮箱邮件
	 * @param $to_bind_email 绑定邮箱地址
	 */
	public function sendBindEmail($to_bind_email)
	{
		$user_id = get_user_id();
		$user_name = get_user_name();
		// 拼接用户id和用户名加密
		$cryptograph = encode($user_id.','.$user_name.','.time());
		// 记录时间
		$bind_time = time();
		
		session('cryptograph', $cryptograph);
		session('bind_time', $bind_time);
		session('to_bind_email', $to_bind_email);
		$bind = 1;
		$link_url = C(M_SG_COM).U('/index/bind_email2', array('id'=>$user_id, 'cryptograph'=>$cryptograph, 'bind_time'=> $bind_time, 'bind'=>$bind));
		
		$values = array('link_url'=>$link_url);
		
		$info = get_email_template('bind_mail');
		$title = $info['title'];
		$email_body = html_entity_decode(parseTemplate($info['content'], $values));
		
		send_mail($to_bind_email, $title, $email_body, '我');

		return $this->_getDomainByEmail($to_bind_email);
	}
	
	/**
	 * 
	 * 发送认证邮箱邮件
	 * @param  $auth_email 认证邮箱
	 */
	public function sendAuthEmail($auth_email)
	{
		$user_id = get_user_id();
		$user_name = get_user_name();
		// 拼接用户id和用户名加密
		$cryptograph = encode($user_id.','.$user_name.','.time());
		// 记录时间
		$auth_time = time();
		session('cryptograph', $cryptograph);
		session('auth_time', $auth_time);
		$link_url = C(M_SG_COM).U('/index/check_auth_email', array('id'=>$user_id, 'cryptograph'=>$cryptograph, 'auth_time'=> $auth_time));
		
		$values = array('link_url'=>$link_url);
		
		$info = get_email_template('up_bind_email');
		$title = $info['title'];
		$email_body = html_entity_decode(parseTemplate($info['content'], $values));
		
		send_mail($auth_email, $title, $email_body, '我');

		return $this->_getDomainByEmail($auth_email);
	}
	
	/**
	 * 
	 * 1、检查认证邮箱；2、置绑定邮箱为空
	 * @param $params
	 */
	public function checkAuthEmail($params)
	{
		$auth_time = session('auth_time');
		if((time() - $auth_time) < 1800)
		{
			$cryptograph = session('cryptograph');
			if($cryptograph == $params['cryptograph'])
			{
				$user_id = get_user_id();
				$user_params = array('bind_email'=>'');
				if(false === $this->_db->edit($user_id, $user_params))
				{
					$this->error = '置绑定邮箱为空出错';
					return false;
				}else
				{
					session('cryptograph', null);
					session('auth_time', null);
					return true;
				}
			}else 
			{
				$this->error = '认证邮箱验证错误';
				return false;
			}
		}else 
		{
			$this->error = '认证邮箱时间过期，请重新申请';
			return false;
		}
	}
	
	/**
	 * 
	 * 保存绑定邮箱
	 * @param $params
	 */
	public function saveBindEmail($params)
	{
		if(cookie('verify') != $params['verify'])
		{
			$this->error = '验证码不正确';
			return false;
		}
		$user_id = get_user_id();
		$user_params = array('bind_email'=>$params['bind_email']);
		if(false === $this->_db->edit($user_id, $user_params))
		{
			$this->error = '绑定邮箱出错';
			return false;
		}
		cookie('verify', null);
		return true;
	}
	
	/**
	 * 
	 * 保存绑定手机
	 * 
	 * @param $params
	 */
	public function saveBindMobile($params)
	{
		if(cookie('verify') != $params['verify'])
		{
			$this->error = '验证码不正确';
			return false;
		}
		$user_params = array('bind_mobile' => $params['bind_mobile']);
		if(false === $this->_db->edit(get_user_id(), $user_params))
		{
			$this->error = '绑定手机出错';
			return false;
		}
		cookie('verify', null);
		return true;
	}
	
	/**
	 * 
	 * 获取出生年选择框
	 * @param   int
	 */
	public function getYearSelect($byear)
	{
		$html = "<option value=''>--请选择--</option>";
		$year = date('Y');
		for($i=$year; $i>1959; $i--)
		{
			$selected = '';
			if($i == $byear) $selected = 'selected';
			$html .= "<option value='$i' $selected>$i</option>";
		}
		return $html;
	}
	
	/**
	 * 
	 * 获取出生月选择框
	 * @param   int
	 */
	public function getMonthSelect($bmonth)
	{
		$html = "<option value=''>--请选择--</option>";
		for($i=1; $i<13; $i++)
		{
			$selected = '';
			if($i == $bmonth) $selected = 'selected';
			$html .= "<option value='$i' $selected>$i</option>";
		}
		return $html;
	}
	
	/**
	 * 
	 * 获取出生日选择框
	 * @param   int
	 */
	public function getDaySelect($bday)
	{
		$html = "<option value=''>--请选择--</option>";
		for($i=1; $i<32; $i++)
		{
			$selected = '';
			if($i == $bday) $selected = 'selected';
			$html .= "<option value='$i' $selected>$i</option>";
		}
		return $html;
	}
	

	/**
	 * 修改密码
	 * 
	 * @param    array
	 * 
	 * @return   boolean
	 */
	public function upPassword($params)
	{
		$user_id   = get_user_id();
		$info = $this->_db->get($user_id);
		if(empty($info))
		{
			$this->error = '该用户不存在';
			return false;
		}else
		{
			if($info['user_pwd'] != xr_encode($params['password']))
			{
				$this->error = '旧密码不正确';
				return false;
			}elseif ($params['password1'] != $params['password2'])
			{
				$this->error = '两次密码输入不统一';
        		return false;
			}elseif ($params['password'] == $params['password1'])
			{
				$this->error = '新密码和旧密码相同';
				return false;
			}else 
			{
				$new_password = xr_encode($params['password1']);
				if(false === $this->_db->edit($user_id, array('user_pwd'=>$new_password)))
				{
					$this->error = '用户密码修改失败';
					return false;
				}else // 密码修改成功，强制用户登出
				{
					session('[destroy]');
				}
			}
		}
		return true;
	}

	/**
	*
	* 私信功能
	*
	*/
	public function addContant($params)
	{
		if(empty($params))
		{
			$this->error = "发送的内容为空";
			return false;
		}
		$user = $this->_db->getByUsername($params['user_name']);
		$params['to_user_id'] = $user['user_id'];
		$msg_params = array(
			'from_user_id' 	=>get_user_id(),
			'to_user_id' 	=>$user['user_id'],
			'title' 		=> htmlspecialchars($params['title']),
			'content'		=> htmlspecialchars($params['content']),
			'add_time'		=> date("Y-m-d H:i:m"),
		);
		$msg_id = $this->_db->addContant($msg_params);
		if($msg_id == 0)
		{
			$this->error = '私信发送失败';
			return false;
		}
		return true;
	}
	/**
     * 返回错误信息
     *
     * @return    string
     **/
    public function getError()
    {
        return $this->error;
    }

}