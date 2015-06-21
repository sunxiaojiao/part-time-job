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
		//设置城市
		if(!session('?city')){
			session('city','烟台市');
		}
		//自动登录
		$this->autoLogin();
		//设置分类排序
		$order_flag = $this->_get('sort');
		$order = "ctime desc";
		$order_flag_first_num = substr($order_flag,0,1);
		$order_flag_last_num  = substr($order_flag,1,1);
		$arr_sort = array('ctime'=>10,'address'=>20,'money'=>30,'pv'=>40);
		switch ($order_flag_first_num){
			case 1:
				$order = 'ctime';
				break;
			case 2:
				$order = 'address';
				break;
			case 3:
				$order = 'money';
				break;
			case 4:
				$order = 'pv';
				break;
			default:
				 
		}
		if(substr($order_flag,1,1) == 1){
			$order .= ' desc';
		}
		if($order_flag_last_num == 1){
			$arr_sort[$order] = $order_flag_first_num . 0;
		}elseif($order_flag_last_num == 0){
			$arr_sort[$order] = $order_flag_first_num . 1;
		}
		
		$this->assign("arr_sort",$arr_sort);

		$Jobs = M('Jobs');
		//获取当前城市
		$city = session('?city') ? session('city') : '烟台市';

		$Jobs->query("SET sql_mode = 'NO_UNSIGNED_SUBTRACTION'");
		import('ORG.Util.Page');
		//限制显示未过期的，通过的，当前城市的兼职
		$where = "(" . time() . "- expire_time)<0" . " AND " . "is_pass=0" . " AND " . "city=" . "'".$city."'";
		$count = $Jobs->where($where)->count();
		$Page  = new Page($count,10);
		$list  = $Jobs->order('pv desc')->order($order/*.","."ctime desc"*/)
		->limit($Page->firstRow.','.$Page->listRows)
		->field("jid,title,money,money_style,want_peo,current_peo,addressname,pv,ctime")
		->where($where)
		->select();
		//设置分页样式
		//		$Page->setConfig('header','条');
		//		$Page->setConfig('prev', '&laquo;');
		//		$Page->setConfig('next', '&raquo;');
		$show = $Page->show();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();

	}
	protected function autoLogin() {
		//判断客户端是否设置了cookie
		if(cookie('userphone') && cookie('utype') && cookie('xmf')){
			$phone  = cookie('userphone');
			$passwd = cookie('xmf');
			$arr;
			//判断
			if(cookie('utype') == 'user'){
				$User = M('Users');
				$arr = $User->where('phone=' . $phone)->field('passwd,uid,username')->find();
				if($passwd == md5($arr['passwd'] . 'xiaomifeng')){
					session('oid',null);
					session('orgname',null);
					session('uid',$arr['uid']);
					session('username',$arr['username']);
				}
			}elseif(cookie('utype') == 'org'){
				$Org = M('Orgs');
				$arr = $Org->where('login_phone=' . $phone)->field('passwd,oid,orgname')->find();
				if($passwd == md5($arr['passwd'] . 'xiaomifeng')){
					session('oid',$arr['oid']);
					session('orgname',$arr['orgname']);
					session('uid',null);
					session('username',null);
				}
				
			}
			
		}
	}
}
?>