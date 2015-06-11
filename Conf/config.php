<?php
return array(
	//'配置项'=>'配置值'
    
    //数据库配置
    'DB_DSN' => 'mysql://xiaojiaosun:6133698039@localhost:3306/think_job',
    
    'URL_MODEL' => 2,
    'DEFAULT_THEME' => 'bootstrap',
    
    'TMPL_PARSE_STRING'  =>array(
        '__UPLOAD__' => '/Uploads',
        '__GROUP__' => 'Tpl/bootstrap',
    ),
    //过滤和验证
    'VAR_FILTERS'=>'stripslashes,strip_tags',
    'DB_FIELDTYPE_CHECK'=>true,
    //表前缀
    'DB_PREFIX' => 'xm_',
    //session
    'SESSION_AUTO_START' =>true,
    //SMTP
    'MAIL_USERNAME'   =>  '小蜜蜂兼职',
    'MAIL_ADDRESS'    =>  'no-reply@xiaomifengjob.com', // 邮箱地址  
	'MAIL_LOGINNAME'  =>  'no-reply@xiaomifengjob.com', // 邮箱登录帐号
	'MAIL_SMTP'       =>  'smtp.ym.163.com', // 邮箱SMTP服务器
	'MAIL_PASSWORD'   =>  'xmfroot2015', // 邮箱密码
    
    //TRACE
	//'SHOW_PAGE_TRACE' =>  true,
	
	//认证执照和身份证照片上传路径
	'UPLOAD_AUTH_PATH' => '/Uploads/auth', 
);
?>