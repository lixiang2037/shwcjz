<?php
namespace Home\Logic;

/**
 * 
 * 订单管理
 * 添加时间2015/10/26
 *
 */
class PersonLogic
{
	public function __construct()
	{
		$this->_db      = new \Home\Model\PersonModel;
		$this->_area_db = new \Home\Model\AreaModel;
	}
	
	/**
     * 返回搜索选项
     *
     * @return array
     **/
	public function getSearchOption()
	{
		return $this->_search_option;
	}
	
	/**
	 * 
	 * 获取联系人选择代码
	 */
	public function getContactsHtml()
	{
		$data = $this->_db->getContactOption();
		$contacts = '<select style="width:100px;" name="contact_id" id="contact_id">
					<option value="">--请选择--</option>';
		if($data)
		{
			foreach ($data as $d)
			{
				$contacts .= '<option value="'.$d['contact_id'].'">'.$d['contact_name'].'</option>';
			}
		}					
		$contacts .= '</select>';
		return $contacts;
	}
	
	/**
	 * 
	 * 获取检测人代码
	 */
	public function getPersonHtml()
	{
		$persons = $this->_db->getPersonsByMark();
		$data = '';
		if(empty($persons))
		{
			$data = '<tr><td colspan="4">检测人为空!</td></tr> <input type="hidden" name="check_nums" id="check_nums" value="0" />';
		}else 
		{
			$index = 1;
			foreach ($persons as $person)
			{
				$data .= '<tr>
					<td>'.$person['person_name'].'<input type="hidden" name="person_id_'.$index.'" value="'.$person['person_id'].'" /></td>
					<td>'.($person['sex'] == 1? '男' : '女' ).'</td>
					<td>'.$person['byear'].'-'.$person['bmonth'].'-'.$person['bday'].'</td>
					<td width="70" style="text-align:center;"><a href="javascript:void(0)" onclick="delete_check_person('.$person['person_id'].');">删除</a></td>
				</tr>';
				$index++;
			}
			$data .= '<input type="hidden" name="check_nums" id="check_nums" value="'.count($persons).'" />';
		}
		
		return $data;
	}
	
	/**
	 * 
	 * 获取标记的联系人
	 */
	public function getPersonsByMark()
	{
		return $this->_db->getPersonsByMark();
	}
	
	/**
	 * 
	 * 清除待检测的人和联系人关系
	 */
	public function deletePersonsByMark()
	{
		$mark_persons = $this->_db->getPersonsByMark();
		foreach ($mark_persons as $person)
		{
			$person_id = $person['person_id'];
			$this->_db->deletePersonContactByPersonId($person_id);
		}
		return $this->_db->deletePersonsByMark();
	}
	
	/**
	 * 
	 * 查询联系人列表
	 * @param $params
	 */
	public function browseContact($params)
    {
    	$infos = $this->_db->browseContact($params);

        if (false === $infos) 
        {
            $this->error = $this->_db->getError();
            return false;
        }
        if (empty($infos)) 
        {
            return $infos;
        }
        foreach ($infos as &$info)
        {
        	$info['address_info'] = $this->handle_address_info($info);
        }
        return $infos;
    }
    
    /**
     * 
     * 获取地址
     * @param $info
     */
    public function handle_address_info($info)
	{
		$address_info = '';
		if(!empty($info['province_id']))
		{
			$area = $this->_area_db->get($info['province_id']);
			$address_info .= $area['name'].'-';
		}
		if(!empty($info['city_id']))
		{
			$area = $this->_area_db->get($info['city_id']);
			$address_info .= $area['name'].'-';
		}
		if(!empty($info['district_id']))
		{
			$area = $this->_area_db->get($info['district_id']);
			$address_info .= $area['name'].'-';
		}
		if(!empty($info['community_id']))
		{
			$area = $this->_area_db->get($info['community_id']);
			$address_info .= $area['name'].'-';
		}
		if(!empty($info['address']))
			$address_info .= $info['address'];
		
		return $address_info;
	}
	
	/**
	 * 
	 * 处理联系电话
	 * @param $info
	 */
	public function handle_tel_info(&$info)
	{
		if(!empty($info['tel']))
    	{
    		$tel_arr = explode('-', $info['tel']);
    		$info['tel1'] = $tel_arr[0];
    		$info['tel2'] = $tel_arr[1];
    		$info['tel3'] = $tel_arr[2];
    	}
	}
	
	/**
	 * 
	 * 通过Id获取联系人
	 * @param $contact_id
	 */
	public function getContact($contact_id)
	{
		$contact_id = intval($contact_id);
        if ($contact_id < 1) 
        {
            $this->error = '联系人Id不正确';
            return false;
        }
        $info = $this->_db->getContact($contact_id);
        if (empty($info)) 
        {
            $this->error = '没有相关记录';
            return false;
        }

        return $info;
	}
    
	
	/**
	 * 
	 * 添加联系人
	 * @param $params
	 */
	public function addContact($params)
	{
		if (empty($params)) 
        {
            $this->error = '添加的内容为空';
            return false;
        }
        $contact_name = $params['contact_name'];
        $contact = $this->_db->getContactByName($params['contact_name']);
        if(!empty($contact))
        {
        	$this->error = '该联系人已经存在';
        	return false;
        }
        if(empty($contact_name))
        {
        	$this->error ='联系人名字不能为空';
        	return false;
        }
        
		$tel = '';
        if(!empty($params['tel1']))
        	$tel = $params['tel1'];
        if(!empty($params['tel2']))
        	$tel .= '-'.$params['tel2'];
        if(!empty($params['tel3']))
        	$tel .= '-'.$params['tel3'];
        $contact_params = array(
        	'user_id'        => get_user_id(),
            'contact_name'   => $params['contact_name'],
        	'id_num'         => $params['id_num'],
//        	'sex'            => $params['sex'],
        	'tel'            => $tel,
        	'phone'          => $params['phone'],
        	'qq'             => $params['qq'],
        	'email'          => $params['email'],
        	'province_id'    => $params['province_id'],
        	'city_id'        => $params['city_id'],
        	'district_id'    => $params['district_id'],
        	'community_id'   => $params['community_id'],
        	'address'        => $params['address'],
        	'add_ts'         => date('Y-m-d H:i:s'),
        );
        if (0 === ($contact_id = $this->_db->addContact($contact_params))) 
        {
            $this->error = '添加联系人失败';
            return false;
        }
        
        return true;
	}
	
	/**
	 * 
	 * 编辑联系人
	 * @param $contact_id
	 * @param  $params
	 */
	public function editContact($contact_id, $params)
	{
		$contact_id = intval($contact_id);
        if ($contact_id < 1) 
        {
            $this->error = '联系人ID不正确';
            return false; 
        }
        if (empty($params)) 
        {
            $this->error = '编辑的内容为空';
            return false;
        }
        $tel = '';
        if(!empty($params['tel1']))
        	$tel = $params['tel1'];
        if(!empty($params['tel2']))
        	$tel .= '-'.$params['tel2'];
        if(!empty($params['tel3']))
        	$tel .= '-'.$params['tel3'];
        	
        $contact_params = array(
            'contact_name'   => $params['contact_name'],
        	'id_num'         => $params['id_num'],
        	'sex'            => $params['sex'],
        	'tel'            => $tel,
        	'phone'          => $params['phone'],
        	'qq'             => $params['qq'],
        	'email'          => $params['email'],
        	'province_id'    => $params['province_id'],
        	'city_id'        => $params['city_id'],
        	'district_id'    => $params['district_id'],
        	'community_id'   => $params['community_id'],
        	'address'        => $params['address'],
        );
        if (false === $this->_db->editContact($contact_id, $contact_params))
        {
            $this->error = '编辑 样品失败';
            return false;
        }
        
        return true;
	}
	
	/**
	 * 
	 * 删除联系人
	 * @param $contact_id
	 */
	public function deleteContactByContactId($contact_id)
	{
		return $this->_db->deleteContactByContactId($contact_id);
	}
	
	/**
	 * 
	 * 添加检测人
	 * @param $params
	 */
	public function add($params)
	{
		if (empty($params)) 
        {
            $this->error = '添加的内容为空';
            return false;
        }
		$person_name = $params['person_name'];
		$person = $this->_db->getPersonByName($person_name);
		if(!empty($person))
		{
			$this->error = '该检测人已经存在';
			return false;
		}
		
		$person_params = array(
				'user_id'      => get_user_id(),
				'person_name'  => $params['person_name'],
				'sex'          => $params['sex'],
				'id_num'       => $params['id_num'],
				'byear'        => $params['byear'],
				'bmonth'       => $params['bmonth'],
				'bday'         => $params['bday'],
				'province_id'  => $params['province_id1'],
        		'city_id'      => $params['city_id1'],
        		'district_id'  => $params['district_id1'],
        		'community_id' => $params['community_id1'],
        		'address'      => $params['address1'],
				'is_mark'      => 1,
			);
		if(0 === ($person_id = $this->_db->add($person_params)))
		{
			$this->error = '添加检测人失败';
			return false;
		}
		$person_contact_params = array(
				'person_id'    => $person_id,
				'contact_id'   => $params['contact_id'],
				'contact_type' => $params['contact_type'],
			);
		$person_contact_id = $this->_db->addPersonContact($person_contact_params);
		
		return true;
	}
	
	/**
	 * 
	 * 删除待检测人
	 * @param $person_id
	 */
	public function deleteByPersonId($person_id)
	{
		$this->_db->deletePersonContactByPersonId($person_id);
		return $this->_db->deleteByPersonId($person_id);
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