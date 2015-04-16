<?php
class AdminAction extends Action {
	public function index() {
		//session('admin_id',1);
		//检查用户登录
		if(!session('?admin_id')) {
			$this->error("未登录",U('Index/index'));
			return;
		}
		$this->authApply();
		$this->orgsList();
		$this->publishApply();
		$this->display();
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
	//列出认证申请列表
	protected function authApply() {
		$Model = M('Orgsauth');
		$where = "is_pass = 1";
		$field = "xm_orgs.oid AS oid,xm_orgs.orgname AS orgname";
		$join  = "INNER JOIN `xm_orgs` ON xm_orgs.oid = xm_orgsauth.auth_oid";
		$order = "xm_orgs.ctime";
		$num   = 4;
		$data_list = "orgsauth_list";
		$show_list = "orgsauth_page";
		$error_info = "orgsauth_error";
		$this->pagingList($Model, $num, $where, $field, $data_list, $show_list, $error_info, $join,$order);
		
	}
	//处理认证申请列表
	public function authHandler() {
		//接受参数
		$is_pass = 0;
		$is_validate = 0;
		if($this->_post('pass') == 'yes') {//通过
			$is_pass = 2;
			$is_validate = 1;
		}elseif ($this->_post('pass') == 'no'){//拒绝
			$is_pass = 3;
			$is_validate = 0;
		}
		//xm_orgsauth 修改is_pass
		$OrgAuth = M('Orgsauth');
		$where1 = "auth_oid=" . $this->_post('oid');
		if(!$OrgAuth->where($where1)->setField("is_pass",$is_pass)){
			echo $OrgAuth->getLastSql();
			$this->ajaxReturn(1,"操作失败",0);
			return;
		}
		//xm_orgs 修改 is_validate
		$Org = M('orgs');
		$where = "oid=" . $this->_post('oid');
		if($Org->where($where)->setField("is_validate",$is_validate)) {
			$this->ajaxReturn(2,"操作成功",1);
		}else{
			$this->ajaxReturn(2,"操作失败",0);
		}
	}
	//列出兼职发布申请列表
	protected function publishApply() {
		$Model = M('jobs');
		$where = "(" . time() . "- expire_time)<0" . " AND " . "is_pass=0";
		$num = 10;
		$field = "jid,title,from_unixtime(ctime) AS ctime";
		$data_list  = "jobs_list";
		$show_list  = "jobs_page";
		$error_info = "jobs_error";
		$this->pagingList($Model, $num, $where, $field, $data_list, $show_list,$error_info);
		//dump($Model->getLastSql());
	}
	//处理兼职申请列表
	public function jobHandler() {
		$Job = M('jobs');
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
		
	}
	//现有公司列表
	public function orgsList() {
		$Orgs  = M('Orgs');
		$field = "oid,orgname,from_unixtime(ctime,'%y/%m/%d') AS ctime,is_validate";
		$num        = 4;
		$data_list  = "orgs_list";
		$show_list  = "orgs_page";
		$where      = "";
		$error_info = "orgs_error";
		$this->pagingList($Orgs, $num, $where, $field, $data_list, $show_list,$error_info);
	}
	//删除公司
	public function deleteOrg() {
		
	}
	//记录上一次登录的时间和IP
	protected function lastRecord() {
		
	}
	//注销
	public function logout() {
		session('admin_id',null);
		$this->error("注销成功",U('Admin/login'),1);
		
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
			$order="ctime";
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
				$this->assign($data_list,$list);// 赋值数据集
				$this->assign($show_list,$show);// 赋值分页输出
			}elseif(is_null($list)) {
				$this->assign($error_info,"记录为空！");
			}else{
				$this->assign($error_info,"读取错误！");
			}			  
	
	}
}
?>