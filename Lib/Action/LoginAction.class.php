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

	public function index(){
		$this->display();
	}
	/**
	 * 判断登录
	 * 0：登录成功，1：非POST请求，2：密码错误或用户存在，3：邮箱格式不正确
	 */
	public function login(){
		if($flag = $this->getEmail()){
			$this->ajaxReturn($flag);
			return;
		}
			$User = M('Users');
			$this->$passwd = $this->getPasswd();
			if($User->where('email=' . $email . ' AND passwd=' . md5($this->$passwd))->find()){
				//给属性username id 赋值
				$userInfo = $User->where('email=' . $this->$email)->limit(1)->select();
				$this->username = $userInfo['username'];
				if(isset($userInfo['uid'])){
					$this->id = $userInfo['uid'];
				}elseif (isset($userInfo['oid'])){
					$this->id = $userInfo['oid'];
				}
				
				$flag = 0;
			}else{
				$flag = 2;
			}
			$this->ajaxReturn($flag);

	}

	//当得到正确的email时返回0
	private function getEmail(){
		//post得到email
		if($this->isPost()){
			$this->email = $this->_post('email');
		}else{
			return 1;
		}
		//判断是否为邮箱格式，
		$re = "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/";
		if(preg_match($re, $this->email)){
			return 0;
		}else{
			//var_dump($this->email);
			return 3;
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
	//设置验证码
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	//设置session
	private function setSession(){
		session('username',$this->username);
		session('id',$this->id);
	}
	
}
?>