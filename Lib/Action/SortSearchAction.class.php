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
		$all_fields = array('style','wage','address','isvld','peonum','wt','time');
		$this->showMolds();
		$this->showAddress();
		//设置标签URL
		$nurl = __SELF__;
		dump($nurl);
		foreach($all_fields as $value){
			$the_url = "";
			if(strpos($nurl, $value)){
				$the_url = preg_replace("/&$value=.*&/", '&', $nurl);//在url中间
				if($nurl == $the_url){
					$the_url = preg_replace("/&$value=.*$/", '', $nurl);//在url末尾
				}
				dump("/&$value=.*?&/");
				dump($the_url);
			}else{
				$the_url = $nurl;
			}
			$this->assign("now_url_".$value,$the_url);
		}
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
		//转换范围为相应字段

		//xm_jobs表中搜索
		$Job = M('jobs');
		$Job->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		$where = //"(" . time() . "- expire_time)<0" . " AND " . "is_pass=0" 	. " AND "			 .
		/*"mold_id="     .*/ $this->strongWhere($arr_get['style'],"mold_id","AND")   .
		/*"money="       .*/ $this->strongWhere($arr_get['wage'],"money","AND",'',":")      .
		/*"address="     .*/ $this->strongWhere($arr_get['address'],"address","AND") .
		//				 /*"isvalidate="  .*/ $this->strongWhere($arr_get['isvld'])   . " AND "       .
		/*"want_peo="    .*/ $this->strongWhere($arr_get['peonum'],"want_peo","AND",'',':') .
		/*"work_time="   .*/ $this->strongWhere($arr_get['wt'],"work_time","AND",'',":")    .
		/*"begin_time="  .*/ $this->strongWhere($arr_get['time'],"begin_time","AND",'',":") . "1=1";
		dump($where);
		$field = "xm_jobs.title AS title";
		$join  = "INNER JOIN `xm_orgs` ON xm_orgs.oid=xm_jobs.pub_oid" . $this->strongWhere($arr_get['isvld'], 'xm_orgs.is_validate', 'AND', true);
		import('ORG.Util.Page');
		$count = $Job->where($where)->join($join)->count();
		$Page  = new Page($count,20);
		$show  = $Page->show();
		$this->assign("page",$show);
		$arr2 = $Job->field($field)
					->join($join)
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
	 * @param $location 除true，其他值都会令其变为false，默认为false; ture在前面加空格和逻辑运算符，false在后面空格和逻辑运算符
	 * @param $betweenAnd 将传入值$variable分割，使用between and
	 */
	protected function strongWhere($variable,$field,$operator,$location,$betweenAnd) {
		//若$variable === null 直接返回空字符，结束函数
		if(is_null($variable)){
			return '';
		}
		if($operator != 'AND' && $operator != 'OR'){
			$operator = '';
		}
		if($location !== false && $location !== true){
			$location = false;
		}
		if($betweenAnd){
			$arr = explode($betweenAnd, $variable);
			dump($arr);
			if($location){
				if($arr[1] == 'max'){
					return " " . $operator . " " . $field . " > " . $arr[0];
				}
				if($arr[0] == 'min'){
					return " " . $operator . " " . $field . " < " . $arr[1];
				}
				return " " . $operator . " " . $field . " BETWEEN " . $arr[0] . " AND " . $arr[1];
			}else{
				if($arr[1] == 'max'){
					return  $field . " > " . $arr[0] . " " .$operator . " ";
				}
				if($arr[0] == 'min'){
					return  $field . " < " . $arr[1] . " " .$operator . " ";
				}
				return  $field . " BETWEEN " . $arr[0] . " AND " . $arr[1] . " " .$operator . " ";
			}
		}
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
?>