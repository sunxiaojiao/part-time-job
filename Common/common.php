<?php
/**
 * 自定义函数库
 */

/**
*PHPMailer
*@param string $address
*@param string $title
*@param string $message
*@return bo0lean
*/
function SendMail($address,$title,$message){
	import('ORG.Net.PHPMailer');
	$mail=new PHPMailer();
	// 设置PHPMailer使用SMTP服务器发送Email
	$mail->IsSMTP();
	// 设置邮件的字符编码，若不指定，则为'UTF-8'
	$mail->CharSet='UTF-8';
	// 添加收件人地址，可以多次使用来添加多个收件人
	$mail->AddAddress($address);
	// 设置邮件正文
	$mail->Body=$message;
	// 设置邮件头的From字段。
	$mail->From=C('MAIL_ADDRESS');
	// 设置发件人名字
	$mail->FromName=C('MAIL_USERNAME');
	// 设置邮件标题
	$mail->Subject=$title;
	// 设置SMTP服务器。
	$mail->Host=C('MAIL_SMTP');
	// 设置为“需要验证”
	$mail->SMTPAuth=true;
	// 设置用户名和密码。
	$mail->Username=C('MAIL_LOGINNAME');
	$mail->Password=C('MAIL_PASSWORD');
	// 发送邮件。
	return($mail->Send());
	}
/**
 *生成随机验证吗 
 */
function ranVerify($length = 4){
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$verify = '';
	if($length > strlen($chars)){
		$length = strlen($chars);
	}
	for($i=0;$i<$length;$i++){
		$verify .= substr($chars, rand(0, strlen($chars)-1),1);
	}
	return $verify;
	
}
/**
 * 
 * 数组二维转一维
 * 指定键值做新数组的键
 */
function array_2dTo1d($array_2d,$key){
	$arr1 = array();
	foreach($array_2d as $k=> $value){
		$arr_key = array_keys($value);
		if($arr_key[0] == $key){
			$arr1[] = $value[$arr_key[1]];
		}else{
			$arr1[] = $value[$arr_key[0]];
		}
	}
	return $arr1;
}
/**
 * 
 * 格式化时间戳，若范围包含在今天，则返回”今天“。否则，返回date后的时间
 * @param int $timestamp
 * @param string $fomate
 */
function ftime($timestamp,$fomate = 'm/d h:i'){
	//$timestamp = trim($timestamp);
	$diff = time() - $timestamp;
	if($diff < 3600*0.5 ){
		return '半小时内';
	}elseif($diff < 3600*1){
		return '一小时内';
	}elseif($diff < 3600*2){
		return '2小时内';
	}elseif($diff < 3600*3){
		return '3小时内';
	}elseif($diff < 3600*4){
		return '4小时内';
	}elseif($diff < 3600*5){
		return '5小时内';
	}elseif($diff < 3600*6){
		return '6小时内';
	}elseif($diff < 3600*12){
		return '12小时内';
	}elseif($diff < 3600*24){
		return '今天';
	}elseif($diff <3600*48){
		return '24小时之前';
	}else{
		return date($fomate,$timestamp);
	}
}

function check_sql_inject($value){
    //非法字符正则
    $notall='/select|insert|update|delete|and|or|\'|\/\*|\*|\.\.\/|\.\/|;|union|into|load_file|outfile/';
	$str = '';
    if(preg_match_all($notall,$value,$matches)){
    	//构造正则
    	$matches = $matches[0];
    	if(count($matches)){
    		$str = $matches[0];
    	}else{
    		foreach($matches as $v){
    			$str = '|' . $v;
    		}
    		$str = substr($str, 1);
    	}
    	return preg_replace("/{$str}/", '' , $value);
    }else{
    	return $value;
    }
}
?>