<?php
class UsersModel extends Model{
	//验证
	protected $_validate=array(
		array('username','require','用户名已存在',0,'unique'),
		array('passwd','requre','请输入密码'),
		array('email','email','请输入正确的邮箱地址',0,'unique'),
		array('phone','1[3|5|7|8|][0-9]{9}','请输入正确的手机号',0,'unique'),
		array('qq','','请输入正确的qq号'),
		array('school','','请输入学校'),
		array('sex'),
		array('age'),
		array('address'),
		array('exp'),
		array('intent'),
		array('ctime'),
	);
	//自动完成
	protected $_auto=array(
		array('citme','now'),
		array('passwd','md5'),
	);
}
?>