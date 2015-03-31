<?php
/**
 * 
 * 用户中心
 * @author Airect
 */
class UserCenterAction extends Action{
	public function index(){
		
		$this->display();
	}
	//更改用户信息
	public function updateInfo(){
		$User = D('Users');
		$User->create();
		$this->ajaxReturn($User->getError());
	}
	//显示干过的兼职
	private function jobLists(){
		
	}
}

?>