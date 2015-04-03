<?php
class OrgCenterAction extends Action{
	public function index(){
		if(!session('?oid')){
			//抛出错误页面
			$this->error("企业用户未登录",U("Login/index"));
			return;
		}
		$publiced_jobs = $this->showPublicedJob();
		if($publiced_jobs){
			$this->assign("publicedJobs",$publiced_jobs);
		}else{
			$this->ajaxReturn(0,"获取发布的兼职失败",0);
		}
		//dump($publiced_jobs);
		$org_info = $this->showOrgInfo();
		if($org_info){
			$this->assign("orgInfo",$org_info);
		}else{
			$this->ajaxReturn(0,"获取企业信息失败",0);
		}
		$this->display();
	}
	private function showPublicedJob(){
		$Jobs = M('Jobs');
		$where = "pub_oid=".session('oid');
		$field = "";
		$arr2_jobs = $Jobs->where($where)->field($field)->select();
		if($arr2_jobs){
			return $arr2_jobs;
		}else{
			echo $Jobs->getLastSql();
			return false;
		}
	}
	private function showOrgInfo(){
		$Orgs = M('Orgs');
		$where = "oid=".session('oid');
		$field = "mid,passwd";
		$arr2_org = $Orgs->where($where)->field($field,true)->find();
		if($arr2_org){
			return $arr2_org;
		}else{
			return false;
		}
	}
	//编辑企业信息
	public function editInfo(){
		$this->display();
	}
}
?>