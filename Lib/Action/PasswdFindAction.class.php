<?php
class PasswdFindAction extends Action{
	//
	public function index(){
		$this->display();
	}
	//通过邮箱找回密码
	public function byEmail(){
		
	}
	//生成Url，和数据库记录
	protected function buildUrl($email,$type) {
		$rand = ranVerify(8);
		C('URL_MODEL', 0);
		$url = U("PasswdFind/confirm","email=$email&code=$rand",'',false,true);
		$PasswdF = M('PasswdFind');
		//插入数据库
		$data = array('pfind_email'=>$email,'pfind_code'=>$rand,'ctime'=>time());
		if($type == 'user'){
			$data['pfind_utype'] = 1;
		}elseif($type == 'org'){
			$data['pfind_utype'] = 2;
		}else{
			exit();
		}
		$PasswdF->add($data);
		return $url;
	}
	
	/**
	 * Main
	 * 
	 * 发送邮件
	 */
	public function sendEmailHandler(){
		//判断验证码
		$verify = strtoupper($this->_post('verify'));
		if(session('verify') != md5($verify)){
			$this->ajaxReturn(2,"验证码错误",1);
			return;
		}
		//后台再来一遍验证呀
		if(!preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $this->_post('email'))){
			$this->ajaxReturn(3,"邮箱格式不正确",1);
			return ;
		}
		$email = $this->_post('email');
		$type  = $this->_post('u_type');
		//验证邮箱是否存在
		if(!$this->checkEmail($email,$type)){
			$this->ajaxReturn(4,'邮箱不存在',1);
			return;
		}
		$vld_url = $this->buildUrl($email,$type);
		$title = "小蜜蜂兼职";
		$message = <<<EOT
		点击此链接，填写新密码\n
		{$vld_url}
		by小蜜蜂兼职
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

	//验证链接，并跳转到重置密码页面
	public function confirm(){
		$email    = $this->_get('email');
		$vld_code = $this->_get('code');
		if(empty($email) || empty($vld_code)){
			$this->ajaxReturn(0,"验证失败",0);
			return;
		}
		//验证链接
		$PasswdF  = M('PasswdFind');
		$pfind    = $PasswdF->field("pfind_id,pfind_utype")
							->where("pfind_email=" . "'" . $email . "'" . " AND " . "pfind_code=" . "'" . "$vld_code" . "'")
							->find();
		if($pfind){
			//删除验证表中的记录
			$f = $PasswdF->where("pfind_email=" . "'$email'" . ' AND ' . "pfind_code='{$vld_code}'")->delete();
			if($f){
				//成功，并跳转到修改密码的页面
				if($pfind['pfind_utype'] == 1){
					session('user_email',$email);
				}elseif($pfindp['pfind_utype'] == 2){
					session('org_email',$email);
				}
				$this->success("验证成功，正在跳转",U("PasswdFind/showReset"),1);
			}else{
				$this->error('链接验证失败，请重新验证',"/",1);
				//echo $PasswdF->getLastSql();
			}
		}else{
			$this->error('验证链接错误，请重新验证',"/",3);
			return ;
		}
	}
	public function showReset() {
		if(!session('user_email') && !session('org_email')){
			$this->error('跳转中...','/',1);
			return ;
		}
		$this->display();
	}
	//重置Handler
	public function resetHandler() {
		//检验登录
		if(!session('user_email') && !session('org_email')){
			echo 'error';
			return ;
		}
		//验证码
		$verify = strtoupper($this->_post('verify_r'));
		if(md5($verify) !== session('verify_r')){
			$this->ajaxReturn(0,'验证码错误',1);
			return ;
		}
		$passwd = md5($this->_post('passwd'));
		$M;
		$email = '';
		if(session('?user_email')){
			$M = M('Users');
			$email = session('user_email');
		}elseif(session('?org_email')){
			$M = M('Orgs');
			$email = session('org_email');
		}
		$data = array('passwd'=>$passwd);
		$where = "email=" . "'" . $email . "'";
		$f = $M->where($where)->save($data);
		if($f || $f === 0){
			session('user_email',null);
			session('org_email',null);
			$this->ajaxReturn(1,'修改密码成功',1);
		}else{
			$this->ajaxReturn(2,'修改密码失败',1);
		}
	}
	//验证邮箱是否存在
	protected function checkEmail($email='',$type){
		if($email == ''){
			return false;
		}
		$M;
		if($type == 'user'){
			$M = M('Users');	
		}elseif($type == 'org'){
			$M = M('Orgs');
		}
		$data = array('email'=>$email);
		$where = "email=" . "'" . $email ."'";
		$f = $M->field('email')->where($where)->find();
		//$this->ajaxReturn(1,$M->getLastSql(),1);
		if($f){
			return true;
		}else{
			return false;
		}
	}
	//设置验证码
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,2,'png',0,32);
	}
	//设置重置页验证码
	public function vCode_r() {
		import('ORG.Util.Image');
		Image::buildImageVerify(4,2,'png',0,32,'verify_r');
	}




	//通过手机号找回密码
	public function byPhone(){
		echo 'null';
	}
}
?>