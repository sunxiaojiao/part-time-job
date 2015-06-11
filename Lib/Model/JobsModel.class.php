<?php
class JobsModel extends Model{
	//验证
	protected $_validate = array(
		array('title','1,12','标题字数在12字以内',1,'length',1),//12字以内的标题
		array('mold_id','number','请选择工作类型',1,'regex',1),
		array('leader','require','请输入联系人',1,'regex',1),
		array('leader_phone','/^1\d{2}\d{8}$/','请输入正确的联系电话',1,'regex',1),
		array('want_peo','number','请输入需要的人数',1,'regex',1),
		array('peo_style','1,2','请选择人数类型',1,'in',1),
		array('address','/^\d*\.\d*,\d*\.\d*$/','请选择工作地点',1,'regex',1),
		array('addressname','require','请选择工作地点',1,'regex',1),
		array('city','require','请选择工作地点',1,'regex',1),
		array('money','number','请输入工资范围',1,'regex',1),
		array('money_style','1,2,3','请选择按什么周期支付工资',1,'in',1),
		array('pay_way','1,2,3','请选择付款方式',1,'in',1),
		array('begin_time','require','请选择到岗时间',1,'regex',1),
		array('work_time','number','请选择工作时长',1,'regex',1),
		array('expire_time','number','请输入过期时间',1,'regex',1),
		array('detail','1,100','兼职细节字数在100字以内',1,'length',1),//100字以内的兼职细节说明
	);
	//自动完成
	protected  $_auto = array(
	);
	//字段映射
	protected $_map = array(
		'p_s'         => 'peo_style',
		'm_s'         => 'money_style',
		'py'          => 'pay_way',
		'style'       => 'mold_id',
		'phone'       => 'leader_phone',
		'addresscity' => 'city',
		'wt'          => 'work_time',
	);
	
}

?>