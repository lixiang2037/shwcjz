<?php

/**
 * 删除目录或者文件
 * @param  string  $path
 * @param  boolean $is_del_dir
 * @return fixed
 */
function del_dir_or_file($path, $is_del_dir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        // $path为目录路径
        while (false !== ($item = readdir($handle))) {
            // 除去..目录和.目录
            if ($item != '.' && $item != '..') {
                if (is_dir("$path/$item")) {
                    // 递归删除目录
                    del_dir_or_file("$path/$item", $is_del_dir);
                } else {
                    // 删除文件
                    unlink("$path/$item");
                }
            }
        }
        closedir($handle);
        if ($is_del_dir) {
            // 删除目录
            return rmdir($path);
        }
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}

/**
 * 把文件打包成为zip
 * @param  array $files       需要打包在同一个zip中的文件的路径
 * @param  string $out_dir    zip的文件的输出目录
 * @param  [type] $des_name   zip文件的名称m
 * @return boolean            打包是否成功
 */
function zip($files, $file_path, $out_dir, $des_name) {
    $zip = new ZipArchive;
    // 创建文件夹
    mkdir($out_dir);
    // 打包操作
    $result = $zip->open($out_dir . '/' . $des_name, ZipArchive::CREATE);
    if (true !== $result) {
        return false;
    }

    foreach ($files as $file) {
        // 添加文件到zip包中
        $zip->addFile($file_path . '/' . $file,
                      str_replace('/', '', $file));
    }
    $zip->close();
    return true;
}

/**
 * 解压zip文件
 * @param  string $zip_file 需要解压的zip文件
 * @param  string $out_dir  解压文件的输出目录
 * @return boolean          解压是否成功
 */
function unzip($zip_file, $out_dir) {
    $zip = new ZipArchive();
    if (true !== $zip->open($zip_file)) {
        return false;
    }
    $zip->extractTo($out_dir);
    $zip->close();
    return true;
}


//截取干净字符串
function getSubStrEllipsis($str, $len=62, $suffix=' ...')
{
    $str = trim(strip_tags($str));
    $str = str_replace(array("\r\n", "\r", "\n"), '', $str);
    $str = preg_replace('/\s(?=\s)/', '', $str);
    if(strlen($str) <= $len){ return $str; }
    $str = substr($str, 0, $len);
    return $str.$suffix;
}

//把字符串变换成seo格式
function the_seo_filter($string, $limit=1)
{
    $retval = $string;
    $pattern = '/[\p{P}\p{S}]/u';
    $pattern_letter = '/[!"#$%&\'()*+,.\/:;<=>?@[\\\]^_`{|}~]/';
    $retval = preg_replace($pattern, '', strtolower($retval));
    $retval = preg_replace($pattern_letter, '', $retval);
    $retval = preg_replace('/\s/', '-', $retval);
    $foo = explode('-', $retval);
    foreach($foo as $value){
        switch (true){
            case ( strlen($value) <= $limit ):
                continue;
            default:
                $container[] = $value;
                break;
        }
    }
    $container = ( sizeof($container) > 0 ? implode('-', $container) : $string );
    return $container;
}

//得到一个网址的主域名
function getUrlDomain($url='')
{
    $url = trim($url); if($url == ''){ return false; }
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}

//自定义加密函数
function xr_encode($str)
{
    return md5($str.'_xr');
}

//获取文件夹中的文件列表
function getDirFile($dir, $pre='')
{
    $dir = $_SERVER['DOCUMENT_ROOT'].$dir;
    $fileArray = array();
    if(is_dir($dir)){

        if (false != ($handle = opendir($dir)))
        {
            $i=0;
            while ( false !== ($file = readdir($handle)) )
            {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file!="." && $file!=".." && strpos($file,"."))
                {
                    $fileArray[$i] = $pre.$file;
                    $i++;
                }
            }
            //关闭句柄
            closedir( $handle );
        }
    }
    return $fileArray;
}

//把xml文件解析成数组
function _xmlToArray($file, $type=false, $returnArray=true)
{
    $file = trim($file);
    if($type){
        if(!is_file($file)){return null;}
        $str = simplexml_load_file($file);
    }else{
        if($file == ''){return null;}
        $str = simplexml_load_string($file);
    }
    return json_decode(json_encode($str), $returnArray);
}

/**
 * 对查询结果集进行排序
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param string $sortby 排序类型 asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby='asc')
{
    if(is_array($list)){
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc':// 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ( $refer as $key=> $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pk
 * @param string $pid parent标记字段
 * @param string $child 子数组标记
 * @param int $root
 * @return array
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array())
{
    if(is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if(isset($reffer[$child])){
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby='asc');
    }
    return $list;
}

/**
 * 把多维数组转化成一维数组
 *
 * @param array $arr 需要转换的数组，必须有相同的子节点
 * @param string $sub 子节点名称
 * @param array &$rs 返回的引用数组
 *
 * @return array
 */
function floatArray($arr=array(), $sub='_sub', &$rs)
{
    if(empty($arr)){ return false; }
    foreach($arr as $v){
        $tmp2 = $v;
        if(isset($tmp2[$sub])){
            unset($tmp2[$sub]);
            $rs[] = $tmp2;
            floatArray($v[$sub], $sub, $rs);
        }else{
            $rs[] = $v;
        }
    }
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}

/*调试输出，打印结果，用法ddd($datas, 1)*/
function ddd($var, $exit=false, $printr=false){
    if($printr){
        echo '<pre>';print_r($var);echo '</pre>';
    }else{
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if(!extension_loaded('xdebug')){
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>'. htmlspecialchars($output, ENT_QUOTES).'</pre>';
        }
        echo $output;
    }
    if ($exit){exit;}
    else{return;}
}

//_mkDir
function _mkDir($dir, $mode=0777){
    if (!is_dir($dir)) {
        _mkDir(dirname($dir), $mode);
        $old = umask(0);
        @mkdir($dir, $mode);
        umask($old);
        return true;
    }
    return true;
}

//判断是否为email
function isEmail($str)
{
    return (filter_var($str, FILTER_VALIDATE_EMAIL) === false) ? false : true;
}

//手机
function isMobile($string){
    return preg_match('/^1[345678]+\d{9}$/', $string);
}
//电话
function isPhone($string) {
    return preg_match('/\d{8,18}$/', $string);
}
//随机字符
function _randStr($len=6, $type=3, $addChars=null){
    $str = '';
    switch($type) {
        case 1:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 2:
            $chars = str_repeat('0123456789',3);
            break;
        case 3:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
            break;
        case 4:
            $chars = 'abcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        default :
            $chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
            break;
    }
    if($len>10){$len = 10;}
    $charLen = strlen($chars) - 1;
    for($i=0; $i<$len; $i++){
        $str .= $chars[mt_rand(0, $charLen)];
    }
    return $str;
}

//过滤输出数据库数据
function Out($data, $filters='stripslashes')
{
    $filters = explode(',', $filters);
    foreach($filters as $filter){
        if(function_exists($filter)) {
            $data = is_array($data) ? arrayMapRecursive($filter, $data) : $filter($data);
        }
    }
    return $data;
}

//过滤输出数据库数据
function In($data, $filters='addslashes')
{
    $filters = explode(',', $filters);
    foreach($filters as $filter){
        if(function_exists($filter)) {
            $data = is_array($data) ? arrayMapRecursive($filter, $data) : $filter($data);
        }
    }
    return $data;
}

// 递归 array_map
function arrayMapRecursive($filter, $data)
{
    $result = array();
    foreach($data as $key => $val){
        $result[$key] = is_array($val) ? array_map_recursive($filter, $val) : call_user_func($filter, $val);
    }
    return $result;
}

//多个<br>化成一个
function merge_brs($string)
{
    $string = str_replace(array("\r\n", "\r", "\n"), '', $string);
    return preg_replace("/(<br\s?\/?>\s?)+/i", "<br/>", $string);
}

//把 n 换成 <br>
function nl_to_br($string)
{
    $string = str_replace(array("\r\n", "\r", "\n"), '<br/>', $string);
    return preg_replace("/(<br\s?\/?>\s?)+/i", "<br/>", $string);
}

//文件后缀名
function fileExt($filename, $len=10)
{
    return strtolower(trim(substr(strrchr($filename, '.'), 1, $len)));
}

//保留两位小数。如18.0000会得到string(18.00)；而round会得到float(18)
function _round($float, $n=2)
{
    return number_format($float, $n);
}

/**
 * 过滤
 * 
 * @param    array
 * @param    string
 *
 * @return   array
 */
function deep_filter($array, $method)
{
    if (empty($array)) {
        return $array;
    }
    if (is_string($array)) {
        return $method($array);
    } else if (is_array($array)){
        foreach ($array as $key => $val) {
            $array[$key] = deep_filter($val, $method);
        }
    }
    return $array;
}


/**
 * 按照key组合数组
 *
 * @param    array
 * @param    string
 *
 * @return   array
 **/
function singleGroup($array, $key)
{
	if (empty($array)) {
		return array();
	}

	$array1 = array();

	foreach ($array as $val) {
		$array1[$val[$key]] = $val;
	}

	return $array1;
}

/**
 * 按照key组合数组
 *
 * @param    array
 * @param    string
 *
 * @return   array
 **/
function arrayGroup($array, $key)
{
	if (empty($array)) {
		return array();
	}

	$array1 = array();

	foreach ($array as $val) {
		$array1[$val[$key]][] = $val;
	}

	return $array1;
}

function specialArrayGroup($array, $key, $grade = 0, $i = 0)
{
    if ($grade == $i) {
        return arrayGroup($array, $key);
    } else {
        foreach ($array as $ke => $val) {
            $i ++;
            if ($i <= $grade) {
                echo 'ke:'.$ke, '<br>';
                $array[$ke] =  specialArrayGroup($val, $key, $grade, $i);
            }
        }
    }
    return $array;
}

function special_array_group($array, $key) {
    foreach ($array as $ke => $val) {
        if (isset($val[0])) {
            $array[$ke] = arrayGroup($val, $key);
            $array[$ke] = array_merge(array('count' => count($array[$ke])),$array[$ke]);
        } else {
            
            $array[$ke] = special_array_Group($val, $key);
        }
    }

    return $array;
}

/**
 * 获取指定的键值
 * 
 * @param    array
 * @param    string
 *
 * @return   array
 */
function getSingleKey($array, $key)
{
    $infos = array();
    foreach ($array as $val) {
        isset($val[$key]) && $infos[] = $val[$key];
    }

    return $infos;
}


/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr 要连接的数组
 * @param  string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ',')
{
    return implode($glue, $arr);
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
        if (false === $slice) {
            $slice = '';
        }
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice . '...' : $slice;
}

/**
 * 转换存储单位
 *
 * @param    int
 * @param    string
 *
 * @return   string
 **/
function change_storage_unit($file_size, $unit = 'Byte')
{
    $arr = array('Byte', 'Kb', 'Mb', 'Gb');
    $unit = strtolower($unit);
    $unit = ucfirst($unit);
    $key = array_search($unit, $arr);
    if (false === $key) {
        return $file_size.$unit;
    }

    while($file_size >= '1024') {
        $file_size = $file_size / 1024;
        $key ++;
    }

    return sprintf("%.2f", $file_size) . $arr[$key];
}

function var_print($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

/**
 * 判断是否都为空
 *
 * @param    array
 *
 * @return   boolean
 **/
function isAllEmpty($array)
{
    $array = recurise_null($array);

    if (empty($array)) {
        return true;
    }

    return false;
}

/**
 * 判断是否为互斥的条件
 *
 * @param    array
 *
 * @return   boolean
 **/
function isReject($array)
{
    $array = recurise_null($array);
    if (empty($array)) {
        return false;
    }

    if (count($array) == 1) {
        return false;
    }

    return true;
}

/**
 * 递归过滤空值
 *
 * @param    array
 *
 * @return   boolean
 **/
function recurise_null($arr)
{
    foreach ($arr as $key => $val) {
        if (is_array($val)) {
            $value = array_filter(recurise_null($val));
            if (count($value) < 1) {
                unset($arr[$key]);
            } else {
                $arr[$key] = $value;
            }
        } else {
           if ($val === '0') {
                $arr[$key] = $val.'_';
           } else if ($val === '' || $val === null) {
                unset($arr[$key]);
            }
        }
    }

    return $arr;
}

/**
 * 获取文件扩展名
 *
 * @param    string
 *
 * @return   string
 **/
function getFileExtension($file)
{
    return '.'.pathinfo($file, PATHINFO_EXTENSION);
}

function numToStr($num){
    if (stripos($num,'e')===false) return $num;
    $num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串

    $location = substr($num, strpos($num, 'e')+1);
    $prefix_str = str_replace('.','',substr($num, 0, strpos($num, 'e')));
    if ($location < 0) {
        $num = '0.'.str_pad($prefix_str, strlen($prefix_str)+abs($location)-1, '0', STR_PAD_LEFT);
    }
    return $num;
}

/**
 * pdf转化成png
 *
 * @param    string
 *
 * @return   string
 **/
function pdf2png($pdf,$params)
{
    if (!extension_loaded('imagick')) {
        exit('没有安装imageick扩展!');
    }
    if (!file_exists($pdf)) { 
        exit('没有找到pdf');
    }

    $scale = !empty($params['scale']) ? $params['scale'] : 100;
    empty($params['page']) && $params['page'] = 0;
    $im = new Imagick();
    $im->setResolution(120,120);  //设置图像分辨率
    $im->setCompressionQuality($scale); //压缩比
    $im->readImage($pdf."[0]"); //设置读取pdf的第一页
    //$im->thumbnailImage(200, 100, true); // 改变图像的大小
    
    if (!empty($params['width']) && $params['height']) {
        $im->scaleImage($params['width'],$params['height'],true); //缩放大小图像
    }
    $params['file_path'] = "test.jpg";
    $file_name = $params['file_path'];
    if (empty($params['file_path'])) {
        exit('保存的路径需要填写');
    }
    if ($im->writeImage($file_name) == true) {
        return $file_name;
    }

    return '';
} 


function getMemcache()
{
	$cache = S(
				array(
					'type'   => 'memcache',
					'host'   => '192.168.10.51',
					'port'   => '11211',
					'prefix' => 'mem_user',
					'expire' => 1800)
			);
	return $cache;		
}

/**
 * 
 * 验证用户是否登录
 */
function is_user_login()
{
    $user_id = session('user_id');
    if(empty($user_id))
    {
    	$token = cookie('sg');
    	if(!empty($token))
    	{
	    	$data = decode($token);
	    	$data_arr = explode(',', $data);
	    	$user_db = new \Home\Model\UserModel;
	    	$info = $user_db->getUser(array('user_id'=>$data_arr[0], 'user_name'=>$data_arr[1]));
	    	$user_id = $info['user_id'];
	    	if(!empty($info))
	    	{
		    	session('user_id', $data_arr[0]);
				session('user_name', $data_arr[1]);
				session('member_id', $data_arr[2]);
				if($data_arr[3] != 'N'){
					session('nick_name', $data_arr[3]);
				}
		        if($data_arr[4] != 'N'){
					session('expert_id', $data_arr[4]);
				}
	    	}
    	}
    }
    return empty($user_id) ? 0 : $user_id;
}

/**
 * 
 * 获取页面显示的用户名
 */
function get_show_name()
{
	$user_name = session('user_name');
	if(session('nick_name'))
		$user_name = session('nick_name');
	else
	{
		// 从db中获取一次用户昵称
		$user_id = get_user_id();
		$user_db = new \Home\Model\UserModel;
		$user = $user_db->get($user_id);
		if(!empty($user))
		{
			if($user['nick_name'])
			{
				$user_name = $user['nick_name'];
				session('nick_name', $user['nick_name']);
			}
		}
	}	
	return $user_name;
}

/**
 * 
 * 获取用户名
 */
function get_user_name()
{
	$user_name = session('user_name');
	return $user_name? $user_name : '';
}

/**
 * 
 * 获取用户昵称
 */
function get_nick_name()
{
	$nick_name = session('nick_name');
	return $nick_name? $nick_name:'';
}

/**
 * 
 * 获取用户id
 */
function get_user_id()
{
	$user_id = session('user_id');
	return $user_id? $user_id : 0;
}

/**
 * 
 * 获取member_id
 */
function get_member_id()
{
	return session('member_id');
}

function get_expert_id()
{
	return session('expert_id');
}

/**
 * 
 * 获取组织id
 */
function get_organize_id()
{
	$organize_id = session('organize_id');
	if(empty($organize_id))
	{
		$member_id = get_member_id();
		$organize = M('Organize')->where("member_id = '$member_id'")->find();
		if(!empty($organize))
		{
			$organize_id = $organize['organize_id'];
			session('organize_id', $organize_id);
		}
	}
	return $organize_id;
}

/**
 * 
 * 获取组织名称
 */
function get_organize_name()
{
	$organize = M('Organize')->find(get_organize_id());
	return $organize['organize_name'];
}

/**
 * 
 * 获取未读消息总数(站内信\站内留言\组织邀请)
 */
function get_sum_count()
{
	return get_msg_count()+get_feedback_count()+get_invite_count();
}

/**
 * 
 * 获取未读消息总数
 */
function get_msg_count()
{
	$msg_db = new \Home\Model\MsgModel;
	return $msg_db->getMsgCount(get_member_id());
}

function get_feedback_count()
{
	$member_id = get_member_id();
	return M('Feedback')->where("member_id = '{$member_id}' and status = '2'")->count('feedback_id');
}

function get_invite_count()
{
	$member_id = get_member_id();
	return M('Organize_invitation')->where("member_id = '{$member_id}' and status='0' ")->count('id');
}

/**
 * 
 * 获取用户头像
 */
function get_member_photo()
{
	$member_db = new \Home\Model\MemberModel;
	$member = $member_db->get(get_member_id());
	return $member['portrait'];
}

/**
 * 
 * 获取组织头像
 */
function get_organize_photo ()
{
	$organize = M('Organize')->find(get_organize_id());
	return $organize['organize_logo'];
}

/**
 * 
 * 获取邮件模板
 * @param $name
 */
function get_email_template($name)
{
	$info = M('Email_template')->where("template_name = '{$name}' and  status = '1'")->find();
	return $info;
}


function get_top5_project()
{
    $project_api  = new \Home\Logic\ProjectLogic();
    $member_id = get_member_id();
    return $project_api->browse(array('member_id' => $member_id), '0,4'); 
}

/**
 * 
 * 解析邮件模板
 * @param $content
 * @param $values
 */
function parseTemplate($content, $values)
{
	is_array($values) && extract($values);
	$content = preg_replace('/\{\{\s*\$([^}]*)\s*\}\}/', '${' . "\${1}" . '}', $content);
	$content = preg_replace('/"/', '\"', $content);
	eval("\$content = \"$content\";");
	return $content;
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @return String
 */
function encode($string = '', $skey = 'sanger_2014') 
{
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value) 
    {
        $key < $strCount && $strArr[$key].=$value;
    }
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @return String
 */
function decode($string = '', $skey = 'sanger_2014') 
{
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value) 
    {
        if ($key <= $strCount && $strArr[$key][1] === $value) 
        {
            $strArr[$key] = $strArr[$key][0];
        }
    }
    return base64_decode(join('', $strArr));
}

/** 
 * 上传图像
 * 
 *@param    string
 *
 * @return   array
 **/
  function upload_img($fieldname,$path=''){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      'img/upload/'.$path.'/'; // 设置附件上传根目录
		// 上传单个文件 
		$info   =   $upload->uploadOne($_FILES[$fieldname]);
		$data['success']=true;
		if(!$info) {// 上传错误提示错误信息
						$data['success']=false;
						$data['msg']=$upload->getError();
		}else{// 上传成功 获取上传文件信息
			$data['url']="/".$upload->rootPath.$info['savepath'].$info['savename'];
			$data['msg']="上传成功";
		}
		return $data;
  }
  
/**
 * 
 * 上传文件
 * @param $fieldname
 * @param $path
 * @param $maxsize
 * @param $exts
 */
function upload_file($fieldname, $path='', $maxsize=5242880,$exts=array('xls','xlsx'), $subName=''){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     $maxsize;// 设置附件上传大小，单位字节(微信图片限制1M
    $upload->exts      =     $exts;// 设置附件上传类型
    $upload->rootPath  = 'file/upload/'.$path; // 设置附件上传根目录
    $upload->subName   = $subName;
    
    // 上传文件
    $info   =   $upload->uploadOne($_FILES[$fieldname]);

    if(!$info) {// 上传错误提示错误信息
        return array(status=>0,msg=>$upload->getError());
    }else{// 上传成功
        return array(status=>1,msg=>'上传成功',filepath=>$upload->rootPath.$info['savename']);
    }
}
  
function randomkeys($length, $num=false)
{
//	$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	
	$pattern = '1234567890ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	$r = 35;
	if($num)
	{
		$pattern = '1234567890';
		$r = 9;
	}
  	for($i=0; $i<$length; $i++)
	{
   		$data .= $pattern{mt_rand(0, $r)};    //生成php随机数
 	}
 	return $data;
}

function email_domain()
{
	return array(
			'gmail.com'			 =>  'http://mail.google.com',
			'163.com'			 =>  'http://mail.163.com',
			'vip.163.com'        =>  'http://vip.163.com',
			'vip.sina.com'       =>  'http://vip.sina.com',
			'sina.com.cn'        =>  'http://mail.sina.com.cn',
			'sina.com'           =>  'http://mail.sina.com.cn',
			'yahoo.com.cn'       =>  'http://mail.cn.yahoo.com',
			'yahoo.cn'           =>  'http://mail.cn.yahoo.com',
			'tom.com'            =>  'http://mail.tom.com',
			'yeah.net'           =>  'http://www.yeah.net',
			'188.com'            =>  'http://www.188.com',
			'139.com'            =>  'http://mail.10086.cn',
			'189.com'            =>  'http://webmail15.189.cn/webmail',
			'wo.com.cn'          =>  'http://mail.wo.com.cn/smsmail',
			'188.com'            =>  'http://www.188.com',
			'21cn.com'           =>  'http://mail.21cn.com',
			'hotmail.com'        =>  'http://www.hotmail.com',
			'sogou.com'          =>  'http://mail.sogou.com',
			'sohu.com'           =>  'http://mail.sohu.com',
			'qq.com'             =>  'http://mail.qq.com',
			'vip.qq.com'         =>  'http://mail.qq.com',
			'foxmail.com'        =>  'http://mail.qq.com',
			'126.com'            =>  'http://mail.126.com',
			'yahoo.com'          =>  'http://mail.yahoo.com',
	);
}


require_once(APP_PATH . '/Common/Common/vendors.php');

