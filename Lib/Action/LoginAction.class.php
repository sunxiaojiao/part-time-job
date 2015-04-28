<?php
/**
 * 登录
 *
 */
class LoginAction extends Action{
	private $vcode;
	private $email;
	private $username;
	private $passwd;
	private $id;
	private $pwdmem;
	private $verify;

	public function index(){
		$this->display();
	}
	/**
	 * 判断登录
	 * @return int 0：登录成功 2：密码错误，3：邮箱格式不正确 ，4：验证码错误， 5：用户不存在
	 */
	public function login(){
		//判断验证码
		$this->getVerify();
		if($_SESSION['verify'] != md5($this->verify)){
			$this->ajaxReturn(4,"验证码错误",1);
			return;
		}
		//获取正确的email
		if(!$this->getEmail()){
			$this->ajaxReturn(3,"邮箱格式不正确",1);
			return;
		}
		//获取passwd
		$this->$passwd = $this->getPasswd();
		$User = M('Users');
		$Org = M('Orgs');
		//先判断次email是否为普通求职者
		if($uid = $User->where('email=' . "'" . $this->email . "'")->field('uid')->find()){
			//判断密码
			$userInfo = $User->where("email='{$this->email}' AND passwd='" . md5($this->passwd) . "'")
			->field('uid,username')
			->find();
			if($userInfo){
				$flag  = 0;
				$isorg = 0;
			}else{
				$this->ajaxReturn(2,"密码不正确",1);
				return;
			}
			//设置session
			session('oid',null);
			session('orgname',null);
			session('uid',$userInfo['uid']);
			session('username',$userInfo['username']);
		//判断此email是否为公司机构
		}elseif($oid = $Org->where("email='{$this->email}'")->field('oid')->find()){ //当email不在Users表中，查询Orgs表
			$Org = M('Orgs');
			//判断密码
			$orgInfo = $Org->where('email=' . "'{$this->email}'" . 'AND passwd=' . "'" . md5($this->passwd) . "'")
			->field('orgname')
			->find();
			if($orgInfo){
				$flag  = 0;
				$isorg = 1;
			}else{
				$this->ajaxReturn(2,"密码不正确",1);
				return;
			}
			session('uid',null);
			session('username',null);
			session('oid',$oid['oid']);
			session('orgname',$orgInfo['orgname']);
		}else{
			$flag = 5;
		}
		if($flag ==0 ){
			$this->ajaxReturn(0,"登录成功，正在跳转...",$isorg);
		}else if($flag ==5){
			$this->ajaxReturn(5,"用户不存在",1);
		}

	}

	//当得到正确的email时返回	
	private function getEmail(){
		//post得到email
		if($this->isPost()){
			//判断是否为邮箱格式，
			$re = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
			$email = $this->_post('email');
			if($f = preg_match($re,$email)){
				$this->email = $email;
				return $this->email;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
		
	}

	private function getPasswd(){
		//post得到passwd
		if($this->isPost()){
			$this->passwd = $this->_post('passwd');
			return $this->passwd;
		}else{
			return 1;
		}
	}
	//获取用户输入的验证码
	private function getVerify(){
		if($this->isPost()){
			$this->verify = strtoupper($this->_post('verify'));
			return $this->verify;
		}else{
			return 1;
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