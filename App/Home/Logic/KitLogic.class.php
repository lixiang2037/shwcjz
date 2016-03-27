<?php
namespace Home\Logic;
/**
 * 
 * 试剂盒管理模块
 * 添加时间2015/12/04
 *
 */
class KitLogic 
{
    private $_search_option = array();
	public function __construct()
    {
	   $this->_db    = new \Admin\Model\KitModel;
	   
       $this->_search_option = array(
            'status' => array(
                '1' => array('id' => 1, 'val' => '正常', 'default' => '1'),
                '2' => array('id' => 2, 'val' => '关闭'),
            ),
 			'kit_select' => $this->_db->getKitOption(),
        );
        
        /*导入phpExcel核心类 */
        require_once '../ThinkPHP/Library/Vendor/PHPExcel/IOFactory.php';
        
        require_once  '../ThinkPHP/Library/Vendor/PHPExcel.php';
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
	 * 通过Id获取试剂盒
	 * @param $kit_id
	 */
	public function get($kit_id)
	{
		$kit_id = intval($kit_id);
		if($kit_id < 1)
		{
			$this->error = '试剂盒Id不正确';
			return false;
		}
		$info = $this->_db->get($kit_id);
		if(empty($info))
		{
			$this->error = '试剂盒信息不存在';
			return false;
		}
		return $info;
	}
	
  
    /**
     * 
     * 通过位点Id查询
     * @param $locus_id
     */
    public function getLocus($locus_id)
    {
    	$locus_id = intval($locus_id);
		if($locus_id < 1)
		{
			$this->error = '位点Id不正确';
			return false;
		}
		
    	return $this->_db->getLocus($locus_id);
    }
    
    /**
     * 
     * 导出模板
     * @param $kit_id
     */
	public function exportTemplate($kit_id)
	{
		$kit_locus = $this->_db->getLocusByKitId($kit_id);
		if(empty($kit_locus))
		{
			$this->error = '该试剂盒没有位点信息';
			return false;
		}
		
		$objPHPExcel = new \PHPExcel();

		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getProperties()->setTitle("locus");
        $objPHPExcel->getActiveSheet()->setTitle('locus');
		
		$j = 0;
		for ($i = ord('A'); $i <= ord('Z'); $i++)
    	{
    		if(!empty($kit_locus[$j]))
    		{
    			$locus_name = $kit_locus[$j]['locus_name'];
    			$k = chr($i);
    			$objPHPExcel->getActiveSheet()->setCellValue($k.'1', $locus_name);
    			$j++;
    		}else 
    			break;
    		
    	}
		$kit = $this->_db->get($kit_id);
		$name = $kit['kit_name'];
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$name.'.xls"');
		header('Cache-Control: max-age=0');
		
		// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
	
	/**
	 * 
	 * 通过试剂盒Id查询位点
	 * @param $kit_id
	 */
	public function getLocusByKitId($kit_id)
	{
		return $this->_db->getLocusByKitId($kit_id);
	}
    
	/**
	 * 
     * 返回错误信息
     *
     **/
    public function getError()
    {
        return $this->error;
    }
	
}