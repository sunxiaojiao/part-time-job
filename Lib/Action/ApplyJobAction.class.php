<?php
class ApplyJobAction extends Action{
	public function index(){
		echo '';
	}
	public function apply(){
		//判断登录
		if(!session("?uid")){
			$this->ajaxReturn(0,"未登录",1);
		}
		//判断是否已经申请过了
		$Apply = M('Apply');
		$data['app_uid'] = session("uid");
		$data['app_jid'] = session("jid");
		$where = "app_uid=".$data['app_uid']." AND app_jid=".$data['app_jid'];
		if($Apply->where($where)->find()){
			$this->ajaxReturn(3,"你已经申请过了",1);
			return;
		}
		//判断申请次数
		$User = M('Users');
		$arr_apply = $User->field('apply_count,apply_time')->find(session('uid'));
		//只有当申请机会为0 且 为时间为今天时 阻止申请
		if($arr_apply['apply_count']<=0 && date('Ymd',$arr_apply['apply_time']) === date('Ymd')){
			$this->ajaxReturn(5,'你今天已经申请过3次了，不能再申请兼职了',1);
			return;
		}
		//判断用户是否已经添加企业要求的支付方式
		$Job  = M('Jobs');
		$pay_field = 'default_payway';
		$warning_info;
		$pay_way = $Job->where('jid=' . session('jid'))->getField('pay_way');
		switch ($pay_way){
			case 1:
				$pay_field = 'pay_alipay_id';
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
		$Job = M('Jobs');
		$oid = $Job->where("jid=".session('jid'))->field("pub_oid")->find();
		$data_apply = array('app_oid'=>$oid['pub_oid'],'app_uid'=>session('uid'),'app_jid'=>session('jid'),'ctime'=>time());
		if($Apply->add($data_apply)){
//			dump($Apply->getlastSql());
			//更新用户可申请次数
			if(!$this->updateApplyCount($arr_apply)){
				//
				$this->ajaxReturn(2,'申请失败',1);
				return;
			}
			//更新jobs中，当前申请人数
			$Job->where("jid=".session('jid'))->setInc('current_peo',1);
			//计算可申请次数
			$leave_count = 2 ;
			if(date('Ymd',$arr_apply['apply_time']) !== date('Ymd')){   //最后的申请时间是今天之前
				$leave_count = 2;
			}else{   							  //最后的申请时间为今天
				$leave_count = $arr_apply['apply_count'] - 1;
			}
			$this->ajaxReturn(4,"申请成功，今日还可以申请". $leave_count ."次",1);
		}else{
			$this->ajaxReturn(2,"申请失败",1);
		}
		
	}
	protected function updateApplyCount($arr){
		$User = M('Users');
		//获取
		$apply_count = $arr['apply_count'];
		$apply_time  = $arr['apply_time'];
		//处理
		$where = 'uid=' . session('uid');
		if(date('Ymd',$apply_time) === date('Ymd')){
			if($apply_count>0){
				$User->where($where)->setDec('apply_count',1);	
			}
		}else{
			$User->where($where)->setField('apply_count',2);
		}
		return $User->where($where)->setField('apply_time', time());
	}
}
?>