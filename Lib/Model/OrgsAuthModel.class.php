<?php
class OrgsAuth extends Model {
	//验证
	protected $_validate = array(
	array('license_num'),
	array('industry'),
	array('nature'),
	array('size'),
	array('address'),
	array('contact'),
	array('phone'),
	array('fixed_phone'),
	array('intro'),
	);
	//自动完成
	protected  $_auto = array(
	
	);
}
?>