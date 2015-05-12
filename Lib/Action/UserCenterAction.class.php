<?php
/**
 * 
 * 用户中心
 * @author Airect
 */

class UserCenterAction extends Action{
	//存储从用户表中读取出的信息 array
	private $data;
	private $form;
	public function index(){
		//判断登录
		if(!session("?uid")){
			$this->error('您还未登录','index.php',3);
		}
		$this->showInfo();
		//显示工作申请信息
		$this->jobApplyed();
		$this->jobLists();
		$this->evalList();
		$this->display();
	}
	public function editInfo(){
		$this->showInfo();
		$this->display();
	}
	//显示用户信息
	protected function showInfo(){
		//获取数据库中的用户信息
		$User = D('Users');
		$where = "uid=".session('uid');
		$nofield = "passwd";
		$this->data = $User->where($where)->field($nofield,true)->find();
		$this->assign("userinfo",$this->data);
		//兼职意向 类型
		$Mold =M('Mold');
		$molds = $Mold->field("mid,name")->select();
		$this->assign("molds",$molds);
		
		//dump($this->data);
		session("userData",$this->data);
	}
	//更改用户信息
	public function updateInfo(){
		$User = D('Users');
		if(!$User->create()){
			//dump($this->_post());
			$this->ajaxReturn(0,$User->getError(),1);
			return ;
		}
		//dump($_POST['intent']);
		//默认得到intent中的数据为数组，将它将换为可存储字符串
		$User->intent = serialize($User->intent);
		//$this->form['intent'] = serialize($this->form["intent"]);
		$where = "uid=" . session('uid');
		//修改数据库中的用户信息
		$flag = $User->where($where)->save();
		if($flag){
			$this->ajaxReturn(1,"更改成功",1);
		}elseif($flag === 0){
			$this->ajaxReturn(1,"更新成功",1);
		}else{
			$this->ajaxReturn(3,"更新失败",1);
		}
	}
	//显示申请过的兼职
	private function jobLists(){
		$Apply = M('Apply');
		$where = "app_uid=".session('uid') . " AND " . "xm_apply.is_pass=2";
		$field = "xm_jobs.jid AS jid,xm_jobs.title AS title,xm_apply.ctime AS ctime";
		$join = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_apply.app_jid";
		$data = $Apply->where($where)->join($join)->field($field)->select();
		if($data){
			$this->assign("passed_job",$data);
		}elseif(is_null($data)){
			$this->assign("passed_error_info","无记录");
		}else{
			$this->assign("passed_error_info","查询错误");
		}
//		/dump($Apply->getLastSql());
	}
	//
	private function jobApplyed(){
		$Apply = M('Apply');
		$where = "app_uid=" . session('uid');
		$field = "xm_jobs.jid,xm_jobs.title,xm_apply.ctime,xm_apply.is_pass";
		$join = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_apply.app_jid";
		$data = $Apply->where($where)->join($join)->field($field)->select();
		if($data){
			$this->assign("apply",$data);	
		}elseif(is_null($data)){
			$this->assign("apply_error_info","无记录");
		}else{
			$this->assign("apply_error_info","查询错误");
		}
	}
	//我的评论
	protected function evalList() {
		$Eval  = M('UserEvalute');
		$field = "orgname,from_oid AS oid,content,xm_user_evalute.ctime";
		$join  = "INNER JOIN xm_orgs ON xm_orgs.oid=xm_user_evalute.from_oid";
		$where = "to_uid=" . session('uid');
		$arr2  = $Eval->field($field)->join($join)->where($where)->select();
		if($arr2){
			$this->assign('eval_info',$arr2);
		}elseif(is_null($arr2)){
			$this->assign('eval_error__info','还没有评论');
		}else{
			$this->assign('eval_error_info','查询错误');
		}
	}
}

?>