<?php
class ChangePasswdAction extends Action {
	public function index() {
		$this->display();
	}
	//设置验证码
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,2,'png',0,32);
	}
	public function change(){
		//判断验证码
		if(session('verify') != md5(strtoupper($this->_post('vcode')))){
			$this->ajaxReturn(0,"验证码错误",0);
			return;
		}
		$flag = 0;
		if(session('?oid')){
			$flag = "oid";
		}elseif(session('?uid')){
			$flag = "uid";
		}else{
			$this->error("未登录！",U("Login/index"),3);
			return;
		}
		//获取表单数据，并判断是否为空，两次密码是否相同
		$old_passwd = $this->_post('old_passwd');
		$new_passwd = $this->_post('new_passwd');
		$re_passwd  = $this->_post('re_passwd');
		if(!$old_passwd || !$new_passwd || !$re_passwd){
			$this->ajaxReturn(0,"请填写完整的信息",0);
			return ;
		}elseif($re_passwd != $new_passwd){
			$this->ajaxReturn(0,"两次密码输入不相同",0);
			return ;
		}
		//md5
		$old_passwd = md5($old_passwd);
		$new_passwd = md5($new_passwd);
		//判断旧密码，更改新密码
		if($flag == "oid"){
			$Org = M('orgs');
			$arr_oid = $Org->field("oid")
					   ->where("oid=".session('oid') . " AND " . "passwd=" . "'$old_passwd'")
					   ->find();
			if($arr_oid['oid']){
				//更改密码
				$flag = $Org->where("oid=".$arr_oid['oid'])->setField("passwd", $new_passwd);
				if($flag || $flag == 0){
					$this->ajaxReturn(1,"修改成功",1);
				}else{
					$this->ajaxReturn(0,"修改失败",0);
				}
			}else{
				$this->ajaxReturn(0,"旧密码错误",1);
			}
		}elseif($flag == "uid"){
			$User = M('users');
			$arr_uid = $User->field("uid")
						->where("uid=".session('uid') . " AND " . "passwd=" . "'$old_passwd'")
						->find();
			if($arr_uid['uid']){
				//更改密码
				$flag = $User->where("uid=".$arr_uid['uid'])->setField("passwd", $new_passwd);
				if($flag || $flag == 0){
					$this->ajaxReturn(1,"修改成功",1);
				}else{
					$this->ajaxReturn(0,"修改失败",0);
				}
			}else{
				$this->ajaxReturn(0,"旧密码错误",0);
			}
		}
		
	}
}
?>