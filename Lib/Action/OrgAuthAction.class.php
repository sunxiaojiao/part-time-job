<?php
/**
 *
 * 企业用户验证页面，负责收集验证信息，添加到xm_orgsauth表
 * @author Airect
 *
 */
class OrgAuthAction extends Action {
	public function index() {
		if(!session('?oid')){
			$this->error("请企业用户登录",U('Login/index'));
		}
		//判断是否申请过,让申请按钮disabled
		if($this->isApply()) {
			$this->assign('isApply','true');
		}else{
			$this->assign('isApply','false');
		}
		$this->display();
	}
	public function auth() {
		if(!session('?oid')){
			$this->ajaxReturn(0,"企业用户未登录",0);
			return;
		}
		//验证是否申请过了
		if($this->isApply()){
			$this->ajaxReturn(1,"您已经申请过了",0);
			return;
		}
		//添加到xm_orgsauth表
		$OrgAuth = M('Orgsauth');
		$data_auth['auth_oid'] = session('oid');
		$data_auth['ctime']    = time();
		$OrgAuth->add($data_auth);
		//添加信息到xm_orgs表
		$Org = D('Orgs');
		if($data = $Org->create()){
			//过滤email和企业名称
			$flag = $Org->where("oid=".session('oid'))
						->save();
			if($flag){
				$this->ajaxReturn(1,"申请成功",1);
			}else{
				dump($flag);
				//dump($Org->getLastSql());
				$this->ajaxReturn(1,"申请失败".$Org->getError(),1);
			}
		}else{
			$this->ajaxReturn(0,$Org->getError(),1);
			return;
		}
		dump("ddd");
		
	}
	private function isApply() {
		$OrgAuth = M('Orgsauth'); 
		$ishave  = $OrgAuth->where("auth_oid=".session('oid'))->field("auth_id")->find();
		return $ishave;
	}
}
?>