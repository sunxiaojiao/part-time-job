<?php
class JobsInfoAction extends Action{
	private $jid;
	public function index(){
		$this->assignIt();
		$this->recordClickNum();
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
		$Job = M('Jobs');
		$list = $Job->where("jid=".$this->jid)->find();
		if($list){
			if(is_null($list)){
				//无记录
				return 1;
			}else{
				return $list;
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
	protected function recordClickNum() {
		$Job    = M('jobs');
		$cookie = "hadclick";
//		$path   = __URL__."/".$this->jid;
		dump($path);
		if(cookie($cookie) == ''){
			$Job->where("jid=".$this->jid)->setInc("pv",1);
			cookie($cookie,serialize(array($this->jid)),array('expire'=>3600*6));
		}else{
			$arr =unserialize(cookie($cookie));
			if(!in_array($this->jid,$arr)){
				$Job->where("jid=".$this->jid)->setInc("pv",1);
				$arr[] = $this->jid;
				dump($arr);
				cookie($cookie,serialize($arr),array('expire'=>3600*6));
			}
		}
		
	}
}
?>
