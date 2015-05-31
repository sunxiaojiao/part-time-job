<?php
/**
 * 登录
 *
 */
class LoginAction extends Action{
	public function index(){
		$this->display();
	}
	
	// 判断登录 
	public function login(){
		//判断验证码
		$verify = strtoupper($this->_post('verify'));
		if(session('verify') != md5($verify)){
			$this->ajaxReturn(3,"验证码错误",1);
			return;
		}
		//验证电话号
		if(!M()->check($this->_post('phone'),'/1[3|5|7|8|][0-9]{9}/')){
			$this->ajaxReturn(3,'请输入正确的手机号',1);
			return ;
		}
		$phone = $this->_post('phone');
		//获取passwd
		$passwd = $this->_post('passwd');
		//与数据库比对
		$f = $this->_post('login_type');
		if($f == 'user'){
			$this->userLogin($phone, $passwd);
		}elseif($f == 'org'){
			$this->orgLogin($phone, $passwd);
		}
	}
	//求职者登录
	protected function userLogin($name,$passwd){
		$User = M('Users');
		$where = "phone='{$name}' AND passwd='" . md5($passwd) . "'";
		$field = 'uid,username';
		$arr1 = $User->field($field)->where($where)->find();
		if($arr1){
			//设置session
			session('oid',null);
			session('orgname',null);
			session('uid',$arr1['uid']);
			session('username',$arr1['username']);
			$this->ajaxReturn(1,'登录成功',0);
		}else{
			$this->ajaxReturn(2,'用户名或密码错误',0);
		}
		
	}
	//公司登录
	protected function orgLogin($name,$passwd){
		$Org = M('Orgs');
		$where = "phone='{$name}' AND passwd='" . md5($passwd) . "'";
		$field = 'oid,orgname';
		$arr1 = $Org->field($field)->where($where)->find();
		if($arr1){
			session('uid',null);
			session('username',null);
			session('oid',$arr1['oid']);
			session('orgname',$arr1['orgname']);
			$this->ajaxReturn(1,'登录成功',1);
		}else{
			$this->ajaxReturn(2,'用户名或密码错误'.$Org->getLastSql(),1);
		}
		
	}
	//保持登录
	private function getPwdmem(){
		if($this->isPost()){
			$this->pwdmem = $this->_post('pwdmem');
			if($this->pwdmem){
				$this->pwdmem = true;
			}else{
				$this->pwdmem = false;
			}
		}else{
			return 1;
		}
	}

	//设置验证码
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,2,'png',0,32);
	}
}
?>