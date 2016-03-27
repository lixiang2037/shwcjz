<?php
namespace Common\Behaviors;
use Think\Behavior;

class GlobalBehavior extends Behavior
{
    public function run(&$params)
    {
        if(!(C('BASIC')))
        {
            $this->_api = new \Common\Logic\CommonLogic();
            /* 读取站点配置 */
            $config = $this -> _api ->getGlobalConfig();
            C($config); //添加配置
            
        }
        if(MODULE_NAME != 'Admin' && C('SHOP_CLOSE'))
        {
            exit(C('SHOP_CLOSE_REASON'));
        }
        
        
    }
    
    
}

