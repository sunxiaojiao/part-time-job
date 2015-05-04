<?php
class OrgsAuthModel extends Model{
	protected $_validate = array(
		array('license_num','/^\d{1}$/','请输入正确的执照编号'),//
		array('industry','/^\d{1}$/',"请选择企业类型"),
		array('nature','/^\d{1}$/',"请选择企业性质"),
		array('size','/^\d{1}$/',"请选择企业规模"),
		array('contact','require',"请输入法人或负责人姓名"),
		array('idcard_num','/^\d{14}[a-zA-Z0-9]{4}/',"请输入正确的法人或负责人身份证号码"),
		array('phone','/^1\d{10}/',"请输入正确的法人或负责人手机号码"),
		array('org_img','/^ok$/','请上传营业执照照片'),
		array('idcard_img1','/^ok$/','请上传身份证正面照片'),
		array('idcard_img2','/^ok$/','请上传身份证反面照片'),
	);
	protected $_map = array(
		'' => '',	
	);
	protected $_auto =array(
	
	);
}
?>