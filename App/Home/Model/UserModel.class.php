<?php
namespace Home\Model;
use Think\Model;

/**
 * 
 * 用户中心模块
 * 添加时间2014/9/16
 *
 */
class UserModel extends Model
{
	public function __construct()
    {
        $this->db            = M('User');
        $this->user_login_db = M('User_login_log');
        $this->msg_db        = M('Msg');

        
    }
    
    /**
     * 添加用户
     * @param    array
     *
     * @return   int  用户ID
     */
    public function add($params)
    {
    	if (count($params) < 1) 
    	{
            $this->error = '参数为空';
            return false;
        }
        return $this->db->add($params);
    }
    
    /**
     * 根据用户id获取用户信息
     * 
     * @param   int
     * 
     * @return  array
     */
    public function get($user_id)
    {
    	return $this->db->find($user_id);
    }
	
	/**
     * 取得单条信息
     *
     * @param    array    $where
     * @return   array
     */
	public function getUser($where = null)
	{
		if (is_array($where)) {
			$whereSql = ' 1 ';
			foreach ($where as $key => $value)
			{
				$whereSql .= " AND $key='$value'";
			}
		} else {
			$whereSql = $where;
		}
		return $this->db->where($whereSql)->find();
	}
	
    /**
     * 
     * 根据用户id更新数据
     * 
     * @param    int
     * @param    array
     *
     * @return   boolean
     */
	public function edit($user_id, $params)
    {
    	return $this->db->where("user_id = '{$user_id}'")->save($params);
    }
    
    /**
     * 根据用户名获取用户信息
     *
     * @param    string
     *
     * @return   array
     **/
    public function getByUsername($user_name)
    {
    	if(empty($user_name))
    	{
    		$this->error = '用户名为空';
    		return false;
    	}
    	return $this->db->where("user_name = '{$user_name}'")->find();
    }
    
    /**
     * 
     * 根据绑定邮箱查询用户信息
     * 
     * @param  $email
     */
    public function getByBindEmail($email)
    {
    	if(empty($email))
    	{
    		$this->error = '邮箱为空';
    		return false;
    	}
    	return $this->db->where("bind_email = '{$email}'")->find();
    }
    
    /**
     * 
     * 根据绑定手机号码查询用户信息
     * 
     * @param  $mobile
     */
    public function getByBindMobile($mobile)
    {
    	if(empty($mobile))
    	{
    		$this->error = '手机号码为空';
    		return false;
    	}
    	return $this->db->where("bind_mobile = '{$mobile}'")->find();
    }

    /**
     * 修改用户密码
     * 
     * @param    int
     * @param    array
     *
     * @return   boolean
     */
    public function editUserPassword($user_id, $params)
    {
    	return $this->db->where("user_id = '{$user_id}'")->save($params);
    }
    
    /**
     * 记录用户登录日志
     * @param  array
     *
     * @return  int  登录日志ID
     */
    public function addUserLoginLog($params)
    {
    	if (count($params) < 1) {
            $this->_error = '参数为空';
            return false;
        }

        return $this->user_login_db->add($params);
    }

    /**
    *
    * 添加私信
    *
    *
    */
    public function addContant($params)
    {
        return $this->msg_db->add($params);
    }
}
