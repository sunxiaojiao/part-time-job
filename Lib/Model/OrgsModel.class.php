<?php
class OrgsModel extends Model{
	//验证
	protected $_validate = array(
		array('email','','邮箱已占用',0,'unique',2),
		array('email','email','请输入正确的邮箱地址','regex',2),
		array('login_phone','/1[3|5|7|8|][0-9]{9}/','请输入正确的手机号',1,'regex',1),
		array('login_phone','','手机已占用',0,'unique'),
		array('phone','/1[3|5|7|8|][0-9]{9}/','请输入正确的手机号',1,'regex',2),
		array('passwd','require','请输入密码',1,'regex',1),
		array('orgname','require','企业用户须填写企业名称',1,'regex',1),
		array('org_address','require','企业用户须填写企业所在地',1,'regex'),
		array('website','/^http:\/\/+.+$/','请输入正确的网址',1,'regex',2),
		array('intent','isHave','请至少选择一项招聘意向',1,'callback',2),
		//		array('fixed_phone','require','请输入正确的座机号'),
		array('org_intro','1,1000','字数要求在1000字以内',1,'length',2),
	);
	//自动完成
	protected  $_auto = array(
	//array('passwd','md5'),
	);
	protected $_map = array(
		'phone_num' => 'login_phone',
		'address'   => 'org_address',
		'intro'     => 'org_intro',
		'org'       => 'orgname',
	);
	public function isHave() {
		if(is_null($_POST['intent'])){
			return false;
		}else{
			return true;
		}
	}

}

?>