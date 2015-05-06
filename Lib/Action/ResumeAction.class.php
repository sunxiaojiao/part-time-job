<?php
class ResumeAction extends Action{
	public function index() {
		$this->showInfo();
		$this->display();
	}
	protected function showInfo(){
		$Users = M('users');
		$Users->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		import('ORG.Util.Page');
		$where = "";
		$field = "uid,username,school,age,sex,ctime";
		$count = $Users->where($where)->count();
		$Page  = new Page($count,10);
		$arr2  = $Users->order('ctime')
					  ->limit($Page->firstRow.','.$Page->listRows)
					  ->field($field)
					  ->where($where)
					  ->select();
		//设置分页样式
		//		$Page->setConfig('header','条');
		//		$Page->setConfig('prev', '&laquo;');
		//		$Page->setConfig('next', '&raquo;');
		$show = $Page->show();
		$this->assign('user_info',$arr2);
		$this->assign('page',$show);
	}
}
?>