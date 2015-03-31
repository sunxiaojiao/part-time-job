<?php
/**
 * 
 * 用户中心
 * @author Airect
 */
class UserCenterAction extends Action{
	public function index(){
		dump(json_encode($this->_get('intent')));
		$this->display();
	}
	//更改用户信息
	public function updateInfo(){
		$User = D('Users');
		//根据用户选择的地点从xm_address表中选择地点的aid，插入xm_users表
		$province = $this->_get('province');
		$city = $this->_get('city');
		$area = $this->_get('area');
		$Addr = M('Address');
		$aid = $Addr->where("province='{$province}' AND city='{$city}' AND area='{$area}'")->find();
		if($aid){
			unset($_GET['province']);
			unset($_GET['city']);
			unset($_GET['area']);
			$_GET['address'] = $aid;
		}else{
			$this->ajaxReturn(0,"地点查询错误",0);
			return;
		}
//		//默认得到intent中的数据为数组，将它将换为json字符串
//		$_GET['intent'] = json_encode($_GET['intent']);
		if($User->create()){
			if($User->add()){
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