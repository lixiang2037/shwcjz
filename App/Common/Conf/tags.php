<?php
/*
app_init    应用初始化标签位
path_info   PATH_INFO检测标签位
app_begin   

*/
// 全局行为插件
return array(
    'app_begin' => array(
        'Common\\Behaviors\\GlobalBehavior', //全局信息
    ),
);