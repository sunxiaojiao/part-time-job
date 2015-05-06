<?php
class OrgInfoAction extends Action{
	protected  $oid;
	public function index(){
			//检测用户登录
//		if(empty(session('oid'))){
//			return 3;
//		}else{
//			$this->oid = session('oid');
//		}
		$this->oid = $this->_get('oid');
		$this->showInfo();
		$this->showJobs();
		$this->showEval();
		$this->display();
	}
	protected  function showInfo(){
		$Org = M('Orgs');
		$field = "orgname,is_validate,avatar,org_address,website,phone,fixed_phone,org_intro,ctime";
		$arr2 = $Org->field($field)->where("oid=".$this->oid)->find();
		if($arr2){
			$this->assign("org_info",$arr2);
		}elseif(is_null($arr2)){
			$this->assign("org_info",'公司不存在');
		}else{
			$this->assign('org_info','读取错误');
		}
			
	}
	protected function showJobs() {
		$Job = M('jobs');
		$Job->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		$where = "pub_oid=" . $this->oid . " AND " . "(" . time() . "- expire_time)<0" . " AND " . "is_pass=0";
		$field = "title,jid,ctime";
		$arr2  = $Job->where($where)->field($field)->select();
		
		if($arr2){
			$this->assign('job_info',$arr2);
		}elseif(is_null($arr2)){
			$this->assign('job_error_info','尚未发布过兼职信息');
		}else{
			$this->assign('job_error_info','读取错误');
		}
	}
	protected function showEval() {
		$Eval  = M('OrgEvalute');
		$field = "username,content,xm_org_evalute.ctime";
		$where = "to_oid=" . $this->oid;
		$join  = "INNER JOIN xm_users ON xm_users.uid=xm_org_evalute.from_uid"; 
		$arr2  = $Eval->field($field)->where($where)->join($join)->select();
		if($arr2){
			$this->assign("eval_info",$arr2);
		}elseif(is_null($arr2)){
			$this->assign('eval_error_info','还没有评论');
		}else{
			$this->assign('eval_error_info','读取错误');
		}
	}
}
?>