<?php
class JobsInfoAction extends Action{
	private $jid;
	public function index(){
		$this->assignIt();
		session("jid",$this->jid);
		$this->display();
	}
	/**
	 * 读取数据
	 * @return integer 0：查询错误  1：无记录  3：用户未登录
	 * @return $list：查询成功返回数组
	 */
	private function read(){
		$this->jid =  $this->_get('jid');
		$Users = M('Jobs');
		$list = $Users->where("jid=".$this->jid)->limit(1)->select();
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
	 * @param 
	 */
	private function assignIt(){	
		if($arr = $this->read()){
			foreach ($arr as $key=>$value){
				$this->assign($key,$value);
			}
		}
	}
}
?>