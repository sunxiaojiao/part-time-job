<?php
class OrgEvaluteAction extends Action {
	public function index() {
		if(!session('?uid')){
			return;
		}
		$Eval = D('OrgEvalute');
		if(!$Eval->create()){
			$this->ajaxReturn(0,$Eval->getError(),1);
			return;
		}
		$Eval->from_uid = session('uid');
		$Eval->to_oid   = session('pub_oid');
		if($Eval->add()){
			$this->ajaxReturn(1,"发布评论成功",1);
		}else{
			$this->ajaxReturn(2,"发布评论失败",1);
		}
	}
}
?>