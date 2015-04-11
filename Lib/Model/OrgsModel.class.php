<?php
class OrgsModel extends Model{
	//验证
	protected $_validate = array(
		array('orgname','require','请输入公司机构名字'),
		array('passwd','require','请输入密码'),
		array('license_num','require','请填写编号'),
		array('license_num','/\d{15}/','请填写正确的编号',2),
		array('industry','require','请选择公司行业'),
		array('nature','require','请选择公司性质'),
		array('size','require','请选择公司规模'),
		array('address','require','请填写公司地址'),
		array('contact','require','请填写联系人'),
		array('phone','/1[3|5|7|8|][0-9]{9}/','请输入正确的手机号'),
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