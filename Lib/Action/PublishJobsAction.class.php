<?php
class PublishJobsAction extends Action{
	public function index(){
		//获取当前用户
		if(!session("?oid")){
			//未登录，抛出跳转页面
			$this->redirect('Login/index','',2,'企业用户未登录，页面跳转中。。');
		}
		$this->showMolds();
		$this->display();
	}
	public function publish(){
		$Job = D('Jobs');
		//创建并插入数据
		if($info = $Job->create($this->_post(),1)){
			$Job->pub_oid = session("oid");
			$Job->ctime = time();
			//当选择过期时间为”长期“时，默认为一个月
			$expire_time = $this->_post('expire_time');;
			if($this->_post('expire_time') == '8'){
				$expire_time = 30; 
			}
			//将过期日期转换为时间戳
			$Job->expire_time = $Job->ctime + $expire_time*3600*24;
			$Job->begin_time  = strtotime($Job->begin_time);
			if($Job->add()){
				$this->ajaxReturn(0,"发布成功",1);
			}else{
				$this->ajaxReturn(1,"发布失败",1);
			}
			
		}else{
			$this->ajaxReturn(2,$Job->getError(),1);
		}
	}
	protected function showMolds(){
		$Mold = M('Mold');
		$arr2 = $Mold->field("mid,name")->where("")->select();
		if($arr2) {
			$this->assign("molds",$arr2);
		}else{
			
		}
	}
}
?>