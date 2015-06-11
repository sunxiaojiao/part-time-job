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
			if($this->userLogin($phone, $passwd)){
				$this->ajaxReturn(1,'登录成功',0);	
			}else{
				$this->ajaxReturn(2,'用户名或密码错误',0);
			}
		}elseif($f == 'org'){
			if($this->orgLogin($phone, $passwd)){
				$this->ajaxReturn(1,'登录成功',1);	
			}else{
				$this->ajaxReturn(2,'用户名或密码错误',1);
			}
		}
	}
	//求职者登录
	public function userLogin($name,$passwd){
		$User = M('Users');
		$where = "phone='{$name}' AND passwd='" . md5($passwd) . "'";
		$field = 'uid,username,phone';
		$arr1 = $User->field($field)->where($where)->find();
		if($arr1){
			//设置session
			session('oid',null);
			session('orgname',null);
			session('uid',$arr1['uid']);
			session('username',$arr1['username']);
			$this->loginKeeping($arr1['phone'],md5($passwd),'user');
			return true;
		}else{
			return false;
		}
		
	}
	//公司登录
	public function orgLogin($name,$passwd){
		$Org = M('Orgs');
		$where = "login_phone='{$name}' AND passwd='" . md5($passwd) . "'";
		$field = 'oid,orgname,phone';
		$arr1 = $Org->field($field)->where($where)->find();
		if($arr1){
			session('uid',null);
			session('username',null);
			session('oid',$arr1['oid']);
			session('orgname',$arr1['orgname']);
			$this->loginKeeping($arr1['phone'],md5($passwd),'org');
			return true;
		}else{
			return false;
		}
		
	}
	//保持登录
	private function loginKeeping($uname,$passwd,$utype){
			$pwdmem = $this->_post('pwdmem');
			if($pwdmem){
				//设置cookie
				$expire = 3600*24*3;
				$passwd = md5($passwd . 'xiaomifeng');//$passwd为数据库取出的密码，再进行一次加密
				cookie('userphone',$uname,$expire);
				cookie('xmf',$passwd,$expire);
				cookie('utype',$utype,$expire);
			}else{
				cookie('userphone',null);
				cookie('xmf',null);
				cookie('utype',null);
			}
	}

	//设置验证码
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,2,'png',0,32);
	}
}
?>