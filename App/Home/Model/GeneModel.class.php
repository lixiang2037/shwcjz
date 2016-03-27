<?php
namespace Home\Model;
use Think\Model;

/**
 * 
 * 基因管理
 * 添加时间2015/10/26
 *
 */
class GeneModel extends Model
{
	public function __construct()
    {
        $this->db            = M('Gene');
        $this->user_login_db = M('Retrieval_datail');
        
    }
    
	/**
     * 
     * 根据用户id获取信息
     * @param $user_id
     */
    public function get($gene_id)
    {
    	return $this->db->find($gene_id);
    }
    
	/**
	 * 添加基因文件
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
	 * @param $gene_id
	 * @param $params
	 */
    public function edit($gene_id, $params)
    {
        $gene_id = intval($gene_id);

        if ($gene_id < 1) 
        {
            $this->error = '基因Id不正确';
            return false;
        }
        if (count($params) < 1) 
        {
            $this->error = '参数为空';
            return false;
        }

        return $this->db->where("gene_id = '{$gene_id}'")->save($params);
    }
    
	/**
     * 
     * 查询基因库数量
     * @param $params
     */
	public function getCount($params)
    {
        $_condition = $this->_getBrowseCondition($params);

        return $this->db->where($_condition)->count('gene_id');
    }
    
    /**
     * 
     * 处理查询基因库条件
     * @param $params
     */
    private function _getBrowseCondition($params)
    {
    	$_condition['1'] = "1=1";

    	$user_id = get_user_id();
		$_condition[] = "user_id = '{$user_id}'";
        !empty($params['is_search']) && $_condition[] = "is_search = '{$params['is_search']}'";
        
        return $_condition;
    }
    
    /**
     * 
     * 获取基因库列表
     * @param $params
     * @param $limit
     */
	public function browse($params,$limit)
    {
    	$_condition = $this->_getBrowseCondition($params);
        return $this->db->where($_condition)->order('gene_id desc')->limit($limit)->select();
    }
    
}