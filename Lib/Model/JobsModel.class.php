<?php
class JobsModel extends Model{
	//验证
	protected $_validate = array(
		array('title','1,12','标题字数不合要求',0,'length'),//12字以内的标题
		array('detail','1,100','兼职细节字数不合要求',0,'length'),//100字以内的兼职细节说明
		array('money','require','请输入工资范围'),
		array('want_peo','require','请输入需要的人数',0,''),
		array('address','require','请输入工作地点'),
		array('leader','require','请输入负责人'),
		array('expire_time','require','请输入过期时间'),
	);
	//自动完成
	protected  $_auto = array(
		array('ctime','time',1,'function'),		
	);
	
}

?>