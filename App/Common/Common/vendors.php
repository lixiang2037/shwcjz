<?php
/**
 * 系统公共库文件扩展
 * 主要定义系统公共函数库扩展
 */

/**
 * 获取 IP  地理位置
 * 淘宝IP接口
 * @Return: array
 */
function get_city_by_ip($ip)
{
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
    $ipinfo = json_decode(file_get_contents($url));
    if ($ipinfo->code == '1') {
        return false;
    }
    $city = $ipinfo->data->region . $ipinfo->data->city; //省市县
    $ip = $ipinfo->data->ip; //IP地址
    $ips = $ipinfo->data->isp; //运营商
    $guo = $ipinfo->data->country; //国家
    if ($guo == '中国') {
        $guo = '';
    }
    return $guo . $city . $ips . '[' . $ip . ']';
}
/**
 * 用常规方式发送邮件。
 */
function send_mail($to = '', $subject = '', $body = '', $name = '', $attachment = null)
{
    $from_email = C('EMAIL_SMTP_USERNAME');
    $from_name = C('PAGE_TITLE');
    $reply_email = C('EMAIL_POP_USERNAME');
    $reply_name = 'i-sanger服务中心';
    require_once('../ThinkPHP/Library/Vendor/PHPMailer/phpmailer.class.php');
    $mail = new PHPMailer; //实例化PHPMailer
    $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug = 0; // 关闭SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true; // 启用 SMTP 验证功能
    $mail->SMTPSecure = ''; // 使用安全协议
    $mail->Host = C('EMAIL_SMTP_ADDRESS'); // SMTP 服务器
    $mail->Port = C('EMAIL_SMTP_PORT'); // SMTP服务器的端口号
    $mail->Username = C('EMAIL_SMTP_USERNAME'); // SMTP服务器用户名
    $mail->Password = C('EMAIL_SMTP_PASSWORD'); // SMTP服务器密码
    $mail->SetFrom($from_email, $from_name);
    $replyEmail = $reply_email ? $reply_email : $from_email;
    $replyName = $reply_name ? $reply_name : $from_name;
    if ($to == '') {
        $to = C('EMAIL_SMTP_USERNAME'); //邮件地址为空时，默认使用后台默认邮件测试地址
    }
    if ($name == '') {
        $name = C('PAGE_TITLE'); //发送者名称为空时，默认使用网站名称
    }
    if ($subject == '') {
        $subject = C('PAGE_TITLE'); //邮件主题为空时，默认使用网站标题
    }
    if ($body == '') {
        $body = C('PAGE_TITLE'); //邮件内容为空时，默认使用网站描述
    }
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body); //解析
    $mail->AddAddress($to, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo; //返回错误信息
}

/**
 * 发送手机短信
 */
 
function send_sms($mobile = '',$content = '')
{
    $url = "http://sms.106jiekou.com/utf8/sms.aspx";
    $post_data = "account=lei.zhang&password=sg_sms_201414&mobile=".$mobile."&content=".rawurlencode($content);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    $return_str = curl_exec($curl);
    curl_close($curl);
    //短信返回结果信息
	$status=array(
		'100'	=>	'发送成功',
		'101'	=>	'验证失败',
		'102'	=>	'手机号码格式不正确',
		'103'	=>	'会员级别不够',
		'104'	=>	'内容未审核',
		'105'	=>	'内容过多',
		'106'	=>	'账户余额不足',
		'107'	=>	'Ip受限',
		'108'	=>	'手机号码发送太频繁，请换号或隔天再发',
		'109'	=>	'帐号被锁定',
		'110'	=>	'手机号发送频率持续过高，黑名单屏蔽数日',
		'120'	=>	'系统升级',
	);
	if($return_str =='100'){
		return array('code'=>'ok','msg' => $status[$return_str]);
	}else{
		return array('code'=>'err','msg' =>$status[$return_str]);
	}
}

/**
 * 获取用户浏览器型号
 */
function getBrowser(){
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Maxthon')) {
		$browser = 'Maxthon';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 12.0')) {
		$browser = 'IE12.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 11.0')) {
		$browser = 'IE11.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')) {
		$browser = 'IE10.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')) {
		$browser = 'IE9.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) {
		$browser = 'IE8.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {
		$browser = 'IE7.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$browser = 'IE6.0';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'NetCaptor')) {
		$browser = 'NetCaptor';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {
		$browser = 'Netscape';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx')) {
		$browser = 'Lynx';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
		$browser = 'Opera';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
		$browser = 'Google';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
		$browser = 'Firefox';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
		$browser = 'Safari';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'iphone') || strpos($_SERVER['HTTP_USER_AGENT'], 'ipod')) {
		$browser = 'iphone';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'ipad')) {
		$browser = 'iphone';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'android')) {
		$browser = 'android';
	} else {
		$browser = 'other';
	}
	return $browser;
}
