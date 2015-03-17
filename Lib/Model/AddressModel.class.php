<?php
class AddressModel extends Model{
	//验证
	protected $_validate = array(
		array('province','require','请输入省份名'),
		array('city','require','请输入城市名，例如济南，福州'),
		array('area','require','请输入具体地区名,例如XX区或地级市'),
		
	);
	//自动完成
	protected  $_auto = array(
		array(),
	);
	
}

?>