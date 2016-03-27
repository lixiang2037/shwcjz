<?php
namespace Home\Controller;

/**
* 会员认证模块
* 添加时间2014/9/12
*
* @return void;
**/

class AuthController extends BaseController
{
	/**
	 * 
	 * 同步登录
	 */
	public function sync_login()
	{
		$token = $_REQUEST['token'];
		$data = decode($token);
		$data_arr = explode(',', $data);
		if($data_arr[5] == '1')
			cookie('sg', $token, 3600*24*14); // 2周
		session('user_id', $data_arr[0]);
		session('user_name', $data_arr[1]);
		session('member_id', $data_arr[2]);
        if($data_arr[3] != 'N'){
			session('nick_name', $data_arr[3]);
		}
        if($data_arr[4] != 'N'){
			session('expert_id', $data_arr[4]);
		}
	}

	/**
	 * 
	 * 同步登出
	 */
	public function sync_logout()
	{
		session('[destroy]');
		cookie('sg', null);
	}
}