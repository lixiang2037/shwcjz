<?php
namespace Home\Logic;

/**
 * 
 * 样品管理
 * 添加时间2015/11/02
 *
 */
class SampleLogic
{
	public function __construct()
	{
		$this->_db         = new \Home\Model\SampleModel;
		$this->_order_db   = new \Home\Model\OrderModel;
		$this->_person_db  = new \Home\Model\PersonModel;
		$this->_person_api = new \Home\Logic\PersonLogic();
		$this->_search_option = array(
			'sample_status' => array(
                '1' => array('id' => 1, 'val' => '采样器已寄', 'default' => '1'),
                '2' => array('id' => 2, 'val' => '样品已寄'),
            	'3' => array('id' => 3, 'val' => '已收样'),
            	'4' => array('id' => 4, 'val' => '报告已寄'),
            	'5' => array('id' => 5, 'val' => '样品废弃'),
            ),
		);
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
	 * 查询样品
	 * @param $sample_id
	 */
	public function get($sample_id)
    {
    	$sample_id = intval($sample_id);
        if ($sample_id < 1) 
        {
            $this->error = '样品Id不正确';
            return false;
        }
        $info = $this->_db->get($sample_id);
        if (empty($info)) 
        {
            $this->error = '没有相关记录';
            return false;
        }

        return $info;
    }
    
    /**
     * 
     * 添加样品
     * @param $params
     */
	public function add($params)
    {
        if (empty($params)) 
        {
            $this->error = '添加的内容为空';
            return false;
        }

        $sample_params = array(
            'sample_sn'   => $params['sample_sn'],
        	'order_id'    => $params['order_id'],
        	'person_id'   => $params['person_id'],
        	'add_ts'      => date('Y-m-d H:i:s'),
        );

        if (0 === ($sample_id = $this->_db->add($sample_params))) 
        {
            $this->error = '添加样品失败';
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * 编辑样品
     * @param $sample_id
     * @param $params
     */
	public function edit($sample_id, $params)
    {
    	$sample_id = intval($sample_id);
        if ($sample_id < 1) 
        {
            $this->error = '样品ID不正确';
            return false; 
        }
        if (empty($params)) 
        {
            $this->error = '编辑的内容为空';
            return false;
        }
        
        $sample_params = array(
        	'person_id'   => $params['person_id'],
        	'add_ts'      => date('Y-m-d H:i:s'),
        );
        if (false === $this->_db->edit($sample_id, $sample_params))
        {
            $this->error = '编辑 样品失败';
            return false;
        }
        
        return true;
    }
    
	/**
     * 
     * 删除采样地址
     * @param $sample_id
     */
	public function deleteBySampleId($sample_id)
    {
        if (false === $this->_db->deleteBySampleId($sample_id)) 
        {
            $this->error = $this->_db->getError();
            return false;
        }
        return true;
    }
    
    /**
     * 
     * 查询样品
     * @param $params
     */
    public function browse($params)
    {
    	$infos = $this->_db->browse($params);
    	
    	if(false === $infos)
    	{
    		$this->error = $this->_db->getError();
    		return false;
    	}
    	
    	if(empty($infos))
    		return array();
    		
    	foreach ($infos as &$info)
    	{
    		$info['status_name'] = $this->_search_option['sample_status'][$info['status']]['val'];
    		$order = $this->_order_db->get($info['order_id']);
        	$info['order_sn'] = $order['order_sn'];
        	$person = $this->_person_db->get($info['person_id']);
    		$info['person_name'] = $person['person_name'];
    	}
    	
    	return $infos;
    }
	
	/**
	 * 
	 * 查询采样地址
	 * @param $params
	 */
	public function browseAddress($params)
	{
		$infos = $this->_db->browseAddress($params);

        if (false === $infos) 
        {
            $this->error = $this->_db->getError();
            return false;
        }
        if (empty($infos)) 
            return array();
            
		foreach ($infos as &$info)
        {
        	$info['address_info'] = $this->_person_api->handle_address_info($info);
        	$this->_person_api->handle_tel_info($info);
        }

        return $infos;
	}
	
	/**
	 * 
	 * 通过Id获取采样地址
	 * @param $address_id
	 */
	public function getAddress($address_id)
	{
		$address_id = intval($address_id);
        if ($address_id < 1) 
        {
            $this->error = '采样地址Id不正确';
            return false;
        }
        $info = $this->_db->getAddress($address_id);
        if (empty($info)) 
        {
            $this->error = '没有相关记录';
            return false;
        }
        $info['address_info'] = $this->_person_api->handle_address_info($info);
        $this->_person_api->handle_tel_info($info);

        return $info;
	}
	
	/**
     * 
     * 添加采样地址
     * @param $params
     */
	public function addAddress($params)
    {
        if (empty($params)) 
        {
            $this->error = '添加的内容为空';
            return false;
        }

        $address_params = array(
            'tel'          => $params['tel'],
        	'phone'        => $params['phone'],
        	'province_id'  => $params['province_id'],
        	'city_id'      => $params['city_id'],
        	'district_id'  => $params['district_id'],
        	'community_id' => $params['community_id'],
        	'address'      => $params['address'],
        	'add_ts'       => date('Y-m-d H:i:s'),
        );

        if (0 === ($address_id = $this->_db->add($address_params))) 
        {
            $this->error = '添加采样地址失败';
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * 编辑采样地址
     * @param $address_id
     * @param $params
     */
    public function editAddress($address_id, $params)
    {
    	$address_id = intval($address_id);
        if ($address_id < 1) 
        {
            $this->error = '采样地址Id不正确';
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
        
        $address_params = array(
        	'contact_name' => $params['contact_name'],
        	'tel'          => $tel,
        	'phone'        => $params['phone'],
        	'province_id'  => $params['province_id'],
        	'city_id'      => $params['city_id'],
        	'district_id'  => $params['district_id'],
        	'community_id' => $params['community_id'],
        	'address'      => $params['address'],
        );
        
        if (false === $this->_db->editAddress($address_id, $address_params))
        {
            $this->error = '编辑采样地址失败';
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * 删除采样地址
     * @param $address_id
     */
	public function deleteAddressByAddressId($address_id)
    {
        if (false === $this->_db->deleteAddressByAddressId($address_id)) 
        {
            $this->error = $this->_db->getError();
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