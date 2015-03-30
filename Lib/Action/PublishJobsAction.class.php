<?php
class PublishJobsAction extends Action{
	private $org;
	private $oid;
	public function index(){
		//获取当前用户
		if(!$this->getOid()){
			//未登录，抛出跳转页面
			$this->redirect('Login/index','',2,'未登录，页面跳转中。。');
		}
		$this->display();
	}
	public  function insert(){
		$this->oid=1;
		$Job = D('Jobs');
		//
		if($info = $Job->create()){
			$Job->pub_oid = $this->oid;
			if($Job->add()){
				$this->ajaxReturn(1,"发布成功",1);
			}else{
				$this->ajaxReturn(0,"发布失败",0);
			}
			//dump($info);
		}else{
			$this->ajaxReturn(0,$Job->getError(),0);
		}
	}
	private function getOid(){
		if(!session('?oid')){
			return 0;
		}
		if(empty($this->oid)){
			$this->oid = session('oid');
			return $this->oid;
		}else{
			return $this->oid;
		}
	}
}
?>