<?php
class LogoutAction extends Action{
	public function index(){
		session('oid',null);
		session('uid',null);
		session('usernmae',null);
		session('orgname',null);
		session_destroy();
		redirect("index.php");
	}
}
?>