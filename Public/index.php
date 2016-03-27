<?php
header("Content-type:text/html; charset=utf-8");
// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('PHP环境不支持，使用本系统需要 PHP > 5.3.0 版本才可以~ !');
}
// 系统设置
@set_time_limit(3600);
@ini_set('max_execution_time', 3600);
@ini_set('max_input_time', 3600);
@ini_set('upload_max_filesize', '5G');
@ini_set('post_max_size', '5G');
@ini_set('file_uploads', '50');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);
// 正式运行改成true，开发调试模式设置为false
define('APP_Cache', false);
// 本地存储路径
define('OSS_LOCAL_PATH', dirname(__FILE__));
// 定义应用目录
define('APP_PATH','../App/');
/**
 * 缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define ('RUNTIME_PATH', '../Runtime/');
// 定义站点域名
define('SITE_DOMAIN', strip_tags($_SERVER['HTTP_HOST']));
// 引入ThinkPHP入口文件
require '../ThinkPHP/ThinkPHP.php';