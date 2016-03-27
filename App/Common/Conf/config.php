<?php
return array(
    'DB_FIELDS_CACHE' => false,
    /* 数据库配置 */
    'DB_TYPE'   => 'mysql',          // 数据库类型
    'DB_HOST'   => 'localhost',  // 服务器地址
    'DB_NAME'   => 'goldenkey',             // 数据库名
    'DB_USER'   => 'root',           // 用户名
    'DB_PWD'    => '',           // 密码
    'DB_PORT'   => '3306',           // 端口
	'DB_PREFIX' => 'gd_',            // 表前缀
	'DB_CHARSET'=> 'utf8', 

    /* 模板引擎设置 */
    'TMPL_TEMPLATE_SUFFIX' => '.tpl',

    /* URL设置 */
    'URL_MODEL' => 2,
    'URL_HTML_SUFFIX' => '.html',

    //定义不允许访问模块
    'MODULE_DENY_LIST' => array('Common'),

    //定义允许访问模块
    'MODULE_ALLOW_LIST' => array('Home','Admin'),  
    
    /* 关闭缓存 */
	'DB_FIELD_CACHE' => true,
	'HTML_CACHE_ON' => false,

    //定义session为memcache
    'SESSION_TYPE' => 'Memcache',

    //Memcache服务器
    'MEMCACHE_HOST' => '127.0.0.1',

    //Memcache端口
    'MEMCACHE_PORT' => 11211,

    //Memcache的session信息有效时间
    //'SESSION_EXPIRE' => 10,
    'WWW_GK_COM'      => 'http://www.gd.com', 
    //模块域名配置
    'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    => array(  
                            'www'         => 'Home',      // 妈妈金钥匙站点
                            'admin'       => 'Admin',     // 后台管理系统
    ), 

);