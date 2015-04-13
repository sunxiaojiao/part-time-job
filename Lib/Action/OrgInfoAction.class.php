<?php
class OrgInfoAction extends Action{
	private $oid;
	public function index(){
			//检测用户登录
//		if(empty(session('oid'))){
//			return 3;
//		}else{
//			$this->oid = session('oid');
//		}
		$this->assignIt();
		$this->display();
	}
	/**
	 * 读取数据
	 * @return integer 0：查询错误  1：无记录  3：用户未登录
	 * @return $list：查询成功返回数组
	 */
	private function read(){
		$this->oid = $this->_get('oid');
		$Users = M('Orgs');
		$list = $Users->where("oid=".$this->oid)->limit(1)->select();
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
	 */
	private function assignIt(){
		if($arr = $this->read()){
			foreach ($arr as $key=>$value){
				$this->assign($key,$value);
			}
		}
		dump($arr);
	}
}
?>