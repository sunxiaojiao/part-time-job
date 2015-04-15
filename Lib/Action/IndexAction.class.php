<?php
/**
 * IndexAction
 * 首页 获取mx_jobs表中的兼职列表
 *
 */
class IndexAction extends Action{
    /**
     * 
     * 默认30分钟内添加的显示 NEW 徽章	
     */
    public function index(){
    	$Jobs = M('Jobs');
    	$Jobs->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
    	import('ORG.Util.Page');
    	$where = "(" . time() . "- expire_time)<0" . " AND " . "is_pass=1";
    	$count = $Jobs->where($where)->count();
    	$Page  = new Page($count,10);
		$list  = $Jobs->order('ctime desc')
					->limit($Page->firstRow.','.$Page->listRows)
					->field("jid,title,money,want_peo,current_peo,address,pv,ctime")
					->where($where)
					->select();
		//设置分页样式
//		$Page->setConfig('header','条');
//		$Page->setConfig('prev', '&laquo;');
//		$Page->setConfig('next', '&raquo;');
		$show = $Page->show();
		$this->assign('list',$list);
		$this->assign('page',$show);
		//dump($Jobs->getLastSql());
		$this->display();
		
    }
}
?>