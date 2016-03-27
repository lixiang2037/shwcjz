<?php
namespace Home\Logic;

/**
 * 
 * 基因管理
 * 添加时间2015/10/26
 *
 */
class GeneLogic
{
	public function __construct()
	{
		$this->_db        = new \Home\Model\GeneModel;
		$this->_person_db = new \Home\Model\PersonModel;
		$this->_sample_db = new \Home\Model\SampleModel;
		
		 $this->_kit_db   = new \Admin\Model\KitModel;
		
		$this->_search_option = array(
		
			'contacts' => $this->_person_db->getContactOption(),
		
       		'contact_type' => array(
                '1' => array('id' => 1, 'val' => '本人'),
                '2' => array('id' => 2, 'val' => '组织机构'),
				'3' => array('id' => 3, 'val' => '父亲'),
				'4' => array('id' => 4, 'val' => '母亲', 'default' => '4'),
				'5' => array('id' => 5, 'val' => '其他监护人'),
			),
            'sex' => array(
			    '2' => array('id' => 2, 'val' => '女'),
                '1' => array('id' => 1, 'val' => '男', 'default' => '1'),
                '0' => array('id' => 0, 'val' => '未知'),
			)
		);
		/*导入phpExcel核心类 */
        require_once '../ThinkPHP/Library/Vendor/PHPExcel/IOFactory.php';
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
	 * 查询上传基因文件
	 * @param $gene_id
	 */
	public function get($gene_id)
    {
    	$gene_id = intval($gene_id);
    	
        if ($gene_id < 1) 
        {
            $this->error = '基因文件Id不正确';
            return false;
        }
        $info = $this->_db->get($gene_id);
        if (empty($info)) 
        {
            $this->error = '没有相关记录';
            return false;
        }

        return $info;
    }
    
	/**
     * 
     * 添加基因检测文件
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
		
		/*
		$locus_array = array();
		foreach ($kit_locus as $locus)
		{
			$locus_array[] = $locus['locus_name'];
		}
    	if(empty($p['gene_file']['name']))
    	{
    		$this->error = '请选择要上传的文件';
    		return false;
    	}
    	$result = upload_file('gene_file');
    	if($result['status'])
    	{
    		$filepath = $result['filepath'];
    		//获取excel文件
    		$objPHPExcel = \PHPExcel_IOFactory::load($filepath);
    		$objPHPExcel->setActiveSheetIndex(0);
    		$sheet0 = $objPHPExcel->getSheet(0);
			$import_data = array();
    		for ($i = ord('A'); $i <= ord('Z'); $i++)
    		{
    			$k = chr($i);
    			$cell = $objPHPExcel->getActiveSheet()->getCell($k.'1')->getValue();
    			if(empty($cell))
    				break;	
    			else
    				$import_data[] = $cell; 
    		}
			$r = array_diff($locus_array, $import_data);
			if(empty($r)) // 验证上传的位点和试剂盒对应的位点是否相同  TODO上传文件
			{
				
			}else
			{
				$this->error = '上传位点与试剂盒不统一，请确认';
				return false;
			}
    	}else
    	{
    		$this->error = $result['msg'];
    		return false;
    	}
		
		// 导入end
		
		 */
		
		$check_type = $params['check_type'];
		if($check_type == 1)  // 美吉检测
		{
			$sample_sn = $params['sample_sn'];
			$sample = $this->_sample_db->getBySampleSn($sample_sn);
			if(empty($sample))
			{
				$this->error = '美吉样品编号不存在，请确认';
				return false;
			}
			
			$order_id  = $sample['order_id'];
			$sample_id = $sample['sample_id'];	
			$person_id = $sample['person_id'];	
				
		}elseif ($check_type == 2) // 外部检测
		{
			// 导入基因信息
			$kit_id = $params['kit_id'];
			if(empty($kit_id))
			{
				$this->error = '请选择试剂盒';
				return false;
			}
	    	$kit_locus = $this->_kit_db->getLocusByKitId($kit_id);
			if(empty($kit_locus))
			{
				$this->error = '该试剂盒没有位点信息';
				return false;
			}
			$person_params = array(
				'user_id'      => $user_id,
				'person_name'  => $params['person_name'],
				'sex'          => $params['sex'],
				'id_num'       => $params['id_num'],
				'byear'        => $params['byear'],
				'bmonth'       => $params['bmonth'],
				'bday'         => $params['bday'],
				'province_id'  => $params['province_id'],
        		'city_id'      => $params['city_id'],
        		'district_id'  => $params['district_id'],
        		'community_id' => $params['community_id'],
        		'address'      => $params['address'],
			);
			$person_id = $this->_person_db->add($person_params);
			$person_contact_params = array(
				'person_id'    => $person_id,
				'contact_id'   => $params['contact_id'],
				'contact_type' => $params['contact_type'],
			);
			$person_contact_id = $this->_person_db->addPersonContact($person_contact_params);
			
			// 外部检测没有订单和样品相关信息
			$order_id = $sample_id = '';
		}
		$retrieval_sn = 'JY_'.date('YmdHis').randomkeys(4);
        $gene_params = array(
        	'retrieval_sn' => $retrieval_sn,
        	'user_id'     => $user_id,
        	'kit_id'      => $kit_id,
        	'person_id'   => $person_id,
//        	'is_public'   => $params['is_public'],
        	'order_id'    => $order_id,
        	'sample_id'   => $sample_id,
        	'is_search'   => $params['is_search'],
        	'add_ts'      => date('Y-m-d H:i:s'),
        );
        
    	foreach ($kit_locus as $locus)
		{
			$locus_name = $locus['locus_name'];
			$gene_params[$locus_name] = $params[$locus_name];
		}

        if (0 === ($gene_id = $this->_db->add($gene_params))) 
        {
            $this->error = '添加基因信息失败';
            return false;
        }
        
        return true;
    }
    
   /**
    * 
    * 编辑基因检测文件
    * @param $gene_id
    * @param $params
    */
	public function edit($gene_id, $params)
    {
    	$gene_id = intval($gene_id);
        if ($gene_id < 1) 
        {
            $this->error = '基因ID不正确';
            return false; 
        }
        if (empty($params)) 
        {
            $this->error = '编辑的内容为空';
            return false;
        }
        
       $gene_params = array(
        	'gene_file'   => $params['gene_file'],
        	'user_id'     => $user_id,
        	'person_id'   => $params['person_id'],
        	'is_public'   => $params['is_public'],
        	'order_id'    => $params['order_id'],
        	'sample_id'   => $params['sample_id'],
        );
        
        if (false === $this->_db->edit($gene_id, $gene_params))
        {
            $this->error = '编辑基因失败';
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * 查询基因文件
     * @param $params
     */
    public function browse($params)
    {
    	$infos = $this->_db->browse($params);

        if (false === $infos) 
        {
            $this->error = $this->_db->getError();
            return false;
        }
        if (empty($infos)) 
            return array();
            
        foreach ($infos as &$info)
        {
        	$person = $this->_person_db->get($info['person_id']);
        	$info['person_name'] = $person['person_name'];
        	$info['is_search_name'] = $info['is_search'] == 1? '是':'否';
        }

        return $infos;
    }
    
	/**
	 * 返回错误信息
	 *
	 * @return    string
	 */
	public function getError()
	{
		return $this->error;
	}
	
}