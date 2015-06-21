<?php
/**
 * 分类检索
 */
class SortSearchAction extends Action{
	protected $all_fields = array(
							'style'   =>  '类型',
							'wage'    =>  '工资',
							'address' =>  '地点',
							'isvld'   =>  '公司验证',
							'peonum'  =>  '需求人数',
							'wt'      =>  '工作时长',
							'time'    =>  '工作时间段',
							'py'      =>  '付款方式',
							); 
	public function index() {
		$this->showMolds();
		$this->showAddress();
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
	 * @param py      付款方式
	 * @param time    时间段
	 */
	public function search() {
		C('URL_MODEL',0);
		$this->showMolds();
		$this->showAddress();
		$this->showRouteNav();
		//生成选项的URL
		$nurl = __SELF__;//取得当前的URL
		foreach($this->all_fields as $key=>$value){
			$the_url = "";
			if(strpos($nurl, $key)){
				$the_url = preg_replace("/&$key=.*?&/", '&', $nurl);//在url中间
				if($nurl == $the_url){
					$the_url = preg_replace("/&$key=.*$/", '', $nurl);//在url末尾
				}
				$the_url = preg_replace("/&p=\d*$/",  '', $the_url);
				$the_url = preg_replace("/&p=\d*&/", '&', $the_url);
			}else{
				$the_url = $nurl;
			}
			//模板赋值
			$this->assign("now_url_".$key,$the_url);
		}
		//生成GET请求的数组
		//$filter = "";
		$arr_get = array();
		foreach ($_GET as $key => $value){
			//因为thinkphp中$_GET中存在_URL_
			if($key == '_URL_'){
				continue;
			}
			
			//检测sqlInjection
			$value = check_sql_inject($value);
			$arr_get[$key] = $value;
		}
		//转换范围为相应字段
		$city_str = '';
		if($arr_get['address']){
			$Address  = M('Address');
			$city_str = $Address->field('city')->find($arr_get['address']);	
		}
		
		//xm_jobs表中搜索
		$Job = M('jobs');
		$Job->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		$where = "(" . time() . "- expire_time)<0" . " AND " . "is_pass=0" 	. " AND "			 .
				$this->strongWhere($arr_get['style'],"mold_id","AND")          .
				$this->strongWhere($arr_get['wage'],"money","AND",'',":")      .
				$this->strongWhere($city_str['city'],"city","AND")             .
				$this->strongWhere($arr_get['peonum'],"want_peo","AND",'',':') .
				$this->strongWhere($arr_get['py'], 'pay_way', 'AND')           .
				$this->strongWhere($arr_get['wt'],"work_time","AND",'',":")    .
				$this->strongWhere($arr_get['time'],"begin_time","AND",'',":") . "1=1";
		$field = "xm_jobs.title AS title,
				  xm_jobs.address AS address,
				  xm_jobs.jid AS jid,
				  xm_jobs.want_peo AS want_peo,
				  xm_jobs.current_peo AS current_peo,
				  xm_jobs.money,
				  money_style,
				  xm_mold.name AS moldname,
				  xm_jobs.begin_time AS begin_time,
				  xm_jobs.work_time AS wktime,
				  xm_jobs.pv AS pv,
				  addressname";
		$join  = "INNER JOIN `xm_orgs` ON xm_orgs.oid=xm_jobs.pub_oid" . $this->strongWhere($arr_get['isvld'], 'xm_orgs.is_validate', 'AND', true);
		$join_mold = "LEFT JOIN `xm_mold` ON xm_mold.mid = xm_jobs.mold_id";
		import('ORG.Util.Page');
		$count = $Job->where($where)->join($join)->count();
		$Page  = new Page($count,15);
		$show  = $Page->show();
		$this->assign("page",$show);
		$arr2 = $Job->field($field)
					->join($join)
					->join($join_mold)
					->limit($Page->firstRow.','.$Page->listRows)
					->where($where)
					->select();
		//dump($Job->getLastSql());
		if($arr2){
			$this->assign("job_list",$arr2);
		}elseif(is_null($arr2)){
			$this->assign("error_info","没有符合要求的结果");
		}else{
			$this->assign("error_info","检索出错");
		}
		$this->display('index');
	}
	//页面中显示工作类型
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
	//页面中显示地区
	protected function showAddress() {
		$Address      = M('Address');
		$where        = "";
		$field        = "aid,city";
		$arr2_address = $Address->where($where)->field($field)->select();
		if($arr2_address){
			$this->assign("address",$arr2_address);
		}else{
			$this->assign("address",array('area'=>'抱歉，出了点小差错。请刷新一下，若不行，联系一下管理员。。'));
		}
	}
	//查询兼职类型，生成一个数组
	protected function getMolds() {
		$Mold = M('Mold');
		$arr2 = $Mold->field("mid,name")->where("")->select();
		if($arr2){
			return array_2dTo1d($arr2,'mid');
		}
	}
	//查询地址
	protected function getAddress() {
		$Address = M('Address');
		$arr2 = $Address->field('aid,city')->select();
		if($arr2){
			return array_2dTo1d($arr2, 'aid');
		}
	}
	
	//显示面包屑导航
	protected function showRouteNav() {
		//当url中没有请求分类筛选时，停止
		$url = __SELF__;
		//例：将类似style=2这种形式提取出来
		$arr = split("&", $url);
		if(count($arr) == 1){
			return ;
		}

		$arr_molds   = $this->getMolds();
		$arr_address = $this->getAddress();
		$arr_nav_route =array();//存放输出到模板的字符串
		foreach($arr as $value){
			$value_arr = split("=",$value);
			if(array_key_exists($value_arr[0],$this->all_fields)){
				//处理，转换
				//类型
				if($value_arr[0] == 'style'){
					$value_arr[1] = $arr_molds[$value_arr[1]-1];
				}
				//地址
				if($value_arr[0] == 'address'){
					$value_arr[1] = $arr_address[$value_arr[1]-1];
				}
				//工资
				if($value_arr[0] == 'wage'){
					$value_arr[1] = str_replace(':','-',$value_arr[1]);
				}
				//付款方式
				if($value_arr[0] == 'py'){
					switch($value_arr[1]){
						case 1:
							$value_arr[1] = '支付宝';
							break;
						case 2:
							$value_arr[1] = '银行卡';
							break;
						case 3:
							$value_arr[1] = '现金';
							break;
					}
				}
				//认证
				if($value_arr[0] == 'isvld'){
					$value_arr[1] = $value_arr[1]==1 ? "已认证" : "未认证" ;
				}
				//人数
				if($value_arr[0] == 'peonum'){
					$value_arr[1] = str_replace(':','-',$value_arr[1]);
				}
				//工作时长
				if($value_arr[0] == 'wt'){
					$value_arr[1] = str_replace(':','-',$value_arr[1]);
					$value_arr[1] .= "小时";
				}
				//工作时间段
				if($value_arr[0] == 'time'){
					$value_arr[1] = str_replace(':','点-',$value_arr[1]);
					$value_arr[1] .= "点";
				}
				
				if(strpos($value_arr[1],'-max') !== false){
					 $value_arr[1] = str_replace('-max', "以上",$value_arr[1]);
				}
				if(strpos($value_arr[1], 'min-') !== false){
					$value_arr[1] = str_replace('min-', "少于", $value_arr[1]);
				}
				
				//设置url
				$changed_url = preg_replace("/&$value_arr[0]=.*?&/",'&',__SELF__);//中间
				$changed_url = preg_replace("/&$value_arr[0]=.*$/",'',$changed_url);//末尾
				//存入二维数组，array(array('show'=>'','url'=>''),...
				$show = $this->all_fields[$value_arr[0]] . "：" . $value_arr[1];
				$arr_nav_route[] = array('show'=>$show,'url'=>$changed_url);
			}
		}
		$this->assign("nav_route",$arr_nav_route);
		
		
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
		//若$variable === '' 直接返回空字符，结束函数
		if($variable ==''){
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