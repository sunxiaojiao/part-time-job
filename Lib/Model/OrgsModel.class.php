<?php
class OrgsModel extends Model{
	//验证
	protected $_validate = array(
		array('orgname','require','请输入公司机构名字'),
		array('passwd','require','请输入密码'),
		array('address','require','请填写公司地址'),
		array('fixed_phone','require','请输入正确的座机号'),
		array('intro','1,1000','字数要求在1000字以内',0,'length'),
	);
	//自动完成
	protected  $_auto = array(
		//array('passwd','md5'),
	);
	protected $_map = array(
		'address' => 'org_address',
		'intro'   => 'org_intro', 
	);
	
}

?>