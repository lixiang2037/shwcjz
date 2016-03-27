<?php
return array(
    'SESSION_PREFIX' => 'sso_',
    'COOKIE_PREFIX'  => 'sso_',
    'SESSION_IDLE'   => '5400',
    'DEFAULT_FILTER' => '',
	
	/* 生信分析系统跳转及错误页面模板 */
	'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/jump.tpl', // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Public/jump.tpl', // 默认成功跳转对应的模板文件
	'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Public/exception.tpl',// 异常页面的模板文件
);
