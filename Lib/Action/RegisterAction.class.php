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
 * return int 0：注册成功	1：非POST请求	 2：邮箱验证码错误 	3:邮箱验证通过	4：插入数据库失败
 */
	public function reg(){
		//判断邮箱验证码
		if(!$this->confirm()){
			$this->ajaxReturn(2);
			return;
		}else{
			//$this->ajaxReturn(3);	
		}
		//插入数据库，成功跳转到个人中心
		$reger;
		if($this->isOrg()){
			$reger = D('Orgs');//orgs表 
		}else{
			$reger = D('Users');//users表
		}
		//获取数据
		$this->getAll();
		$data['email']  = $this->email;
		$data['passwd'] = md5($this->passwd);
		if($this->orgname != '' && $this->address != ''){
			$data['orgname'] = $this->orgname;
			$data['org_address'] = $this->address;
		}
		//插入数据库
		if($flag = $reger->data($data)->add()){
			$this->ajaxReturn(0);
		}else{
			$this->ajaxReturn(4);
		}
	}
	
	//判断是否是为企业用户注册
	private function isOrg(){
		if($this->isPost()){
			$flag = false;
			if($_POST['org_address'] == '' || $_POST['org'] == ''){
				unset($_POST['org']);
				unset($_POST['org_address']);
			}else{
				$flag = true;
			}
			return $flag;
		}
	}
	protected function buildUrl($email) {
		$rand = ranVerify(8);
		C('URL_MODEL', 0);
		$url = U("Register/confirm","email=$email&code=$rand",'',false,true);
		$MailReg = M('Mailreg_url');
		$data = array('email'=>$email,'vld_code_value'=>$rand);
		$MailReg->add($data);
		return $url;
	}
	/**
	 * 发送验证邮件
	 * @param string $to 收信人
	 * 0:邮件发送失败 1:邮件发送成功
	 */
	public function sendEmail(){
		$this->email = $this->_post('email');
		$vld_url = $this->buildUrl($this->email);
		$title = "小蜜蜂兼职";
		$message = <<<EOT
		您的邮箱为：{$this->email},\n
		您的验证码为：{$vld_url}
EOT;
		if(SendMail($this->email, $title, $message)){
			//设置session
			session('email_ver',$verify);
			session('email',$this->email);
			echo 1;
		}else{
			echo 0;
		}

	}
	//判断邮箱验证码
//	public function confirm(){
//		if(session('email_ver') == $this->_post('yzm')){
//			echo 1;
//			return true;
//		}else{
//			echo 0;
//			return false;
//		}
//	}
	public function confirm(){
		$email    = $this->_get('email');
		$vld_code = $this->_get('code');
		if(empty($email) || empty($vld_code)){
			$this->ajaxReturn(0,"验证失败",0);
			return;
		}
		$reg = M('Mailreg_url');
		$reg_id = $reg->field("reg_id")
				   	  ->where("email=" . "'" . $email . "'" . " AND " . "vld_code_value=" . "'" . "$vld_code" . "'")
				   	  ->find();
		if($reg_id){
			session('reg_vld',1);
			$MailReg = M('Mailreg_url');
			$MailReg->where("email=".$email)->setField("ispass",1);
			$this->success("邮箱验证成功","/",3);
		}else{
			dump($reg->getLastSql());
			$this->error('验证链接错误',"http://www.xiaomifengjob.com",3);
			return ;
		}
	}
	private function getAll(){
		if($this->isPost()){
			//合法性检验
//			/if(){}
			//$this->email  = $this->_post('email');
			$this->email = session('email');
			$this->passwd = $this->_post('passwd');
			$this->address = $this->_post('org_address');
			$this->orgname = $this->_post('org');
		}
	}

}
?>