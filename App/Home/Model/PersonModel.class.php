<?php
namespace Home\Model;
use Think\Model;

/**
 * 
 * 联系人-联系方式管理
 * 添加时间2015/10/26
 *
 */
class PersonModel extends Model
{
	public function __construct()
    {
        $this->db                = M('Person');
        $this->contact_db        = M('Contact');
        $this->person_contact_db = M('Person_contact');
    }
    
    /**
     * 
     * 获取检测人选项
     */
	public function getContactOption()
	{
		$user_id = get_user_id();
		$infos = $this->contact_db->where("user_id = '{$user_id}'")->field("contact_id, contact_name")->order('contact_id')->select();
		return singleGroup($infos, 'contact_id');
	}
    
	/**
     * 
     * 根据检测人id获取信息
     * @param $person_id
     */
    public function get($person_id)
    {
    	return $this->db->find($person_id);
    }
    
    /**
     * 
     * 通过检测人名称查询
     * @param $person_name
     */
    public function getPersonByName($person_name)
    {
    	$user_id = get_user_id();
    	return $this->db->where("person_name = '{$person_name}' and user_id = '{$user_id}' ")->find();	
    }

    /**
     * 
     * 获取标记为待检测的人
     */
    public function getPersonsByMark()
    {
    	$user_id = get_user_id();
    	return $this->db->where("user_id = '{$user_id}' and is_mark = 1")->select();
    }
    
    /**
     * 
     * 清除标记为待检测的人
     */
    public function deletePersonsByMark()
    {
    	$user_id = get_user_id();
    	return $this->db->where("user_id = '{$user_id}' and is_mark = 1")->delete();
    }
    
    
	/**
	 * 添加检测人信息
	 * 
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
	 * 
	 * 编辑
	 * @param $person_id
	 * @param $params
	 */
    public function edit($person_id, $params)
    {
        $person_id = intval($person_id);

        if ($person_id < 1) 
        {
            $this->error = '检测人Id不正确';
            return false;
        }
        if (count($params) < 1) 
        {
            $this->error = '参数为空';
            return false;
        }

        return $this->db->where("person_id = '{$person_id}'")->save($params);
    }
    
    /**
     * 
     * 删除联系人
     * @param $person_id
     */
	public function deleteByPersonId($person_id)
    {
    	$person_id = intval($person_id);

        if ($person_id < 1) 
        {
            $this->error = '联系人Id不正确';
            return false;
        }

        return $this->db->where("person_id = '{$person_id}'")->delete();
    }
    
    /**
     * 
     * 获取联系人地址
     * @param $contact_id
     */
    public function getContact($contact_id)
    {
    	return $this->contact_db->find($contact_id);
    }
    
    /**
     * 
     * 通过联系人名称查询
     * @param $contact_name
     */
    public function getContactByName($contact_name)
    {
    	$user_id = get_user_id();
    	return $this->contact_db->where("contact_name = '{$contact_name}' and user_id = '$user_id' ")->find();
    }
    
    /**
     * 
     * 添加联系人地址信息
     * @param $params
     */
    public function addContact($params)
    {
    	if(count($params) < 1)
    	{
    		$this->error = '参数为空';
    		return false;
    	}
    	return $this->contact_db->add($params);
    }
    
    /**
     * 
     * 编辑联系人地址
     * @param $contact_id
     * @param $params
     */
    public function editContact($contact_id, $params)
    {
    	$contact_id = intval($contact_id);
    	if($contact_id < 1)
    	{
    		$this->error = '联系地址Id为空';
    		return false;
    	}
    	if(count($params) < 0)
    	{
    		$this->error = '参数为空';
    		return false;
    	}
    	
    	return $this->contact_db->where("contact_id = '{$contact_id}'")->save($params);
    }
    
    /**
     * 
     * 查询联系人列表
     * @param $params
     */
    public function browseContact($params)
    {
    	$_condition['1'] = "1=1";

        !empty($params['user_id']) && $_condition[] = "user_id = '{$params['user_id']}'";

        return $this->contact_db->where($_condition)->order('contact_id desc')->select();
    }
    
    /**
     * 
     * 删除联系人
     * @param $contact_id
     */
	public function deleteContactByContactId($contact_id)
    {
    	$contact_id = intval($contact_id);

        if ($contact_id < 1) 
        {
            $this->error = '联系人Id不正确';
            return false;
        }

        return $this->contact_db->where("contact_id = '{$contact_id}'")->delete();
    }
    
    /**
     * 
     * 添加联系人关系
     * @param $params
     */
    public function addPersonContact($params)
    {
    	if(count($params) < 1)
    	{
    		$this->error = '参数为空';
    		return false;
    	}
    	return $this->person_contact_db->add($params);
    }
    
    /**
     * 
     * 通过检测人Id查询与联系人关系
     * @param $person_id
     */
    public function getPersonContactByPersonId($person_id)
    {
    	return $this->person_contact_db->where("person_id = '{$person_id}'")->find();
    }
    
    /**
     * 
     * 删除待检测人与联系人关系
     * @param $person_id
     */
    public function deletePersonContactByPersonId($person_id)
    {
    	return $this->person_contact_db->where("person_id = '{$person_id}'")->delete();
    }
    
    
    /**
     * 
     * 添加联系人、地址关系
     * @param $person_contact_id
     */
    public function deletePersonContact($person_contact_id)
    {
    	$person_contact_id = intval($person_contact_id);
    	
    	if($person_contact_id < 1)
    	{
    		$this->error = '联系人关系Id不正确';
    		return false;
    	}
    	
    	return $this->person_contact_db->where("person_contact_id = '{$person_contact_id}'")->delete();
    }
}