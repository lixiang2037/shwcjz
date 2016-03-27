<?php
namespace Home\Model;
use Think\Model;

/**
 * 
 * 订单管理
 * 添加时间2015/10/26
 *
 */
class OrderModel extends Model
{
	public function __construct()
    {
        $this->db        = M('Order');
        $this->goods_db  = M('Goods');
    }
    
	/**
     * 
     * 根据订单id获取信息
     * @param $order_id
     */
    public function get($order_id)
    {
    	return $this->db->find($order_id);
    }
    
    /**
    *
    * 统计订单
    *
    *
    */
    public function getCount($params)
    {
        return $this->db->where($params)->count();
    }

	/**
	 * 添加订单
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
	 * @param $order_id
	 * @param $params
	 */
    public function edit($order_id, $params)
    {
        $order_id = intval($order_id);

        if ($order_id < 1) 
        {
            $this->error = '订单Id不正确';
            return false;
        }
        if (count($params) < 1) 
        {
            $this->error = '参数为空';
            return false;
        }

        return $this->db->where("order_id = '{$order_id}'")->save($params);
    }
    
    /**
     * 
     * 查询订单
     * @param $params
     */
	public function browse($params,$limit)
    {
    	 $_condition['1'] = "1=1";

        if(!empty($params['s']))
        {
        	if($params['s'] == -1)
        		$_condition[] = "order_status in (1,2,3)";
        	else 
        		$_condition[] = "order_status = '{$params['s']}'";
        }
        !empty($params['pay_status']) && $_condition[] = "pay_status = '{$params['pay_status']}'";
        
        $user_id = get_user_id();
		$_condition[] = "user_id = '{$user_id}'";
        return $this->db->where($_condition)->order('order_id desc')->limit($limit)->select();
    }
    
    /**
     * 
     * 查询套餐
     * @param $params
     */
	public function browseGoods($params)
    {
    	 $_condition['1'] = "1=1";

        !empty($params['status']) && $_condition[] = "status = '{$params['status']}'";

        return $this->goods_db->where($_condition)->order('goods_id desc')->select();
    }
    
    /**
     * 
     * 获取套餐
     * @param $goods_id
     */
    public function getGoods($goods_id)
    {
    	return $this->goods_db->find($goods_id);
    }
}

