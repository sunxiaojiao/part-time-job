<?php
class JobsModel extends Model{
	//验证
	protected $_validate = array(
		array('title','1,12','标题字数不合要求',0,'length'),//12字以内的标题
		array('style','number','请选择兼职类型'),
		array('leader','require','请输入联系人'),
		array('phone','/^1\d{2}\d{8}$/','请输入联系电话'),
		array('want_peo','number','请输入需要的人数'),
		array('p_s','number','请选择人数类型'),
		array('address','/^\d*\.\d*,\d*\.\d*$/','请选择工作地点'),
		array('money','number','请输入工资范围'),
		array('m_s','number','请选择工资类型'),
		array('begin_time','require','请选择到岗时间'),
		array('wk','number','请选择工作时长'),
		array('expire_time','number','请输入过期时间'),
		array('detail','1,100','兼职细节字数不合要求',0,'length'),//100字以内的兼职细节说明
	);
	//自动完成
	protected  $_auto = array(
	);
	//字段映射
	protected $_map = array(
		'p_s' => 'peo_style',
		'm_s' => 'money_style',
	);
	
}

?>