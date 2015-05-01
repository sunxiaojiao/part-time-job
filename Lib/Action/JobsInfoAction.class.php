<?php
class JobsInfoAction extends Action{
	protected  $jid;
	public function index(){
		$this->showInfo();
		$this->showApplyRecord();
		$this->showEva();
		$this->recordClickNum();
		session("jid",$this->jid);
		$this->display();
	}

	protected function showInfo(){
		$this->jid =  $this->_get('jid');
		$Job = M('Jobs');
		$field = "jid,address,title,org_intro,addressname,detail,xm_mold.name,xm_orgs.orgname,is_validate,pub_oid,money,money_style,work_time,begin_time,want_peo,peo_style,current_peo,leader,xm_jobs.ctime,leader_phone,pv";
		$where = "jid=".$this->jid;// . " AND " . 'is_pass=1';
		$join1 = "INNER JOIN xm_mold ON xm_mold.mid=xm_jobs.mold_id";
		$join2 = "INNER JOIN xm_orgs ON xm_orgs.oid=xm_jobs.pub_oid";
		$list = $Job->where($where)->join($join1)->join($join2)->field($field)->find();
		$list['address'] = explode(",", $list['address']); 
		session('pub_oid',$list['pub_oid']);
		dump($list);
		if($list){
			$this->assign("list",$list);
			return;
		}else if(is_null($list)){
			$this->assign('error_info','没有此兼职');
		}else{
			$this->assign('error_info','查询错误，请稍后再试'.$Job->getLastSql());
		}
	}
	protected function recordClickNum() {
		$Job    = M('jobs');
		$cookie = "hadclick";
		if(cookie($cookie) == ''){
			$Job->where("jid=".$this->jid)->setInc("pv",1);
			cookie($cookie,serialize(array($this->jid)),array('expire'=>3600*6));
		}else{
			$arr =unserialize(cookie($cookie));
			if(!in_array($this->jid,$arr)){
				$Job->where("jid=".$this->jid)->setInc("pv",1);
				$arr[] = $this->jid;
				//dump($arr);
				cookie($cookie,serialize($arr),array('expire'=>3600*6));
			}
		}
	}
	protected function showApplyRecord() {
		$Apply = M('apply');
		$where = "app_jid=".$this->_get('jid');
		$field = "username,xm_apply.ctime,is_pass";
		$join  = "INNER JOIN xm_users ON xm_users.uid=xm_apply.app_uid";
		$arr2  = $Apply->field($field)->join($join)->where($where)->select();
		if($arr2){
			$this->assign("applylist",$arr2);
		}else if(is_null($arr2)){
			$this->assign("apply_error_info","还没有人申请");
		}else{
			$this->assign("apply_error_info","查询错误，请稍后再试");
		}
	}
	//列出公司评价列表
	protected function showEva() {
		$Eva = M('Org_evalute');
		$where = "to_oid=" . session('pub_oid');
		$field = "username,content,xm_org_evalute.ctime";
		$join  = "INNER JOIN xm_users ON xm_org_evalute.from_uid=xm_users.uid";
		$arr2  = $Eva->field($field)->join($join)->where($where)->select();
		if($arr2){
			$this->assign("eval_list",$arr2);
		}elseif(is_null($arr2)){
			$this->assign("eval_error_info","暂无评价");
		}else{
			$this->assign("eval_error_info","查询错误");
		}
	}

}
?>
