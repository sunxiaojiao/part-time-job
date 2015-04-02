<?php
/**
 * 
 * 用户中心
 * @author Airect
 */

class UserCenterAction extends Action{
	//存储从用户表中读取出的信息 array
	private $data;
	public function index(){
		if(session("?uid")){
			$uid = session('uid');
		}else{
			$this->error('未登录','index.php');
		}
		$User = D('Users');
		$where = "uid='$uid'";
		$field = "uid,passwd";
		$this->data = $User->where($where)->field($field,true)->find();
		$this->assign("userinfo",$this->data);
		dump($this->data);
		$this->display();
	}
	//更改用户信息
	public function updateInfo(){
		//先判断用户更改了那些字段的信息，将更改的字段信息进行更新
		foreach($this->data as $key => $value){
//			if($value != $_POST[$key] && isset($_POST($key))){
//				$this->data[$key] = $_POST[$key];
//			}
		}
		
		$User = D('Users');
		//根据用户选择的地点从xm_address表中选择地点的aid，插入xm_users表
		$province = $this->_post('province');
		$city = $this->_post('city');
		$area = $this->_post('area');
		$Addr = M('Address');
		$aid  = $Addr->where("province='{$province}' AND city='{$city}' AND area='{$area}'")->field("aid")->find();
		if($aid){
			unset($_POST['province']);
			unset($_POST['city']);
			unset($_POST['area']);
			$_POST['address'] = $aid;
		}else{
			$this->ajaxReturn(0,"地点查询错误",0);
			return;
		}
//		//默认得到intent中的数据为数组，将它将换为json字符串
//		$_GET['intent'] = json_encode($_GET['intent']);
		if($User->create()){
			if($User->save()){
				$this->ajaxReturn(1,"更新成功",1);
			}
		}else{
			$this->ajaxReturn($User->getError());
		}
	}
	//显示干过的兼职
	private function jobLists(){
		
	}
}

?>