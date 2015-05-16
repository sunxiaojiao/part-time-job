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
		//dump($org_info);
		if($org_info){
			$this->assign("orgInfo",$org_info);
		}else{
			$this->ajaxReturn(0,"获取企业信息失败",0);
		}
		//列出申请列表
		$this->whoApplyed();
		//
		$this->showIngJob();
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
		//dump($arr_info);
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
			if($flag == 0){
				//dump($Org->getLastSql());
				$this->ajaxReturn(1,"数据未更新",2);
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
		$where = "app_oid=".session('oid')." AND is_pass =1";
		$field = "xm_apply.app_id AS app_id,xm_users.uid AS uid,xm_users.username AS username,xm_apply.ctime AS ctime,xm_apply.app_jid AS jid,xm_jobs.title AS title";
		$join_user = "INNER JOIN xm_users ON xm_users.uid=xm_apply.app_uid";
		$join_job = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_apply.app_jid";
		$arr2_apply = $Apply->where($where)->join($join_user)->join($join_job)->field($field)->select();
		//dump($Apply->getLastSql());
		if($arr2_apply){
			$this->assign("apply_list",$arr2_apply);
		}elseif (is_null($apply_list)){
			$this->assign("apply_error_info","无申请人");
		}else{
			$this->assign("apply_error_info","查询失败");
		}
	}
	//显示正在进行中的兼职
	protected function showIngJob() {
		$Work   = M('Working');
		$where  = "pub_oid=" . session('oid') . ' AND ' . 'xm_working.is_pass=2';
		$field  = "work_uid,work_id,work_status,xm_working.ctime,username";
		$join1  = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_working.work_jid";
		$join2  = "INNER JOIN xm_users ON xm_users.uid=xm_working.work_uid";
		$arr2   = $Work->where($where)->join($join1)->join($join2)->field($field)->select();
		if($arr2){
			$this->assign('work_info',$arr2);
		}elseif(is_null($arr2)){
			$this->assign('work_error_info','还没有进行中的兼职');
		}else{
			$this->assign('work_error_info','读取错误');
		}
	}
	//兼职状态的确认
	public function statusHandler() {
		if(!session('?oid')){
			$this->error('未登录',U("Login/index"));
			return;
		}
		$f   = $this->_get('f');
		$wid = $this->_get('wid');
		$Work = M('Working');
		$where = "work_id=" . $wid;
		$arr = array();
		if($f == '0'){
			$arr = array('is_pass'=>1,'work_status'=>2);//通过
		}elseif($f == '1'){
			$arr = array('is_pass'=>0,'work_status'=>2);//不通过
		}
		$flag = $Work->where($where)->save($arr);
		if($flag){
			$this->ajaxReturn(1,'操作成功',1);
		}else{
			$this->ajaxReturn(2,'操作失败'.$Work->getLastSql(),1);
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
			$app_id = $this->_get('app_id');
			$where = "jid=".$jid;
			$Job = M('jobs');
			//xm_jobs表 current_peo +1
			if(!$Job->where($where)->setInc("current_peo",1)){
				echo $Job->getError();
				return;
			}
			//xm_jobs表 crowd_uids新增申请人uid
			$uids = $Job->field("crowd_uids")->where($where)->find();
			if(!$uids){
				echo $Job->getError();
			}
			$uids = unserialize($uids);
			$uids[] = $uid;
			$uids = serialize($uids);
			$Job->where($where)->setField("crowd_uids",$uids);
			//xm_apply表中 is_pass 改为2
			$Apply = M('apply');
			$flag = $Apply->where("app_id=".$app_id)->setField("is_pass", 2);
			if($flag){
				$this->ajaxReturn(1,"操作成功",1);
			}else{
				$this->ajaxReturn(1,"操作失败".$Apply->getLastSql(),0);
			}
		}else{
			$app_id = $this->_get('app_id');
			$Apply = M('apply');
			$flag = $Apply->where("app_id=".$app_id)->setField("is_pass",3);
			if($flag){
				$this->ajaxReturn(1,"操作成功",1);
			}else{
				echo $Apply->getLastSql();
				$this->ajaxReturn(0,"删除失败".$Apply->getError(),0);
			}
		}
	}

}
?>