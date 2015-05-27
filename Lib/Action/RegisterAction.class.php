<?php
class RegisterAction extends Action{
	private $email;
	private $verify;
	private $passwd;
	private $address;
	private $orgname;

	public function index(){
		if(!session("?reg_email")){
			$this->error('未认证邮箱',U("Register/sendMail"),3);
			return;
		}
		$this->assign("email",session('reg_email'));
		$this->display();
	}
	//发送邮箱界面
	public function sendMail(){
		$this->display('sendmail');
	}
	/**
	 * 注册
	 * 只取passwd 不取repasswd 两次密码验证 在客户端实现
	 * return int 0：注册成功     1：验证码错误 	2：插入数据库失败  3：数据验证失败
	 */
	public function reg(){
		//是否已经验证链接
		if(!session('?reg_email')){
			return ;
		}
		//验证码
		$this->confirmVcode();
		//插入数据库，成功跳转到个人中心
		$reger;
		if($this->isOrg()){
			$reger = D('Orgs');//orgs表
		}else{
			$reger = D('Users');//users表
		}
		//获取数据
		$this->getAll();
		$data['email']  = session('reg_email');
		$data['passwd'] = md5($this->passwd);
		$data['ctime']  = time();
		if($this->orgname != '' && $this->address != ''){
			$data['orgname']     = $this->orgname;
			$data['org_address'] = $this->address;
		}
		//插入数据库
		if($reger->create($data)){
			if($reger->add()){
				$this->ajaxReturn(0,"注册成功",1);
			}else{
				$this->ajaxReturn(2,"注册失败",1);
			}
		}else{
			$this->ajaxReturn(3,$reger->getError()/*.dump($data)*/,1);
		}
	}

	//判断是否是为企业用户注册
	private function isOrg(){
		if($this->isPost()){
			$flag = false;
			if(!isset($_POST['org_address']) || !isset($_POST['org'])){
				unset($_POST['org']);
				unset($_POST['org_address']);
			}else{
				$flag = true;
			}
			return $flag;
		}
	}
	//创建邮箱验证链接
	protected function buildUrl($email) {
//		//验证邮箱是否已经存在
//		$User = M('Users');
//		$where = "email="."'".$email."'";
//		$field = "email";
//		$flag = $User->field($field)->where($where)->find();
//		if($flag){
//			$this->ajaxReturn(2,"邮箱已存在",1);
//			return ;
//		}
//		$Org = M('Orgs');
//		$flag = $Org->field($field)->where($where)->find();
//		if(!$flag){
//			$this->ajaxReturn(2,"邮箱已存在",1);
//			return ;
//		}
		//插入数据库
		$rand = ranVerify(8);
		C('URL_MODEL', 0);
		$url = U("Register/confirm","email=$email&code=$rand",'',false,true);
		$MailReg = M('Mailreg_url');
		$data = array('email'=>$email,'vld_code_value'=>$rand,'ctime'=>time());
		$MailReg->add($data);
		//$this->ajaxReturn($url);
		return $url;
	}
	/**
	 * 发送验证邮件
	 * @param string $to 收信人
	 */
	public function sendEmailHandler(){
		//后台再来一遍验证呀
		if(!preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $this->_post('email'))){
			$this->ajaxReturn(3,"邮箱格式不正确".var_dump($f),1);
			return ;
		}
		$this->email = $this->_post('email');
		//验证邮箱的唯一性
		//$this->confirmUnique($, $field, $value)
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
			$this->ajaxReturn(1,"发送成功",1);
		}else{
			$this->ajaxReturn(0,"发送失败",1);
		}

	}
	//验证邮箱链接
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
			session('reg_email',$email);
			$MailReg = M('Mailreg_url');
			$f = $MailReg->where("email=" . "'$email'")->delete();
			if($f){
				$this->success("邮箱验证成功",U("Register/index"),1);
			}else{
				$this->error('邮箱验证失败',"/",1);
			}
			
		}else{
			$this->error('验证链接错误，请重新验证',"/",3);
			return ;
		}
	}
	private function getAll(){
		if($this->isPost()){
			//合法性检验
			$this->email   = session('email');
			$this->passwd  = $this->_post('passwd');
			$this->address = $this->_post('org_address');
			$this->orgname = $this->_post('org');
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
	protected function confirmUnique($Model,$field,$value) {
		$field = (string)$field;
		$where = "$field=" . $value;
		$f = $Model->where($where)->getField($field);
		if($f === null){
			return true;
		}else{
			return false;
		}
	}
}
?>