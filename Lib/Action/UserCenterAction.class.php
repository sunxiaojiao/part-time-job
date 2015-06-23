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
			$this->error('您还未登录',U("Login/index"),3);
		}
		//显示基本信息
		$this->showInfo();
		//显示工作申请信息
		$this->jobApplyed();
		//显示申请列表
		$this->evalList();
		//显示正在进行的兼职
		$this->showMyJobList();
		
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
		//居住地
		$address = unserialize($this->data['address']);
		$this->assign('address',$address['province'].$address['city'].$address['area']);
		$this->assign('arr_address',$address);
		//可申请的次数
		$apply_count = $this->data['apply_count'];
		$apply_time  = $this->data['apply_time'];
		$apply_num = 3;
		if(date('Ymd') === date('Ymd',$apply_time)){
			$apply_num = $apply_count;
		}
		$this->assign("apply_num",$apply_num);
		session("userData",$this->data);
	}
	//更改用户信息
	public function updateInfo(){
		$User = D('Users');
		if(!$User->create($_POST,2)){
			$this->ajaxReturn(0,$User->getError(),1);
			return ;
		}
		//默认得到intent中的数据为数组，将它将换为可存储字符串
		$User->intent = serialize($User->intent);
		//序列化地址
		if($this->_post('province') == '' || $this->_post('city') == '' || $this->_post('area') == ''){
			$this->ajaxReturn(0,'请选择居住地',1);
		}
		$address = array(
					'province'=>$this->_post('province'),
					'city'    =>$this->_post('city'),
					'area'    =>$this->_post('area'),
					);
		$User->address = serialize($address);
		//修改数据库中的用户信息
		$where = "uid=" . session('uid');
		$flag = $User->where($where)->save();
		if($flag){
			$this->ajaxReturn(1,"更改成功",1);
		}elseif($flag === 0){
			$this->ajaxReturn(1,"更新成功",1);
		}else{
			$this->ajaxReturn(3,"更新失败",1);
		}
	}
	//显示我的支付信息
	public function showPayInfo() {
		if(!session('?uid')){
			$this->error('未登录',U('Login/index'),3);
			return;
		}
		$field = "default_payway,pay_alipay_id,pay_ccard_id";
		$where = "uid=" . session('uid');
		$User  = M('Users');
		$arr1  = $User->field($field)->where($where)->find();
		if($arr1){
			$this->assign('pay_info',$arr1);
		}elseif(is_null($arr1)){
			$this->assign('error_pay_info','还没有添加支付方式');
		}else{
			$this->assign('error_pay_info','读取错误');
		}
		$this->display('PayInfo');
	}  
	//更改我的支付信息
	public function payInfoHandler() {
		if(!session('?uid')){
			$this->error('未登录',U('Login/index'),3);
			return;
		}
		$User  = M('Users');
		$type = $this->_post('type');
		$content = $this->_post('content');
		//验证一下
		if(!$User->check($type, '1,2,3','in')){
			$this->ajaxReturn(0,'error',1);
			return ;
		}
		$data; 
		switch ($type){
			case 1://支付宝
				$f = $User->check($content, '/.{1,21}/');
				if(!$f){
					$this->ajaxReturn(1,'请输入支付宝信息',1);
					return ;
				}
				$data = array('pay_alipay_id'=>$content);
				break;
			case 2://银行卡
				$f = $User->check($content, '/\d{16,19}/');
				if(!$f){
					$this->ajaxReturn(1,'请输入正确的银行卡信息',1);
					return ;
				}
				$data = array('pay_ccard_id'=>$content);
				break;
			case 3://默认支付方式
				$f = $User->check($content, '1,2,3','in');
				if(!$f){
					$this->ajaxReturn(0,'error',1);
					return ;
				}
				$data = array('default_payway'=>$content);
				break;
		}
		$where = "uid=" . session('uid');
		$f     = $User->where($where)->save($data);
		$sql   = $User->getLastSql();
		if($f || $f === 0){
			$this->ajaxReturn(2,'操作成功',1);
		}else{
			$this->ajaxReturn(0,'操作失败'.$sql,1);
		}
	}
	//申请过的兼职
	private function jobApplyed(){
		$Apply = M('Apply');
		$where = "app_uid=" . session('uid');
		$field = "xm_jobs.jid,xm_jobs.title,xm_apply.ctime,xm_apply.is_pass";
		$join = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_apply.app_jid";
		$data = $Apply->where($where)->join($join)->field($field)->select();
		if($data){
			$this->assign("apply",$data);	
		}elseif(is_null($data)){
			$this->assign("apply_error_info","还没有申请兼职");
		}else{
			$this->assign("apply_error_info","查询错误");
		}
	}
	//我的评论
	protected function evalList() {
		$Eval  = M('UserEvalute');
		$field = "orgname,from_oid AS oid,content,xm_user_evalute.ctime";
		$join  = "INNER JOIN xm_orgs ON xm_orgs.oid=xm_user_evalute.from_oid";
		$where = "to_uid=" . session('uid');
		$arr2  = $Eval->field($field)->join($join)->where($where)->select();
		if($arr2){
			$this->assign('eval_info',$arr2);
		}elseif(is_null($arr2)){
			$this->assign('eval_error_info','还没有评论');
		}else{
			$this->assign('eval_error_info','查询错误');
		}
	}
	//进行中兼职
	protected function showMyJobList() {
		$Work  = M('Working');
		$field = "title,work_id,jid,work_status,xm_working.begin_time,end_time,xm_working.is_pass,xm_working.ctime";
		$where = "work_uid=" . session('uid');
		$join  = "INNER JOIN xm_jobs ON xm_jobs.jid=xm_working.work_jid";
		$arr2  = $Work->field($field)->join($join)->where($where)->select();
		if($arr2){
			$this->assign('work_info',$arr2);
		}elseif(is_null($arr2)){
			$this->assign('work_error_info','还没有兼职可以做');
		}else{
			$this->assign('work_error_info','读取错误'.$Work->getLastSql());
		}
	}
	//我的兼职-handler
	public function MyJobHandler() {
		//检测登录
		if(!session('?uid')){
			return ;
		}
		$wid   = $this->_get('wid');
		$flag  = $this->_get('f');
		if($flag === null){
			$this->ajaxReturn(0,'非法流程',1);
			return;
		}
		$Work  = M('Working');
		$where = "work_id=" . $wid;
		
		//开始兼职-----------------------------------------------------------
		if($flag == '1'){
			//检测是否为status=0
			$status = $Work->where($where)->getField('work_status');
			if($status === '1' || $status === '2'){
				$this->ajaxReturn(0,'非法流程',1);
				return;
			}
			$f = $Work->where($where)->save(array('work_status'=>1,'begin_time'=>time()));
			if($f){
				$this->ajaxReturn(1,'操作成功',1);
			}else{
				$this->ajaxReturn(0,'操作失败',1);
			}
		}
		
		//完成兼职------------------------------------------------------------
		if($flag == '2'){
		//检测是否为status=0
			$status = $Work->where($where)->getField('work_status');
			if($status !== '1'){
				$this->ajaxReturn(0,'非法流程',1);
				return ;
			}
			$f = $Work->where($where)->save(array('work_status'=>2,'end_time'=>time()));
			if($f){
				$this->ajaxReturn(1,'操作成功',1);
			}else{
				$this->ajaxReturn(0,'操作失败',1);
			}
		}	
	}
	
}

?>