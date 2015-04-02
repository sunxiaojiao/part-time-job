<?php
class ApplyJobAction extends Action{
	//
	public function apply(){
		//判断登录
		if(!session("?uid")){
			$this->ajaxReturn(0,"未登录",0);
		}
		//
		$Apply = M('Apply');
		$data['app_uid'] = session("uid");
		$data['app_jid'] = session("jid");
		$data['ctime'] = time();
		$where = "app_uid=".$data['app_uid']." AND app_jid=".$data['app_jid'];
		if($Apply->where($where)->find()){
			$this->ajaxReturn(0,"你已经申请过了",0);
			return;
		}
		if($Apply->add($data)){
			$this->ajaxReturn(1,"申请成功",1);
		}else{
			$this->ajaxReturn(0,"申请失败",0);
		}
		
	}
}
?>