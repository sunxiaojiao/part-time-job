<?php
class OrgCenterAction extends Action{
	public function index(){
		header("charset=utf-8");
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
		dump($org_info);
		if($org_info){
			$this->assign("orgInfo",$org_info);
		}else{
			$this->ajaxReturn(0,"获取企业信息失败",0);
		}
		//列出申请列表
		$apply_list = $this->whoApplyed();
		if($apply_list){
			
		}elseif ($apply_list === null){
			$apply_list['fail_warning'] = "无申请人";
		}else{
			$apply_list['fail_warning'] = "查询失败";
		}
		dump($apply_list);
		$this->assign("applyList",$apply_list);
		$this->display();
	}
	//显示发布的兼职
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
	//编辑页面显示企业信息
	public function editInfo(){
		$Org = M('Orgs');
		$where = "oid=".session('oid');
		$field = "oid,passwd";
		$arr_info = $Org->field($field,true)->where($where)->find();
		dump($arr_info);
		if($arr_info){
			$this->assign("orgInfo",$arr_info);
		}else{
			$this->ajaxReturn(0,"获取信息失败",0);
		}
		$this->display();
	}
	//更新企业信息
	public function updateInfo(){
		$Org = D('Orgs');
		$where = "oid=".session('oid');
		if(!$Org->create()){
			$this->ajaxReturn(0,$Org->getError(),0);
			return;
		}
	
		if($flag = $Org->where($where)->save()){
			$this->ajaxReturn(1,"更新成功",1);
		}else{
			$info = "更新失败";
			if($flag == 0){
				$this->ajaxReturn(1,"数据未更新",1);
				
			}else{
				$this->ajaxReturn(1,"更新失败",0);
			}
		}
	}
	//列出申请列表
	private function whoApplyed(){
		if(!session('?oid')){
			$this->error("未登录",U('Login/index'));
			return;
		}
		$Apply = M('apply');
		$where = "app_oid=".session('oid');
		$field = "xm_users.uid AS uid,xm_users.username AS username,xm_apply.ctime AS ctime,xm_apply.app_jid AS jid";
		$join = "INNER JOIN xm_users ON xm_users.uid=xm_apply.app_uid";
		$arr2_apply = $Apply->where($where)->join($join)->field($field)->select();
		if($arr2_apply){
			$this->assign("applyList",$arr2_apply);
		}else{
			return $arr2_apply;
		}
	}
	//是否通过申请人的兼职申请
	public function isPass(){
		if(!session('?oid')){
			$this->error("企业用户未登录",U('Login/index'));
			return;
		}
		
		if($this->_get('ispass') == 'yes'){
			$uid = $this->_get('uid');
			$jid = $this->_get('jid');
			$aid = $this->_get('aid');
			$where = "jid=".$jid;
			$Job = M('jobs');
			//xm_jobs表 current_peo +1
			$Job->where($where)->setInc("current_peo",1);
			//xm_jobs表 crowd_uids新增申请人uid
			$uids = $Job->field("crowd_uids")->where($where)->find();
			$uids[] = $uid;
			$Job->where($where)->setField("crowd_uids",$uids);
			//xm_apply表中 is_pass 改为2
			$Apply = M('apply');
			$Apply->where("aid".$aid)->setField("is_pass, 2);
		}else{
		}
	}
}
?>