<?php
namespace Common\Model;
use Think\Model;

/**
 * 系统公共模块
 * 添加时间2014/9/22
 *
 *
 * @return void
 */
class CommonModel extends Model
{
    public function __construct()
    {
        $this->config_db     = M('Config');
    }

	/**
     * 取得系统配置信息
     *
     * @param    array    $where
     * @return   array
     */
	public function getConfig($where = null)
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
		return $this->config_db->where($whereSql)->select();
	}
  
  
  
}