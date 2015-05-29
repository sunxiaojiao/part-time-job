<?php
class AttachEmailAction extends Action{
	public function index() {
		$this->display();
	}
	//创建邮箱验证链接
	protected function buildUrl($email) {
		//插入数据库
		$rand = ranVerify(8);
		if(session('?uid')){
			$type = 'uid';
		}elseif(session('?oid')){
			$type = 'oid';
		}
		C('URL_MODEL', 0);
		$url = U("AttachEmail/confirm","email=$email&type={$type}&code=$rand",'',false,true);
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
			$this->ajaxReturn(3,"邮箱格式不正确",1);
			return ;
		}
		$email = $this->_post('email');
		//验证邮箱唯一性
		$f = $this->checkEmailUnique();
		if(!$f){
			return ;
		}
		$vld_url = $this->buildUrl($email);
		$title = "小蜜蜂兼职";
		$message = <<<EOT
		您的邮箱为：{$email},\n
		您的验证码为：{$vld_url}
EOT;
		if(SendMail($email, $title, $message)){
			//设置session
			session('email_ver',$verify);
			session('email',$email);
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
			//删除邮箱验证表中的记录
			$MailReg = M('Mailreg_url');
			$f = $MailReg->where("email=" . "'$email'")->delete();
			if($f){
				//用户添加email信息
				$flag = $this->attach($email);
				if($flag){
					$this->success("邮箱绑定成功",U("/"),1);
				}else{
					$this->error('邮箱绑定失败',"/",1);
				}
			}else{
				$this->error('邮箱绑定失败',"/",1);
			}
		}else{
			$this->error('验证链接错误，请重新验证',"/",3);
			return ;
		}
	}
	//将邮箱插入数据表
	protected function attach($email) {
		$Model;
		$where = "";
		$type  =$this->_get('type');
		if($type == 'uid'){
			$Model = M('Users');
			$where = "uid=" . session('uid');
		}elseif($type == 'oid'){
			$Model = M('Orgs');
			$where = "oid=" . session('oid');
		}else{
			//未登录
			$this->error('未登录',U("Login/index"),1);
		}
		$f = $Model->where($where)->setField('email',$email);
		if($f || $f === 0){
			return true;
		}else{
			return false;
		}
	}
	protected function checkEmailUnique(){
		$M;
		$type = $this->_get('type');
		if(session('?uid')){
			$M = M('Users');	
		}elseif(session('?oid')){
			$M = M('Orgs');
		}
		$validate = array(
			array('email','','邮箱已占用',0,'unique'),
		);
		$f = $M->setProperty('_validate', $validate);
		if($M->create()){
			return true;
		}else{
			$this->ajaxReturn(0,$M->getError(),1);
			return false; 
		}
	}
}
?>