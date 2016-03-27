<?php
namespace Home\Logic;
/**
 * 区域模块
 * 添加时间2014/12/16
 *
 *
 * @return void
 */
class AreaLogic 
{
    private $_search_option = array();
	public function __construct()
    {
	   $this->_db    = new \Home\Model\AreaModel;
       $this->_search_option = array(
            'province' => $this->_db->getAreaInfosByParentId(0),
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
     * 根据parent_id获取地区信息
     *
     * @param    int 
     *
     * @return   array
     **/
    public function getAreaInfosByParentId($parent_id)
    {
        return $this->_db->getAreaInfosByParentId($parent_id);
    }



	/** 
     * 获取地区数据信息
     *
     * @param    array
     *
     * @return   array
     **/
	public function getConditionList($map)
	{
		return $this->_db->getConditionList($map);
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