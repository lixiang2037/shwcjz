<?php
namespace Home\Model;
use Think\Model;

/**
 * 
 * 样品、采样地址管理
 * 添加时间2015/11/02
 *
 */
class SampleModel extends Model
{
	public function __construct()
    {
        $this->db                = M('Sample');
        $this->address_db        = M('Sample_address');
    }
    
	/**
     * 
     * 根据样品id获取信息
     * @param $person_id
     */
    public function get($sample_id)
    {
    	return $this->db->find($sample_id);
    }
    
    /**
     * 
     * 通过样品编号获取信息
     * @param $sample_sn
     */
    public function getBySampleSn($sample_sn)
    {
    	return $this->db->where("sample_sn = {'$sample_sn'}")->find();
    }
    
    /**
     * 
     * 通过订单查询样品信息
     * @param $order_id
     */
	public function getSamplesByOrderId($order_id)
    {
    	return $this->db->where("order_id = '{$order_id}'")->order('sample_id desc')->select();
    }
    
	/**
	 * 添加样品信息
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
	 * @param $sample_id
	 * @param $params
	 */
    public function edit($sample_id, $params)
    {
        $sample_id = intval($sample_id);

        if ($sample_id < 1) 
        {
            $this->error = '样品Id不正确';
            return false;
        }
        if (count($params) < 1) 
        {
            $this->error = '参数为空';
            return false;
        }

        return $this->db->where("sample_id = '{$sample_id}'")->save($params);
    }
    
    /**
     * 
     * 查询样品
     * @param $params
     */
	public function browse($params)
    {
    	$_condition['1'] = "1=1";

        !empty($params['order_id']) && $_condition[] = "order_id = '{$params['order_id']}'";
        !empty($params['status']) && $_condition[] = "status = '{$params['status']}'";
        !empty($params['in_status']) && $_condition[] = "status in ({$params['in_status']})";

        return $this->db->where($_condition)->order('sample_id desc')->select();
    }
    
    /**
     * 
     * 删除样品
     * @param $sample_id
     */
    public function deleteBySampleId($sample_id)
    {
    	$sample_id = intval($sample_id);

        if ($sample_id < 1) 
        {
            $this->error = '样品Id不正确';
            return false;
        }

        return $this->db->where("sample_id = '{$sample_id}'")->delete();
    }
    
    /**
     * 
     * 通过Id获取采样地址
     * @param $address_id
     */
    public function getAddress($address_id)
    {
    	return $this->address_db->find($address_id);
    }
    
    /**
     * 
     * 添加采样地址
     * @param $params
     */
    public function addAddress($params)
    {
    	if(count($params) < 1)
    	{
    		$this->error = '参数为空';
    		return false;
    	}
    	return $this->address_db->add($params);
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
            $this->error = '地址Id不正确';
            return false;
        }
        if (count($params) < 1) 
        {
            $this->error = '参数为空';
            return false;
        }

        return $this->address_db->where("address_id = '{$address_id}'")->save($params);
    }
    
    /**
     * 
     * 删除采样地址
     * @param $address_id
     */
	public function deleteAddressByAddressId($address_id)
    {
    	$address_id = intval($address_id);

        if ($address_id < 1) 
        {
            $this->error = '采样地址Id不正确';
            return false;
        }

        return $this->address_db->where("address_id = '{$address_id}'")->delete();
    }
    
    /**
     * 
     *查询采样地址
     * @param $params
     */
    public function browseAddress($params)
    {
    	 $_condition['1'] = "1=1";

        !empty($params['status']) && $_condition[] = "status = '{$params['status']}'";
		!empty($params['user_id']) && $_condition[] = "user_id = '{$params['user_id']}'";
        return $this->address_db->where($_condition)->order('address_id desc')->select();
    }
}