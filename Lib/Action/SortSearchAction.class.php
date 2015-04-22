<?php
/**
 * 分类检索
 */
class SortSearchAction extends Action{
	public function index() {
		$arr2 = $this->sortSearch();
		$this->assign("list",$arr2);
		$this->display();
	}
	/**
	 *
	 * @param style   兼职类型
	 * @param wage    工资
	 * @param address 地点
	 * @param isvld   认证
	 * @param peonum  人数
	 * @param wt 	     工作时间长
	 * @param time    时间段
	 */
	protected function sortSearch() {
		//获取get
		dump($this->_get());
		foreach($this->_get() as $key=>$value){
			
		}
		//转换相应字段
		//xm_jobs表中搜索
		$Job = M('jobs');
		$where = "";
		$field = "";
		$arr2 = $Job->field($field)
			->where($where)
			->select();
	}
}
?>