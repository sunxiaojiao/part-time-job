<?php
class UsersModel extends Model{
	//验证
	protected $_validate=array(
		array('username','require','请输入用户名',1),
		array('username','1,20','用户名最长为20个字符',1,'length'),
		
		array('phone','','手机号已被占用',1,'unique',1),
		array('phone','/1[3|5|7|8|][0-9]{9}/','请输入正确的手机号',0,'regex',1),
		
		array('passwd','require','请输入密码',0,'regex'),
		
		array('email','email','邮箱已占用',1,'unique',2),
		array('email','email','请输入正确的邮箱地址',0,'regex',2),
		array('school','require','请输入学校',1,'regex',3),
		//非必需字段
		array('qq','/^[1-9]\d{4,9}$/','请输入正确的qq号',0,'regex',2),
		array('sex','1,3','请选择性别',1,'between','regex',2),
		array('age','1,150','请输入正确的年龄',1,'between',2),
		array('area','require','请选择居住地',1,'regex',2),
		array('exp','1,100','介绍字数在100字以内',1,'length',2),
		array('intent','isHave','请至少选择一项求职意向',1,'callback',2),
		
		//array('ctime'),
	);
	public function isHave() {
		if(is_null($_POST['intent'])){
			return false;
		}else{
			return true;
		}
	}
//	public function checkEmialUnique(){
//		$this->validate()
//	}
//	protected function phoneUpdateValidate(){
//		$User = M('Users');
//		$User->where($where)->find();
//	}
	//自动完成
	protected $_auto = array(
	);

	protected $_map = array(
		'phone_num' => 'phone',
	); 
}
?>