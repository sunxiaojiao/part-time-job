<?php
class JobsModel extends Model{
	//验证
	protected $_validate = array(
		array('title','require','请输入标题'),
		array('detail','require','请输入兼职细节'),
		array('apply'),
		array('org'),
		array('money','require','请输入工资范围'),
		array('want_peo','require','请输入需要的人数'),
		array('address','require','请输入工作地点'),
		array('lead','require','请输入负责人'),
	);
	//自动完成
	protected  $_auto = array(
		array('org'),//根据当前用户，自动添加公司
		array('ctime'),
		
	);
	
}

?>