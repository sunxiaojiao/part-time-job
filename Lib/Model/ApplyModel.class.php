<?php
class ApplyModel extends Model{
	//验证
	protected $_validate = array(
		array('app_jid'),
		array('app_uid'),
	);
	//自动完成
	protected  $_auto = array(
		array('app_jid'),//根据当前工作，自动添加工作id
		array('app_uid'),//根据当前用户，自动添加申请人
	);
	
}

?>