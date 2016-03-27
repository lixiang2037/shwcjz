<?php
namespace Home\Model;
use Think\Model;

/**
 * 区域模块
 * 添加时间2014/12/16
 *
 *
 * @return void
 */
class AreaModel extends Model 
{
    public function __construct()
    {
        $this->db         = M('Area');
    }

    /**
     * 根据parent_id获取地址信息
     *
     * @param    level
     *
     * @return   array
     **/
    public function getAreaInfosByParentId($parent_id)
    {
        $parent_id = intval($parent_id);

        $infos = $this->db->where("parent_id='{$parent_id}'")->select();

        if (empty($infos)) {
            return $infos;
        }

        return singleGroup($infos, 'area_id');
    }


	/** 
     * 获取数据信息
     *
     * @param    array
     *
     * @return   array
     */
	public function getConditionList($map)
	{
		$order = 'area_id ASC';
		$data = $this->db->where($map)->order($order)->select();
		return $data;
	}
	
	/**
     * 根据ID获取区域信息
     *
     * @param    int
     *
     * @return   array
     **/
    public function get($area_id)
    {
        $area_id = intval($area_id);
        if ($area_id < 1) {
            $this->error = '区域ID为空';
            return false;
        }

        return $this->db->find($area_id);
    }


    /**
     * 返回错误信息
     *
     * @return    string
     **/
    public function getError()
    {
        return $this->_error;
    }

}