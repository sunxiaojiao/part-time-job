<?php
class UserInfoAction extends Action{
	private $uid;
	private $Model;

	public function index(){
		$this->showInfo();
		$this->display();
	}
	private function showInfo(){
		$this->uid = $this->_get('uid');
		$Users = M('Users');
		$field = "uid,username,age,sex,avatar,phone,address,qq,school,exp,intent";
		$list = $Users->where("uid=".$this->uid)->field($field)->find();
		//查询mold表
		$intent = unserialize($list['intent']);
		$Mold = M('Mold');
		$where = "";
		foreach ($intent as $key => $value){
			$where .= "mid=".$value." OR ";
		}
		$where = substr($where,0,strlen($where)-4);
		$intent = $Mold->where($where)->field("name")->select();
		$this->assign("user_info",$list);
		$this->assign("intent",$intent);
	}
}
?>