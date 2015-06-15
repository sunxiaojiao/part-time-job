<?php
class OrgsAuthModel extends Model{
	protected $_validate = array(
		array('license_num','/^\d{15}$/','执照编号为15位',1),//
		array('industry','/\d/',"请选择所属行业",1),
		array('nature','require',"请选择企业性质",1),
		array('size','require',"请选择企业规模",1),
		array('contact','require',"请输入法人或负责人姓名",1),
		array('idcard_num','/^\d{14}[a-zA-Z0-9]{4}$/',"请输入正确的法人或负责人身份证号码",1),
		array('phone','/^1\d{10}/',"请输入正确的法人或负责人手机号码",1),
		array('oimg','/^ok$/','请上传营业执照照片',1),
		array('iimg1','/^ok$/','请上传身份证正面照片',1),
		array('iimg2','/^ok$/','请上传身份证反面照片',1),
	);
	protected $_map = array(
		'idnum' => 'idcard_num',
	);
	protected $_auto =array(
		array('ctime','time',1,'function'),
	);
}
?>