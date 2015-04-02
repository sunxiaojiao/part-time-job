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
		if(session("?uid")){
			$uid = session('uid');
		}else{
			$this->error('未登录','index.php');
		}
		$User = D('Users');
		$where = "uid='$uid'";
		$field = "passwd";
		$this->data = $User->where($where)->field($field,true)->find();
		$this->assign("userinfo",$this->data);
		//兼职意向 类型
		$Mold =M('Mold');
		$molds = $Mold->field("mid,name")->select();
		$this->assign("molds",$molds);
		
		dump($this->data);
		session("userData",$this->data);
		$this->display();
	}
	//更改用户信息
	public function updateInfo(){
		//先判断用户更改了那些字段的信息，将更改的字段信息进行更新
//		foreach($this->data as $key => $value){
//			if($value != $_POST[$key] && isset($_POST($key))){
//				$this->data[$key] = $_POST[$key];
//			}
//		}
		$this->data = session("userData");
		$this->form = $this->_post();
		//根据用户选择的地点从xm_address表中选择地点的aid
		$province = $this->form['province'];
		$city = $this->form['city'];
		$area = $this->form['area'];
		$Addr = M('Address');
		$aid  = $Addr->where("province='{$province}' AND city='{$city}' AND area='{$area}'")->field("aid")->find();
		if($aid){
			unset($this->form['province']);
			unset($this->form['city']);
			unset($this->form['area']);
			$this->form['address'] = $aid;
		}else{
			echo $aid;
			$this->ajaxReturn(0,"地点查询错误",0);
			return;
		}

		$User = M('Users');
		//默认得到intent中的数据为数组，将它将换为可存储字符串
		$this->form['intent'] = serialize($this->form["intent"]);
		$where = "uid = '".$this->data['uid']."'";
		if($User->where($where)->save($this->form)){
			//echo $User->getLastSql();
			$this->ajaxReturn(1,"更新成功",1);
		}else{
			if($User->getError() === ""){
				$this->ajaxReturn(1,"没有更新数据",1);
			}else{
				$this->ajaxReturn(1,$User->getError(),0);
			}
		}
	}
	//显示干过的兼职
	private function jobLists(){
		
	}
}

?>