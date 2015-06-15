<?php
class OrgInfoAction extends Action{
	
	protected  $oid;
	public function index(){
		header('Content-type:text/html;charset=utf-8');
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
		$Org   = M('Orgs');
		$field = "orgname,email,xm_orgs.phone,is_validate,avatar,org_address,website,fixed_phone,org_intro,xm_orgs.ctime,xm_industry.name,size,nature";
		$join1  = "LEFT JOIN xm_orgs_auth ON xm_orgs_auth.auth_oid=xm_orgs.oid";
		$join2 = "LEFT JOIN xm_industry ON xm_orgs_auth.industry=xm_industry.ind_id"; 
		$arr2  = $Org->field($field)->join($join1)->join($join2)->where("oid=%d",$this->oid)->find();
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
		$where = "pub_oid=%d" . " AND " . "(" . time() . "- expire_time)<0" . " AND " . "is_pass=0";
		$field = "title,jid,ctime";
		$arr2  = $Job->where($where,$this->oid)->field($field)->select();
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
		$where = "to_oid=%d";
		$join  = "INNER JOIN xm_users ON xm_users.uid=xm_org_evalute.from_uid"; 
		$arr2  = $Eval->field($field)->where($where,$this->oid)->join($join)->select();
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