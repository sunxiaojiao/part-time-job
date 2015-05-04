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
		//显示以前的申请信息
		$this->showInfo();
		//判断是否申请过,让申请按钮disabled
		if($this->isApply()) {
			$this->assign('isApply',false);
		}else{
			$this->assign('isApply',false);
		}
		$this->display();
	}
	protected function showInfo() {
		$Org   = M('OrgsAuth');
		$where = "oid=" . session('oid');
		$field = "orgname,email,is_pass,license_num,industry,nature,size,contact,idcard_num";
		$join  = "RIGHT JOIN xm_orgs ON xm_orgs.oid=xm_orgs_auth.auth_oid"; 
		$arr2  = $Org->where($where)->field($field)->join($join)->find();
		//dump($arr2);
		if($arr2){
			$this->assign("org_info",$arr2);
		}elseif(is_null($arr2)){
			$this->assign("org_error_info","您还未认证");
			//$orgname =			
		}else{
			$this->assign("org_error_info","查询认证状态错误");
		}
		$Industry = M('Industry');
		$arr2_ind = $Industry->field('ind_id,name')->select();
		$this->assign("indlist",$arr2_ind);
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
		$OrgsAuth = D('OrgsAuth');
		$flag = $OrgsAuth->create();
		if(!$flag){
			$this->ajaxReturn(0,$OrgsAuth->getError(),1);
			return;
		}
		if($OrgsAuth->where("auth_oid=" . session('oid'))->add()){
			$this->ajaxReturn(1,"申请成功",1);	
		}else{
			$this->ajaxReturn(2,"申请异常",1);	
		}
		
	}
	private function isApply() {
		$OrgAuth = M('OrgsAuth'); 
		$ishave  = $OrgAuth->where("auth_oid=".session('oid'))->field("auth_id")->find();
		return $ishave;
	}
	public function uploadFile(){
		import('ORG.Net.UploadFile');
		$photo = new UploadFile();
		$photo->maxsize = 1024*2;
		$photo->allowExts = array('jpg','png','gif','jpeg');
		$photo->savePath = 'Uploads/auth/';
		$photo->subType  = 'date';
		$photo->autoSub = true;
		if(!$photo->upload()){
			$this->ajaxReturn(0,$photo->getErrorMsg(),1);
			return;
		}
		$img_data = $photo->getUploadFileInfo();
		$path = $img_data[0]['savepath'] . $img_data[0]['savename'];
		$OrgAuth = M('OrgsAuth');
		$where = "auth_oid=" . session('oid');
		$flag = false;
		if($this->_post('keys') == 'org_img'){
			$flag = $OrgAuth->where($where)->setField("license_img", $path);
		}elseif($this->_post('keys') == 'idcard_img1'){
			$flag = $OrgAuth->where($where)->setField('idcard_img1', $path);
		}elseif($this->_post('keys') == 'idcard_img2'){
			$flag = $OrgAuth->where($where)->setField('idcard_img2', $path);
		}
		if($flag){
			$this->ajaxReturn(1,"上传成功",1);
		}else{
			$this->ajaxReturn(0,"上传失败",1);
		}
	}
}
?>