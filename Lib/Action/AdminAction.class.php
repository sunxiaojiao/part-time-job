<?php
class AdminAction extends Action {
	public function index() {
		//session('admin_id',1);
		//检查用户登录
		$this->isLogined();
		$this->showStatistics();
		$this->display();
		
	}
	
	//判断是否登录
	protected function isLogined(){
		if(!session('?admin_id')) {
			$this->error("未登录",U('Index/index'));
			exit();
		}
	}
	
	//登录页面
	public function login() {
		$this->display();
	}

	//登录处理
	public function loginHandler() {
		if(!$this->isPost()){
			return;
		}
		$username = $this->_post('username');
		$passwd = $this->_post('passwd');
		$Admin = M('Admin');
		$where = "username=" . "'" . $username. "'" . " AND " . "passwd=" . "'" . md5($passwd) . "'";
		$field = "admin_id";
		$arr1_data = $Admin->where($where)->field($field)->find();
		if($arr1_data){
			session('username',$username);
			session('admin_id',$arr1_data['admin_id']);
			$this->ajaxReturn(1,"登录成功",1);
		}else{
			$this->ajaxReturn(0,"登录失败",0);
		}
	}
	//数据统计
	public function showStatistics(){
		$this->isLogined();
		$stat = array();
		//今天的时间戳
		$today = date('Ymd');
//		dump($today);
		$todayUp   = strtotime($today);
		$todayDown = (int)strtotime($today)+3600*24-1;
		$todayTimestamp = array(
							'up'    => $toudayUp,
							'down'  => $todayDown
							);
							
		//普通用户
		$User = M('Users');
		$stat['userTotal'] = $User->count('uid');
		$stat['userToday'] = $User->where("ctime BETWEEN $todayUp AND $todayDown")->count('uid');
		//企业用户
		$Org = M('Orgs');
		$stat['orgTotal'] = $Org->count('oid');
		$stat['orgToday'] = $Org->where("ctime BETWEEN $todayUp AND $todayDown")->count('oid');
		$this->assign($stat);
		//$this->display('index');
	}
	//显示消息
	public function showMessage() {
		$this->isLogined();
		$this->display();
	}
	//列出认证申请列表
	public function authApply() {
		$this->isLogined();
		$Model = M('OrgsAuth');
		$where = "is_pass = 3";
		$field = "xm_orgs.oid AS oid,xm_orgs.orgname AS orgname";
		$join  = "INNER JOIN `xm_orgs` ON xm_orgs.oid = xm_orgs_auth.auth_oid";
		$order = "xm_orgs.ctime";
		$num   = 15;
		$data_list  = "orgsauth_list";
		$show_list  = "orgsauth_page";
		$error_info = "orgsauth_error";
		$this->pagingList($Model, $num, $where, $field, $data_list, $show_list, $error_info, $join,$order);
		$this->display();
	}
	//列出申请认证公司资料
	public function authDetail() {
		$this->isLogined();
		
		$oid = $this->_get('oid');
		$Org   = M('OrgsAuth');
		$where = "auth_oid=" . $oid;
		$field = "xm_orgs_auth.auth_oid,email,orgname,license_num,idcard_img1,idcard_img2,license_img,idcard_num,industry,nature,size,contact,org_address,xm_orgs_auth.phone,fixed_phone,org_intro,xm_orgs_auth.ctime";
		$join  = "INNER JOIN xm_orgs ON xm_orgs.oid = xm_orgs_auth.auth_oid";
		$arr2_data = $Org->join($join)->where($where)->field($field)->find();
		if($arr2_data){
			$this->assign($arr2_data);
		}elseif(is_null($arr2_data)){
			$this->assign("error_info","无记录");
		}else{
			$this->assign("error_info","读取错误");
		}
		$this->display();
	}
	
	//处理认证申请
	public function authHandler() {
		$this->isLogined();
		
		//接收参数
		$is_pass = 0;
		$is_validate = 0;
		if($this->_post('pass') == 'yes') {//通过
			$is_pass = 1;
			$is_validate = 1;
		}elseif ($this->_post('pass') == 'no'){//拒绝
			$is_pass = 2;
			$is_validate = 0;
		}
		//xm_orgsauth 修改is_pass
		$OrgAuth = M('OrgsAuth');
		$where1 = "auth_oid=" . $this->_post('oid');
		$f_1 = $OrgAuth->where($where1)->setField("is_pass",$is_pass);
		if(!$f_1 && $f_1 !== 0){
			echo $OrgAuth->getLastSql();
			$this->ajaxReturn(1,"操作失败",0);
			return;
		}
		//xm_orgs 修改 is_validate
		$Org = M('Orgs');
		$where = "oid=" . $this->_post('oid');
		$f = $Org->where($where)->setField("is_validate",$is_validate);
		if($f || $f === 0) {
			$this->ajaxReturn(2,"操作成功",1);
		}else{
			$this->ajaxReturn(2,"操作失败",0);
		}
	}
	
	//列出投诉建议
	public function showAdvice() {
		$this->isLogined();
		
		$Model = M('Advice');
		$field  = "advice_id,content,uid,oid,ctime";
		$where  = "";
		$num    = 15;
		$data_list = 'advice_info';
		$show_list = 'advice_page';
		$error_info = 'error_advice_info';

		$this->pagingList($Model, $num, $where, $field, $data_list, $show_list, $error_info);
		$this->display();
	}
	//投诉建议详细
	public function adviceDetail() {
		//判断登录
		$this->isLogined();
		
		$advice_id = $this->_get('ai');
		$Advice = M('Advice');
		$field  = "content,xm_advice.uid,xm_advice.oid,xm_advice.ctime,username,orgname";
		$join1  = "LEFT JOIN xm_users ON xm_users.uid = xm_advice.uid";
		$join2  = "LEFT JOIN xm_orgs ON xm_orgs.oid = xm_advice.oid"; 
		$where  = "advice_id=" . $advice_id;
		$arr1   = $Advice->field($field)->join($join1)->join($join2)->where($where)->find();
		if($arr1){
			$this->assign('advice_info',$arr1);
		}else{
			$this->assign('error_advice_info','错误');
		}
		$this->display('adviceDetail');
	}
	//列出兼职发布申请列表
	public function publishApply() {
		$this->isLogined();
		
		$Model = M('Jobs');
		$where = "(" . time() . "- expire_time)<0" . " AND " . "is_pass=0";
		$num = 15;
		$field = "jid,title,from_unixtime(ctime) AS ctime";
		$data_list  = "jobs_list";
		$show_list  = "jobs_page";
		$error_info = "jobs_error";
		$this->pagingList($Model, $num, $where, $field, $data_list, $show_list,$error_info);
		$this->display();
	}
	//处理兼职申请列表
	public function jobHandler() {
		$this->isLogined();
		
		$Job = M('Jobs');
		if(!$this->isPost()){
			return ;
		}
		$value = 0;
		if($this->_post('pass') == 'yes'){
			$value = 1;
		}elseif($this->_post('pass') == 'no'){
			$value = 2;
		}
		$where = "jid=".$this->_post('jid');
		if($Job->where($where)->setField("is_pass",$value)){
			$this->ajaxReturn(1,"操作成功",1);
		}else{
			$this->ajaxReturn(0,"操作失败",0);
		}
		
	}
	//删除任意兼职
	public function deleteJob() {
		$this->isLogined();
		
	}
	//现有公司列表
	public function orgsList() {
		$this->isLogined();
		
		$Orgs  = M('Orgs');
		$field = "oid,orgname,from_unixtime(ctime,'%y/%m/%d') AS ctime,is_validate";
		$num        = 15;
		$data_list  = "orgs_list";
		$show_list  = "orgs_page";
		$where      = "";
		$error_info = "orgs_error";
		$this->pagingList($Orgs, $num, $where, $field, $data_list, $show_list,$error_info);
		$this->display();
	}
	//删除公司
	public function deleteOrg() {
		$this->isLogined();
	}
	//记录上一次登录的时间和IP
	protected function lastRecord() {
		$this->isLogined();
	}
	//注销
	public function logout() {
		session('admin_id',null);
		$this->error("注销成功",U('Admin/login'),1);
		
	}
	//管理城市--显示城市
	public function showNowCity() {
		$this->isLogined();
		$Address = M('Address');
		$where = "";
		$field = "aid,province,city,ctime";
		$arr2  = $Address->where($where)->field($field)->select();
		if($arr2){
			$this->assign('address_info',$arr2);
		}elseif(is_null($arr2)){
			$this->assign('address_error_info','暂无业务城市');
		}else{
			$this->assign('address_error_info','读取错误');	
		}
		$this->display();
	}
	//管理城市--处理
	public function cityHandler() {
		$this->isLogined();
		$Address = M('Address');
		//删除
		if($this->_post('aid')){
			if($Address->delete($this->_post('aid'))){
				$this->ajaxReturn(1,'删除成功',1);	
			}else{
				$this->ajaxReturn(0,'删除失败',1);
			}
		}elseif($this->_post('province') && $this->_post('city')){	//添加
			$province = $this->_post('province');
			$city     = $this->_post('city');
			$Address  = M('Address');
			//检测是否存在
			$f = $Address->field('aid')->where("province='{$province}' AND city='{$city}'")->find();
//			dump($f);
			if($f){
				$this->ajaxReturn(1,'当前城市已经存在',1);
				return ;
			}
			//添加到表
			$data_address  = array('province'=>$province,'city'=>$city,'ctime'=>time());
			if($Address->add($data_address)){
				$this->ajaxReturn(1,'添加成功',1);
			}else{
				$this->ajaxReturn(0,'添加失败',1);
			}	
		}else{
			$this->ajaxReturn(1,'error',1);
		}
		
		//没有修改	
	}
	//管理兼职类型-显示
	public function showMolds() {
		$Model       = M('Mold');
		$num         = 15;
		$where       = '';
		$field       = 'mid,name';
		$data_list   = 'mold_info';
		$show_list   = 'mold_page';
		$error_info  = 'mold_error_info';
		$this->pagingList($Model, $num, $where, $field, $data_list, $show_list, $error_info, $join, $order);
		$this->show();
	}
	//管理兼职类型-管理
	public function moldsHandler() {
		$mid   = $this->_post('mid');
		$name  = $this->_post('mold_name');
		//dump($name);
		$Mold = M('Mold');
		
		if($name){
			//添加
			$data = array('name'=>$name);
			if($Mold->add($data)){
				$this->ajaxReturn(1,'添加成功',1);
			}else{
				$this->ajaxReturn(1,'添加失败',1);
			}				
		}else{
			//删除
			if(!is_numeric($mid)){
				return;
			}
			
			if($Mold->delete($mid)){
				$this->ajaxReturn(1,'删除成功',1);
			}else{
				$this->ajaxReturn(1,'删除失败',1);
			}
		}

	}
	/**
	 * 
	 * 分页方法
	 * @param $Model 数据库对象
	 * @param $num 每页的数据条数
	 * @param $where 选择数据的条件
	 * @param $field 选择的字段
	 * @param $data_list 模板中数据集的变量名
	 * @param $show_list 模板中分类的变量名
	 * @param $error_info 读取失败或结果为空时的模板变量
	 * $param $join 
	 */
	protected function pagingList(Model $Model,$num,$where,$field,$data_list,$show_list,$error_info,$join,$order) {
		if(empty($order)){
			//$order="ctime";
		}
		import('ORG.Util.Page');
		$count      = $Model->where($where)->count();
		$Page       = new Page($count,$num);
		$show       = $Page->show();
		$Model->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		$list = $Model->where($where)
					  ->field($field)
					  ->order($order)
					  ->join($join)
					  ->limit($Page->firstRow.','.$Page->listRows)
					  ->select();
		//
		$Page->setConfig("", $value);
		if($list){
			//dump($list);
			//dump($show);
			//dump($Model->getLastSql());
			$this->assign($data_list,$list);// 赋值数据集
			$this->assign($show_list,$show);// 赋值分页输出
		}elseif(is_null($list)) {
			//dump($Model->getLastSql());
			$this->assign($error_info,"记录为空！");
		}else{
			//dump($Model->getLastSql());
			$this->assign($error_info,"读取错误！");
		}			  
	
	}
}
?>