<?php
class UserInfoAction extends Action{
	private $uid;
	private $Model;
	
	public function index(){
		$this->assignIt();
		$this->display();
	}
	/**
	 * 读取数据
	 * @return integer 0：查询错误  1：无记录  3：用户未登录
	 * @return $list：查询成功返回数组
	 */
	private function read(){
		//检测用户登录
		if(!session("?uid")){
			return 3;
		}else{
			$this->uid = session('uid');
		}
		$Users = M('Users');
		$list = $Users->where("uid=".$this->uid)->limit(1)->select();
		if($list){
			if(is_null($list)){
				//无记录
				return 1;
			}else{
				return $list[0];
			}
		}else{
			return 0;
		}
	}
	/**
	 * 模板赋值
	 * @param string $username
	 * @param string $sex
	 * @param integer $age
	 * @param string $city
	 * @param string $school
	 * @param string $intent
	 * @param string $exp
	 * @param string $phone
	 * @param string $qq
	 * @param string $email
	 */
	private function assignIt(){
		
		if($arr = $this->read()){
			foreach ($arr as $key=>$value){
				$this->assign($key,$value);
			}
			$sex = $sex == null ? '保密' : $sex == 1 ? '男' : '女';
			$this->assign('sex',$sex);
		}
	}
	
}
?>