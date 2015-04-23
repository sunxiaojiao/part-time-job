<?php
/**
 * 分类检索
 */
class SortSearchAction extends Action{
	public function index() {
		dump($this->isNullThenNull(123, "test","AND"));
		$this->showMolds();
		$this->showAddress();
//		$this->assign("list",$arr2);
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
	public function search() {
		$this->showMolds();
		$this->showAddress();
		//获取get
		$filter = "";
		$arr_get;
		foreach ($_GET as $key => $value){
			//因为thinkphp中$_GET中存在_URL_
			if($key == '_URL_'){
				continue;
			}
			$arr_get[$key] = $this->_get($key,$filter);
		}
		//转换相应字段
		
		//xm_jobs表中搜索
		$Job = M('jobs');
		$Job->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		$where = //"(" . time() . "- expire_time)<0" . " AND " . "is_pass=0" 	. " AND "			 .
				 /*"mold_id="     .*/ $this->isNullThenNull($arr_get['style'],"mold_id","AND")   .
				 /*"money="       .*/ $this->isNullThenNull($arr_get['wage'],"money","AND")      .
				 /*"address="     .*/ $this->isNullThenNull($arr_get['address'],"address","AND") .
//				 /*"isvalidate="  .*/ $this->isNullThenNull($arr_get['isvld'])   . " AND "       .
				 /*"want_peo="    .*/ $this->isNullThenNull($arr_get['peonum'],"want_peo","AND") .
				 /*"work_time="   .*/ $this->isNullThenNull($arr_get['wt'],"work_time","AND")    .
				 /*"begin_time="  .*/ $this->isNullThenNull($arr_get['time'],"begin_time");
		dump($where);
		$field = "";
		import('ORG.Util.Page');
		$count = $Job->where($where)->count();
		$Page  = new Page($count,2);
		$show = $Page->show();
		$this->assign("page",$show);
		$arr2 = $Job->field($field)
					->limit($Page->firstRow.','.$Page->listRows)
					->where($where)
					->select();
		if($arr2){
			$this->assign("job_list",$arr2);
		}elseif(is_null($arr2)){
			$this->assign("error_info","没有符合要求的结果".$Job->getLastSql());
		}else{
			$this->assign("error_info","检索出错".$Job->getLastSql());
		}
		$this->display('index');
	}
	protected function showMolds() {
		$Mold = M('mold');
		$field = "mid ,name";
		$arr2_molds = $Mold->field($field)->select();
		if($arr2_molds){
			$this->assign("molds",$arr2_molds);
		}else{
			//报错
		}
	}
	protected function showAddress() {
		$Address      = M('address');
		$where        = "";
		$field        = "aid,area";
		$arr2_address = $Address->where($where)->field($field)->select();
		if($arr2_address){
			$this->assign("address",$arr2_address);
		}else{
			$this->assign("address",array('area'=>'抱歉，出了点小差错。请刷新一下，若不行，联系一下管理员。。'));
		}
	}
	protected function showAllJob() {
		
	}
	/**
	 * 
	 * 生成SQL中where子句。当$variable === null 时，其余传入值都为空
	 * @param $variable
	 * @param $field
	 * @param $operator
	 * @param $location 除true，其他值都会令其变为false
	 */
	protected function isNullThenNull($variable,$field,$operator,$location) {
		if($operator != 'AND' && $operator != 'OR'){
			$operator = '';
		}
		if($location !== false && $location !== true){
			$location = false;
		}
		if(is_null($variable)){
				return '';
		}else{
			if(is_numeric($variable)){
				if($location){
					return " " . $operator . " " . $field . "=" . $variable;
				}else{
					return  $field . "=" . $variable . " " .$operator . " ";
				}
			}else{
				if($location){
					return " " . $operator . " " . $field . "=" . "'" .$variable ."'";
				}else{
					return $field . "=" . "'" .$variable ."'" . " " . $operator . " ";
				}
			}
		}
	}
}
?>