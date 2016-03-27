<?php
namespace Common\Logic;
/**
 * 系统公共模块
 * 添加时间2014/9/22
 *
 *
 * @return void
 */
class CommonLogic 
{
    
	public function __construct()
    {
        $this->_db = new \Common\Model\CommonModel();
	}

   /**
     * 获取配置信息
     * @return array 配置数组
     * 
     */
    public function getGlobalConfig(){
        $data   = $this->_db -> getConfig();
        $config = array();
        if($data && is_array($data)){
            foreach ($data as $value) {
                $config[strtoupper($value['name'])] = $value['value'];
            }
        }
        return $config;
    }




}