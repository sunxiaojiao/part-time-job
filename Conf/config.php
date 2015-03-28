<?php
return array(
	//'配置项'=>'配置值'
    
    //数据库配置
    'DB_DSN' => 'mysql://root@localhost:3306/think_job',
    
    'URL_MODEL' => 0,
    'DEFAULT_THEME' => 'bootstrap',
    
    'TMPL_PARSE_STRING'  =>array(
        
        '__UPLOAD__' => '/Uploads',
        '__GROUP__' => 'Tpl/bootstrap',
    ),
    //表前缀
    'DB_PREFIX' => 'xm_',
    //session
    'SESSION_AUTO_START' =>true,
    //SMTP
    'MAIL_ADDRESS'=>'admin@xiaojiaosun.com', // 邮箱地址  
	'MAIL_LOGINNAME'=>'admin@xiaojiaosun.com', // 邮箱登录帐号
	'MAIL_SMTP'=>'smtp.ym.163.com', // 邮箱SMTP服务器
	'MAIL_PASSWORD'=>'6133698039', // 邮箱密码
	'SHOW_PAGE_TRACE'=>true,

);
?>