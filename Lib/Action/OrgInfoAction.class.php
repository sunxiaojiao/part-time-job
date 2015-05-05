<?php
class OrgInfoAction extends Action{
	private $oid;
	public function index(){
			//检测用户登录
//		if(empty(session('oid'))){
//			return 3;
//		}else{
//			$this->oid = session('oid');
//		}
		$this->display();
	}
	private function showInfo(){
		$this->oid = $this->_get('oid');
		$Org = M('Orgs');
		$arr2 = $Org->where("oid=".$this->oid)->find();
		if($arr2){
			
		}
			
	}
}
?>