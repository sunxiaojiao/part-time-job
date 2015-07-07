<?php
class RegisterAction extends Action{
	private $email;
	private $verify;
	private $passwd;
	private $address;
	private $orgname;

	public function index(){
		$this->display();
	}
	/**
	 * 注册
	 * 只取passwd 不取repasswd 两次密码验证 在客户端实现
	 * return int 0：注册成功     1：验证码错误 	2：插入数据库失败  3：数据验证失败
	 */
	public function reg(){
		//验证码
		$this->confirmVcode();

		$Reger;
		if($this->isOrg()){
			$Reger = D('Orgs');//orgs表
		}else{
			$Reger = D('Users');//users表
		}
		//获取数据
		$data['phone_num']  = $this->_post('phone_num');
		$data['passwd'] = md5($this->_post('passwd'));
		$data['ctime']  = time();
		
		if($this->isOrg()){
			$data['orgname']     = $this->_post('org');
			$data['address']     = $this->_post('address');
		}else{
			$data['username']    = $this->_post('username');
			$data['school']      = $this->_post('school');
		}
		//验证，插入数据库
		if($Reger->create($data,1)){
			if($primary_id = $Reger->add()){
				$f;
				//设置session
				if($this->isOrg()){
					session('oid',$primary_id);
					session('orgname',$data['orgname']);
					$f = 2;
				}else{
					session('uid',$primary_id);
					session('username',$data['username']);
					$f = 1;
				}
				$this->ajaxReturn(0,"注册成功，等待跳转",$f);
			}else{
				//echo $Reger->getLastSql();
				$this->ajaxReturn(2,"注册失败，请重试",1);
			}
		}else{
			$this->ajaxReturn(3,$Reger->getError(),1);
		}
	}

	//判断是否是为企业用户注册
	private function isOrg(){
		if($this->isPost()){
			if($this->_post('reg_type') === 'org'){
				return true;
			}else{
				return false;
			}
		}
	}
	//设置验证码
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,2,'png',0,32);
	}
	//验证验证码
	protected function confirmVcode() {
		$vcode = $this->_post('vcode');
		if(session('verify') != md5(strtoupper($vcode))) {
			$this->ajaxReturn(1,"验证码错误",1);
			return;
		}
	}
	//显示条款
	public function ourArticle() {
		$this->display();
	}
}
?>