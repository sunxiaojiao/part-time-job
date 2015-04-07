<?php
class PublishJobsAction extends Action{
	public function index(){
		//获取当前用户
		if(!session("?oid")){
			//未登录，抛出跳转页面
			$this->redirect('Login/index','',2,'未登录，页面跳转中。。');
		}
		$this->display();
	}
	public function publish(){
		$Job = D('Jobs');
		//创建并插入数据
		if($info = $Job->create()){
			$Job->pub_oid = session("oid");
			//
			$Job->ctime = time();
			$Job->expire_time = $Job->ctime + $this->_post('expire_time')*24*60*60;
			if($Job->add()){
				$this->ajaxReturn(1,"发布成功",1);
			}else{
				dump($info);
				echo $Job->getLastSql();
				$this->ajaxReturn(0,"发布失败",0);
			}
			
		}else{
			$this->ajaxReturn(0,$Job->getError(),0);
		}
	}
}
?>