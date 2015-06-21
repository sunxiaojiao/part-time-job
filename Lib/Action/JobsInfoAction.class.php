<?php
class JobsInfoAction extends Action{
	protected  $jid;
	public function index(){
		$this->showInfo();
		$this->showApplyRecord();
		$this->showEva();
		$this->recordClickNum();
		session("jid",$this->jid);
		$this->isCanLookTel();
		$this->display();
	}
	//显示兼职信息
	protected function showInfo(){
		$this->jid =  $this->_get('jid');
		$Job = M('Jobs');
		$field = "jid,oid,address,title,pay_way,org_intro,addressname,detail,xm_mold.name,xm_orgs.orgname,is_validate,pub_oid,money,money_style,work_time,begin_time,want_peo,peo_style,current_peo,leader,xm_jobs.ctime,leader_phone,pv";
		$where = "jid=%d";// . " AND " . 'is_pass=1';
		//,count(app_id) AS app_count
		$join_mold   = "INNER JOIN xm_mold ON xm_mold.mid=xm_jobs.mold_id";
		$join_orgs   = "INNER JOIN xm_orgs ON xm_orgs.oid=xm_jobs.pub_oid";
//		$join_apply  = "INNER JOIN xm_apply ON xm_apply.app_jid = xm.jobs.jid";
		$arr1 = $Job->where($where,$this->jid)->join($join_mold)->join($join_orgs)/*->join($join_apply)*/->field($field)->find();
		if(isset($arr1['address'])){
			$arr1['address'] = explode(",", $arr1['address']);
		}
		session('pub_oid',$arr1['pub_oid']);
		session('phone',$arr1['leader_phone']);
		//dump($arr1['address']);
		if($arr1){
			$this->assign("list",$arr1);
			return;
		}else if(is_null($arr1)){
			$this->assign('job_error_info','没有此兼职');
		}else{
			$this->assign('job_error_info','查询错误，请稍后再试');
		}
	}
	//记录浏览量
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
	//显示已经申请的用户
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
	//是否已经申请
	protected function isCanLookTel (){
		if(!session('uid')){
			$this->assign('a_tourist','申请后查看');
			return;
		}
		$Apply = M('Apply');
		$f = $Apply->where('app_jid = %d AND app_uid= %d',session('jid'),session('uid'))->field('app_id')->find();
		if(!$f){
			$this->assign('a_tourist','申请后查看');
			return;
		}
	}
	//生成图片手机号
	public function generatePhoneImage($phone_num = '') {
		import('ORG.Util.Image');
		$phone_num = session('phone');
		$phone_num = (string)$phone_num;
		$img = new Image();
		$img->buildString($phone_num, array(),'','png',1,false);
	}

}
?>
