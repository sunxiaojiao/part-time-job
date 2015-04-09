<?php
/**
 * 
 * 企业用户验证页面，负责收集验证信息，添加到xm_orgsauth表
 * @author Airect
 *
 */
class OrgAuthAction extends Action {
	public function index() {
		$this->display();
	}
	public function auth() {
		$OrgAuth = D('orgsauth');
		if($OrgAuth->create()){
			if($OrgAuth->add()){
				$this->ajaxReturn(1,"提交成功",1);
			}else{
				$this->ajaxReturn(0,"提交失败，请稍后再试",0);
			}
		}else{
			$this->ajaxReturn(0,$OrgAuth->getError(),0);
		}
	}
}
?>