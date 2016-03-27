<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 默认控制器
 * 
 */
class IndexController extends Controller
{
	
	public function _initialize()
    {
        // $this->_api          = new \Home\Logic\UserLogic();
        // $this->_area_api     = new \Home\Logic\AreaLogic();
    }
	
	/**
	 * 默认页面
	 * 
	 */
    public function index()
    {
		$this->display();
    }
    
    
}