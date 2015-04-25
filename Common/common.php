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
	$mail->FromName='sunxiaojiao';
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
 */
function array_2dTo1d($array_2d){
	if(!isset($array_2d)){
		return false;
	}
	static $arr2; 
    foreach($array_2d as $v){ 
        if(is_array($v)){
        	
            array_2dTo1d($v);
        } 
        else{ 
            $arr2[]=$v; 
        }
    } 
    return $arr2; 
}
?>