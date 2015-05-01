<?php
class OrgEvaluteModel extends Model{
	protected $_validate = array(
		array('content','require','请填写评价内容'),
		array('content','1,50','字符不符合要求',0,'length'),
	);
	protected $_map = array(
		
	);
	protected $_auto = array(
		array('ctime','time',1,'function'),
	);
}
?>