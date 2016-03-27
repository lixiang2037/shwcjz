<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 系统基本控制器
 *
 * 添加时间2015/09/23
 *
 */
class BaseController extends Controller
{
    public function _initialize()
    {

    }

    /**
     * 空操作处理
     *
     */
    public function _empty() {
	    $this->_404();
    }
	
    /**
     * 404
     *
     * @param string $url
     */	 
    protected function _404($url = ''){
        if ($url) {
            $this->redirect($url);
        } else {
            send_http_status(404);
            $this->display('Public/404');
            exit;
        }
    }
}