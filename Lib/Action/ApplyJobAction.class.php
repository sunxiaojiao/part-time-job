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
		//判断用户是否已经添加企业要求的支付方式
		$User = M('Users');
		$Job  = M('Jobs');
		$pay_field = 'default_payway';
		$warning_info;
		$pay_way = $Job->where('jid=' . session('jid'))->getField('pay_way');
		switch ($pay_way){
			case 1:
				$pay_field = 'pay_aliay_id';
				$warning_info = '您还未填写支付宝';
				break;
			case 2:
				$pay_field = 'pay_ccard_id';
				$warning_info = '你还未填写银行卡信息';
				break;
		}
		$flag = $User->where('uid=' . session('uid'))->getField($pay_field);
		if(!$flag){
			$this->ajaxReturn(1,$warning_info,1);
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