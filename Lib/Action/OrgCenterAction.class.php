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
		$this->display();
	}
	private function showPublicedJob(){
		$Jobs = M('Jobs');
		$where = "pub_oid=".session('oid');
		$field = "";
		$arr_jobs = $Jobs->where($where)->field($field)->select();
		if($arr_jobs){
			return $arr_jobs;
		}else{
			return false;
		}
	}
}
?>