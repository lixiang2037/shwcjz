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
        $this->_api          = new \Home\Logic\UserLogic();
        $this->_area_api     = new \Home\Logic\AreaLogic();
    }
	
	/**
	 * 默认页面
	 * 
	 */
    public function index()
    {
    	$this->assign('page_title', '美吉生物-寻亲平台');
		$this->display();
    }
    
    /**
     * 
     * 关于我们
     */
    public function about()
    {
    	$this->assign('page_title', '寻亲平台-公司简介');
    	$this->display();
    }
    
    /**
     * 
     * 企业资质
     */
    public function qualification()
    {
    	$this->assign('page_title', '寻亲平台-权威资质');
    	$this->display();
    }
    
    /**
     * 
     * 隐私声明
     */
    public function conceal()
    {
    	$this->assign('page_title', '寻亲平台-隐私声明');
    	$this->display();
    }
    
    /**
     * 
     * 联系我们
     */
    public function contact()
    {
    	$this->assign('page_title', '寻亲平台-联系我们');
    	$this->display();
    }
    
    
    /**
     * 
     * 亲子保护
     */
    public function child()
    {
    	$this->assign('page_title', '寻亲平台-亲子保护');
    	$this->display();
    }
    
    /**
     * 
     * 寻亲团圆
     */
    public function tracing()
    {
    	$this->assign('page_title', '寻亲平台-寻亲团圆');
    	$this->display();
    }
    
    /**
     * 
     * 名人基因
     */
    public function celebrity()
    {
    	$this->assign('page_title', '寻亲平台-名人基因');
    	$this->display();
    }
}