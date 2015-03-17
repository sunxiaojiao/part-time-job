<?php
/**
 * IndexAction
 * 首页 获取mx_jobs表中的兼职列表
 *
 */
class IndexAction extends Action{
    
    public function index(){
    	$Jobs = M('Jobs');
		$arr_jobs=$Jobs->select();
		if(!$arr_jobs){
			exit("数据库连接错误");
		}else{
			$this->assign('arr_job',$arr_jobs);
		}
		
    	$this->display();
    }
}
?>