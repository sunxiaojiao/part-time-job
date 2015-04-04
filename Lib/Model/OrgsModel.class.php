<?php
class OrgsModel extends Model{
	//验证
	protected $_validate = array(
		array('orgname','require','请输入公司机构名字'),
		array('passwd','require','请输入密码'),
	);
	//自动完成
	protected  $_auto = array(
		//array('passwd','md5'),
	);
	
}

?>