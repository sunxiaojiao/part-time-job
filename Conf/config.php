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

);
?>