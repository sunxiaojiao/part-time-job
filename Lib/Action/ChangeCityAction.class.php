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
		$data = $Addr->where()->field("aid,province,city,area")->select();
		if($data){
			$this->assign("addr",$data);
		}
		//dump($data);
		$this->display();
	}
	//切换城市
	public function changeCity(){
		//设置session
		session("aid",$this->_get("aid"));
		$Addr = M('address');
		$data = $Addr->where("aid=".$this->_get('aid'))->field("city,area")->find();
		session('city',$data['city']);
		session('area',$data['area']);
		$this->ajaxReturn(session('aid'),"已切换到".session('area'),1);
		//
	}
	public function s(){
		
	}
}
?>