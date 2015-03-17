<?php
class MoldModel extends Model{
	//验证
	protected $_validate = array(
		array('name','require','请输入关键词'),//系统管理员添加
	);
	//自动完成
	protected  $_auto = array(
		array(),
	);
	
}

?>