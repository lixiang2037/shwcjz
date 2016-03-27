<?php
namespace Home\Logic;

/**
 * 
 * 订单管理
 * 添加时间2015/10/26
 *
 */
class OrderLogic
{
	public function __construct()
	{
		$this->_db        = new \Home\Model\OrderModel;
		$this->_sample_db = new \Home\Model\SampleModel;
		$this->_person_db = new \Home\Model\PersonModel;
		$this->_search_option = array(
            'pay_status' => array(
                '1' => array('id' => 1, 'val' => '待付款', 'default' => '1'),
                '2' => array('id' => 2, 'val' => '已付款'),
            ),
            'order_status' => array(
                '1' => array('id' => 1, 'val' => '已下单', 'default' => '1'),
            	'2' => array('id' => 2, 'val' => '客服已审核',),
                '3' => array('id' => 3, 'val' => '采样器已寄'),
            	'4' => array('id' => 4, 'val' => '完成'),
            	'5' => array('id' => 5, 'val' => '取消'),
            ), 
            'sample_status' => array(
                '1' => array('id' => 1, 'val' => '采样器已寄', 'default' => '1'),
                '2' => array('id' => 2, 'val' => '样品已寄'),
            	'3' => array('id' => 3, 'val' => '已收样'),
            	'4' => array('id' => 4, 'val' => '报告已上传'),
            	'5' => array('id' => 5, 'val' => '报告确认'),
            	'6' => array('id' => 6, 'val' => '报告已寄'),
            	'7' => array('id' => 7, 'val' => '样品废弃'),
            ), 
            'logistic_icon' => array(
                '1'  => array('img' => '/images/express/st_logo.gif', 'name' => '申通快递'),
                '2'  => array('img' => '/images/express/yd_logo.gif', 'name' => '韵达快运'),
                '3'  => array('img' => '/images/express/yt_logo.gif', 'name' => '圆通速递'),
                '4'  => array('img' => '/images/express/zt_logo.gif', 'name' => '中通快递'),
                '5'  => array('img' => '/images/express/ems_logo.gif', 'name' => 'EMS'),
                '6'  => array('img' => '/images/express/sf_logo.gif', 'name' => '顺丰速运'),
                '7'  => array('img' => '/images/express/htky_logo.gif', 'name' => '百世汇通'),
                '8'  => array('img' => '/images/express/tt_logo.gif', 'name' => '天天快递'),
                '9'  => array('img' => '/images/express/zjs_logo.gif', 'name' => '宅急送'),
                '10' => array('img' => '/images/express/yzgn_logo.gif', 'name' => '中国邮政'),
                '11' => array('img' => '/images/express/dbwl_logo.gif', 'name' => '德邦物流'),
                '12' => array('img' => '/images/express/qfkd_logo.gif', 'name' => '全峰快递'),
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
	 * 查询订单
	 * @param $order_id
	 */
	public function get($order_id)
    {
    	$order_id = intval($order_id);
    	
        if ($order_id < 1) 
        {
            $this->error = '订单Id不正确';
            return false;
        }
        $info = $this->_db->get($order_id);
        if (empty($info)) 
        {
            $this->error = '没有相关记录';
            return false;
        }

        return $info;
    }
    
    /**
    *
    * 统计用户订单数量
    *
    */
    public function getCount($params)
    {
        if($params['s'] == '')
        {
            $params['user_id'] = get_user_id();
        }else if($params['s'] == '-1')

        {
            $params['user_id'] = get_user_id();
            $params['order_status'] = array('lt',4);
        }
        else 
        {
            $params = array(
                'user_id'            => get_user_id(),
                'order_status'       => I('get.s'),
            );
        }
        unset($params['s']);
        
        return $this->_db->getCount($params);
    }

    /**
     * 
     * 寄送样品
     * @param $params
     */
    public function sendSample($params)
    {
    	if(empty($params))
    	{
    		$this->error = '提交内容为空';
    		return false;
    	}
    	$sample_ids = $params['sample_id'];
    	if(empty($sample_ids))
    	{
    		$this->error = '请选择样品';
    		return false;
    	}
    	foreach ($sample_ids as $sample_id)
    	{
    		$sample_params = array(
    			'logistics_name' => $params['logistics_name'],
    			'logistics_sn'   => $params['logistics_sn'],
    			'status'         => 2,
    		);
    		$this->_sample_db->edit($sample_id, $sample_params);
    	}
    	return true;
    }
    
    /**
     * 
     * 通过订单获取样品信息
     * @param $order_id
     */
    public function getSamplesByOrderId($order_id)
    {
    	$infos = $this->_sample_db->getSamplesByOrderId($order_id);
    	if(empty($infos))
    		return array();
    	foreach ($infos as &$sample) 
        {
        	$sample['status_name'] = $this->_search_option['sample_status'][$sample['status']]['val'];
        	$person = $this->_person_db->get($sample['person_id']);
    		$sample['person_name'] = $person['person_name'];
    		$sample['sex'] = $person['sex'] == 1? '男':'女';
    		$sample['byear'] = $person['byear'];
    		$sample['bmonth'] = $person['bmonth'];
    		$sample['bday'] = $person['bday'];
        }
    	return $infos;
    }
    
	/**
     * 
     * 添加订单
     * @param $params
     */
	public function add($params)
    {
        if (empty($params)) 
        {
            $this->error = '添加的内容为空';
            return false;
        }
		$user_id = get_user_id();
		$address_id = $params['h_address'];
		$now = date('Y-m-d H:i:s');
		
		// 1、采样地址
		if($address_id){
			$address = $this->_sample_db->getAddress($address_id);
			$params['contact_name'] = $address['contact_name'];
			$tel = $address['tel'];
			$params['phone'] = $address['phone'];
			$params['province_id'] = $address['province_id'];
			$params['city_id'] = $address['city_id'];
			$params['district_id'] = $address['district_id'];
			$params['community_id'] = $address['community_id'];
			$params['address'] = $address['address'];
		}else{
			$tel = '';
	        if(!empty($params['tel1']))
	        	$tel = $params['tel1'];
	        if(!empty($params['tel2']))
	        	$tel .= '-'.$params['tel2'];
	        if(!empty($params['tel3']))
	        	$tel .= '-'.$params['tel3'];
	        $address_params = array(
	        	'user_id'        => $user_id,
	            'contact_name'   => $params['contact_name'],
	        	'tel'            => $tel,
	        	'phone'          => $params['phone'],
	        	'province_id'    => $params['province_id'],
	        	'city_id'        => $params['city_id'],
	        	'district_id'    => $params['district_id'],
	        	'community_id'   => $params['community_id'],
	        	'address'        => $params['address'],
	        	'add_ts'         => $now,
        	);
        	$address_id = $this->_sample_db->addAddress($address_params);
		}
		
		// 2、添加订单信息
		$order_sn = 'MJ_'.date('YmdHis').randomkeys(6);
		$goods = $this->getGoods($params['goods_id']);
		$total_price = $goods['goods_price']*$params['goods_num'];
        $order_params = array(
            'order_sn'     => $order_sn,
        	'user_id'      => $user_id,
        	'goods_id'     => $params['goods_id'],
        	'goods_num'    => $params['goods_num'],
        	'total_price'  => $total_price,
        	'address_id'   => $address_id,
        	'add_ts'       => $now,
        	'contact_name'   => $params['contact_name'],
        	'tel'            => $tel,
        	'phone'          => $params['phone'],
        	'province_id'    => $params['province_id'],
        	'city_id'        => $params['city_id'],
        	'district_id'    => $params['district_id'],
        	'community_id'   => $params['community_id'],
        	'address'        => $params['address'],
        );

        if (0 === ($order_id = $this->_db->add($order_params))) 
        {
            $this->error = '添加订单失败';
            return false;
        }
        
        // 3、样品、检测人信息
        $goods_num = $params['goods_num'];
        for($index=1; $index <= $goods_num; $index++)
        {
        	$person_id = $params['person_id_'.$index];
        	$person_contact = $this->_person_db->getPersonContactByPersonId($person_id);
        	//添加检测人信息
	        $sample_params = array(
	        	'order_id'          => $order_id,
	        	'person_id'         => $person_id,
	        	'person_contact_id' => $person_contact['person_contact_id'],
	        	'contact_id'        => $person_contact['contact_id'],
	//        	'add_ts'            => $now
	        );
       	 	$this->_sample_db->add($sample_params);
       	 	
       	 	// 还原待检测人标记
       	 	$this->_person_db->edit($person_id, array('is_mark'=>''));
        }
        
        return $order_id;
    }
    
    /**
     * 
     * 编辑订单
     * @param $order_id
     * @param $params
     */
	public function edit($order_id, $params)
    {
    	$order_id = intval($order_id);
        if ($order_id < 1) 
        {
            $this->error = '订单ID不正确';
            return false; 
        }
        if (empty($params)) 
        {
            $this->error = '编辑的内容为空';
            return false;
        }
        
       $order_params = array(
        	'goods_id'     => $params['goods_id'],
        	'goods_num'    => $params['goods_num'],
        	'address_id'   => $params['address_id'],
        );
        
        if (false === $this->_db->edit($order_id, $order_params))
        {
            $this->error = '编辑订单失败';
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * 订单支付
     * @param $order_id
     */
    public function pay($order_id)
    {
    	if(false === $this->_db->edit($order_id, array('pay_status'=>2)))
    	{
    		$this->error = '支付订单失败';
    		return false;
    	}
    	return true;
    }
    
    /**
     * 
     * 取消订单
     * @param $order_id
     */
    public function delete($order_id)
    {
    	if(false === $this->_db->edit($order_id, array('order_status'=>5)))
    	{
    		$this->error = '取消订单失败';
    		return false;
    	}
    	return true;
    }
    
    /**
     * 
     * 查询订单
     * @param $params
     */
    public function browse($params,$limit)
    {
    	$infos = $this->_db->browse($params,$limit);

        if (false === $infos) 
        {
            $this->error = $this->_db->getError();
            return false;
        }
        if (empty($infos)) 
            return array();
        foreach ($infos as &$info)
        {
        	$info['order_status_name'] = $this->_search_option['order_status'][$info['order_status']]['val'];
        	$info['pay_status_name'] = $this->_search_option['pay_status'][$info['pay_status']]['val'];
        }

        return $infos;
    }
    
    /**
     * 
     * 查询套餐
     * @param $params
     */
    public function browseGoods($params)
    {
    	$infos = $this->_db->browseGoods($params);

        if (false === $infos) 
        {
            $this->error = $this->_db->getError();
            return false;
        }
        if (empty($infos)) 
            return array();

        return $infos;
    }
    
    /**
     * 
     * 获取套餐信息
     * @param $goods_id
     */
    public function getGoods($goods_id)
    {
    	return $this->_db->getGoods($goods_id);
    }
	
}