<?php
class LogoutAction extends Action{
	public function index(){
		session('oid',null);
		session('uid',null);
		session('usernmae',null);
		session('orgname',null);
		session_destroy();
		cookie('xmf',null);
		cookie('userphoone',null);
		$this->success('注销成功',U('Index/index'),0);
	}
}
?>