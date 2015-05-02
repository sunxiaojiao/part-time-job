<?php
/**
 * 
 * 用户中心
 * @author Airect
 */

class UserCenterAction extends Action{
	//存储从用户表中读取出的信息 array
	private $data;
	private $form;
	public function index(){
		//判断登录
		if(!session("?uid")){
			$this->error('您还未登录','index.php',3);
		}
		$this->showInfo();
		//显示工作申请信息
		$this->jobApplyed();
		$this->jobLists();
		$this->display();
	}
	public function editInfo(){
		$this->showInfo();
		$this->display();
	}
	//显示用户信息
	protected function showInfo(){
		//获取数据库中的用户信息
		$User = D('Users');
		$where = "uid=".session('uid');
		$nofield = "passwd";
		$this->data = $User->where($where)->field($nofield,true)->find();
		$this->assign("userinfo",$this->data);
		//兼职意向 类型
		$Mold =M('Mold');
		$molds = $Mold->field("mid,name")->select();
		$this->assign("molds",$molds);
		
		dump($this->data);
		session("userData",$this->data);
	}
	//更改用户信息
	public function updateInfo(){
		//先判断用户更改了那些字段的信息，将更改的字段信息进行更新
//		foreach($this->data as $key => $value){
//			if($value != $_POST[$key] && isset($_POST($key))){
//				$this->data[$key] = $_POST[$key];
//			}
//		}
//		$this->data = session("userData");
//		$this->form = $this->_post();
//		//根据用户选择的地点从xm_address表中选择地点的aid
//		$province = $this->form['province'];
//		$city = $this->form['city'];
//		$area = $this->form['area'];
//		$Addr = M('Address');
//		$aid  = $Addr->where("province='{$province}' AND city='{$city}' AND area='{$area}'")->field("aid")->find();
//		if($aid){
//			unset($this->form['province']);
//			unset($this->form['city']);
//			unset($this->form['area']);
//			$this->form['address'] = $aid;
//		}else{
//			echo $aid;
//			$this->ajaxReturn(0,"地点查询错误",0);
//			return;
//		}

		$User = D('Users');
		if(!$User->create()){
			//dump($this->_post());
			$this->ajaxReturn(0,$User->getError(),1);
			return ;
		}
		//dump($_POST['intent']);
		//默认得到intent中的数据为数组，将它将换为可存储字符串
		$User->intent = serialize($User->intent);
		//$this->form['intent'] = serialize($this->form["intent"]);
		$where = "uid=" . session('uid');
		//修改数据库中的用户信息
		$flag = $User->where($where)->save();
		if($flag){
			$this->ajaxReturn(1,"更改成功",1);
		}elseif($flag === 0){
			$this->ajaxReturn(1,"更新成功",1);
		}else{
			$this->ajaxReturn(3,"更新失败",1);
		}
	}
	//显示申请成功的兼职
	private function jobLists(){
		$Apply = M('Apply');
		$where = "app_uid=".session('uid') . " AND " . "xm_apply.is_pass=2";
		$field = "xm_jobs.jid AS jid,xm_jobs.title AS title,xm_apply.ctime AS ctime";
		$join = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_apply.app_jid";
		$data = $Apply->where($where)->join($join)->field($field)->select();
		if($data){
			$this->assign("passed_job",$data);
		}elseif(is_null($data)){
			$this->assign("passed_error_info","无记录");
		}else{
			$this->assign("passed_error_info","查询错误");
		}
		dump($Apply->getLastSql());
	}
	//
	private function jobApplyed(){
		$Apply = M('Apply');
		$where = "app_uid=".session('uid');
		$field = "xm_jobs.jid,xm_jobs.title,xm_apply.ctime,xm_apply.is_pass";
		$join = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_apply.app_jid";
		$data = $Apply->where($where)->join($join)->field($field)->select();
		if($data){
			$this->assign("apply",$data);	
		}elseif(is_null($data)){
			$this->assign("apply_error_info","无记录");
		}else{
			$this->assign("apply_error_info","查询错误");
		}
		
	}
}

?>