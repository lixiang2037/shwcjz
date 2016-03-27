<?php
namespace Home\Model;
use Think\Model;

/**
 * 试剂盒管理模块
 * 添加时间2015/12/04
 *
 */
class KitModel extends Model 
{
    public function __construct()
    {
        $this->db        = M('Kit');
        $this->locus_db  = M('Locus');
    }
    
    /**
     * 
     * 获取试剂盒选项
     */
    public function getKitOption()
    {
    	$infos = $this->db->where("status = 1")->field('kit_id, kit_name')->select();
    	return singleGroup($infos, 'kit_id');
    }
    
	/**
     * 
     * 根据Id获取
     * @param $order_id
     */
	public function get($kit_id)
    {
        $kit_id = intval($kit_id);
        if ($kit_id < 1) 
        {
            $this->error = '试剂盒Id为空';
            return false;
        }

        return $this->db->find($kit_id);
    }
    
    /**
     * 
     * 通过试剂盒名称查询
     * @param $kit_name
     */
    public function getKitByName($kit_name)
    {
    	return $this->db->where("kit_name = '{$kit_name}'")->find();
    }
        
    /**
     * 
     * 通过试剂盒Id和位点名称查询位点
     * @param $kit_id
     * @param $locus_name
     */
    public function getLocusByKitIdAndName($kit_id, $locus_name)
    {
    	return $this->locus_db->where("kit_id = '{$kit_id}' and locus_name='{$locus_name}'")->find();
    }
    
    /**
     * 
     * 通过位点Id查询
     * @param $locus_id
     */
    public function getLocus($locus_id)
    {
    	return $this->locus_db->find($locus_id);
    }
        
    /**
     * 
     * 通过试剂盒Id查询位点
     * @param $kit_id
     */
    public function getLocusByKitId($kit_id)
    {
    	if ($kit_id < 1) 
        {
            $this->error = '试剂盒Id不正确';
            return false;
        }
        return $this->locus_db->where("kit_id = '{$kit_id}'")->select();
    }
    
}