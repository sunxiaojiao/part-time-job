<?php
class OrgEvaluteAction extends Action {
	public function index() {
		if(!session('?uid')){
			return;
		}
		$Eval = D('OrgEvalute');
		$flag = $Eval->field("eva_id")
					 ->where("from_uid=" . session('uid') . " AND " . "to_oid=" . session('pub_oid'))
					 ->find();
		if($flag){
			$this->ajaxReturn(4,"您已经评论过了",1);
			return ;
		}
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