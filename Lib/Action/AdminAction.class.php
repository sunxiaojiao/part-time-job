<?php
class AdminAction extends Action {
	public function index() {
		session('admin_id',1);
		//检查用户登录
		if(!session('?admin_id')) {
			$this->error("未登录",U('Index/index'));
			return;
		}
		$this->authApply();
		$this->display();
	}
	//列出认证申请列表
	protected function authApply() {
		$OrgAuth = M('Orgsauth');
		$where = "";
		$field = "xm_orgs.oid AS oid,xm_orgs.orgname AS orgname";
		$join  = "INNER JOIN `xm_orgs` ON xm_orgs.oid = xm_orgsauth.auth_oid";
		$arr2_list = $OrgAuth->where($where)->join($join)->field($field)->select();
		dump($arr2_list);
		dump($OrgAuth->getLastSql());
		if($arr2_list > 0){
			$this->assign('applyLists',$arr2_list);
		}elseif($arr2_list === false) {
			$this->assign("applyLists","读取失败");
		}else{
			$this->assign("applyLists","记录为空");
		}
	}
	//处理认证申请列表
	public function authHandler() {
		//接受参数
		$is_pass = 0;
		$is_validate = 0;
		if($this->_post('pass') == 'yes') {//通过
			$is_pass = 2;
			$is_validate = 1;
		}elseif ($this->_post('pass') == 'no'){//拒绝
			$is_pass = 3;
			$is_validate = 0;
		}
		//xm_orgsauth 修改is_pass
		$OrgAuth = M('Orgsauth');
		$where1 = "auth_oid=" . $this->_post('oid');
		if(!$OrgAuth->where($where1)->setField("is_pass",$is_pass)){
			echo $OrgAuth->getLastSql();
			$this->ajaxReturn(1,"操作失败",0);
			return;
		}
		//xm_orgs 修改 is_validate
		$Org = M('orgs');
		$where = "oid=" . $this->_post('oid');
		if($Org->where($where)->setField("is_validate",$is_validate)) {
			$this->ajaxReturn(2,"操作成功",1);
		}else{
			$this->ajaxReturn(2,"操作失败",0);
		}
	}
	//列出兼职发布申请列表
	protected function publishApply() {
		
	}
	//处理兼职申请列表
	public function jobHandler() {
		
	}
	//删除任意兼职
	public function deleteJob() {
		
	}
	//删除公司
	public function deleteOrg() {
		
	}
	//记录上一次登录的时间和IP
	protected function lastRecord() {
		
	}
}
?>