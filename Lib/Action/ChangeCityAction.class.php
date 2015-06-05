<?php
/**
 * 
 * 切换城市
 * @author Airect
 *
 */
class ChangeCityAction extends Action{
	public function index(){
//		if(session("?city")){
//			
//		}
		$Addr = M('address');
		$data = $Addr->where()->field("aid,province,city")->select();
		if($data){
			$this->assign("addr",$data);
		}
		$this->display();
	}
	//切换城市
	public function changeCity(){
		//设置session
		session("aid",$this->_get("aid"));
		$Addr = M('address');
		$data = $Addr->where("aid=".$this->_get('aid'))->field("city")->find();
		session('city',$data['city']);
		$this->ajaxReturn(session('aid'),"已切换到".$data['city'],1);
		//
	}
	//搜索城市
	public function s(){
		
	}
}
?>