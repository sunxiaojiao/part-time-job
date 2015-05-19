<?php
class ApplyJobAction extends Action{
	public function index(){
		echo '';
	}
	public function apply(){
		//判断登录
		if(!session("?uid")){
			$this->ajaxReturn(0,"未登录",0);
		}
		//判断是否已经申请过了
		$Apply = M('Apply');
		$data['app_uid'] = session("uid");
		$data['app_jid'] = session("jid");
		$where = "app_uid=".$data['app_uid']." AND app_jid=".$data['app_jid'];
		if($Apply->where($where)->find()){
			$this->ajaxReturn(0,"你已经申请过了",0);
			return;
		}
		//记录用户的支付方式
		$PayWay = M('PayWay');
		$data   = array(
			'pay_uid'=>session('uid'),
			'pay_jid'=>session('jid'),
			'pay_way'=>,
			'ctime'  =>time(),
		); 
		if($PayWay->add($data)){
			$this->ajaxReturn(1,'支付方式添加成功',1);	
		}else{
			$this->ajaxReturn(0,'支付方式添加失败，请稍后再试',1);
			return ;
		}
		//添加申请记录
		$Job = M('jobs');
		$oid = $Job->where("jid=".session('jid'))->field("pub_oid")->find();
		$data['app_oid'] = $oid['pub_oid'];
		$data['ctime'] = time();
		if($Apply->add($data)){
			$this->ajaxReturn(1,"申请成功",1);
		}else{
			$this->ajaxReturn(0,"申请失败",0);
		}
		
	}
	public function showPayWay() {
		if(!session('?uid')){
			$this->ajaxReturn(0,'未登录',1);
		}
		//
	}
}
?>