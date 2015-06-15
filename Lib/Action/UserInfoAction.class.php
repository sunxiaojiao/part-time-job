<?php
class UserInfoAction extends Action{
	protected  $uid;
	protected  $Model;

	public function index(){
		$this->uid = $this->_get('uid');
		$this->showInfo();
		$this->showEval();
		$this->display();
	}
	protected  function showInfo(){
		$Users   = M('Users');
		$field   = "uid,username,age,sex,avatar,phone,address,qq,school,exp,intent";
		$list    = $Users->where("uid=%d",$this->uid)->field($field)->find();
		session('user_qq',$list['qq']);
		session('user_phone',$list['phone']);
		//unserialize地址
		$address = unserialize($list['address']);
		$list['address'] = $address['province'] . $address['city'] . $address['area'];
		//查询mold表
		$intent  = unserialize($list['intent']);
		$Mold    = M('Mold');
		$where   = "";
		foreach ($intent as $key => $value){
			$where .= "mid=".$value." OR ";
		}
		$where   = substr($where,0,strlen($where)-4);
		$intent  = $Mold->where($where)->field("name")->select();
		$this->assign("user_info",$list);
		$this->assign("intent",$intent);
	}
	protected function showEval() {
		$Eval  = M('UserEvalute');
		$field = "orgname,content,xm_user_evalute.ctime";
		$where = "to_uid=%d";
		$join  = "INNER JOIN xm_orgs ON xm_orgs.oid=xm_user_evalute.from_oid";
		$arr2  = $Eval->field($field)->join($join)->where($where,$this->uid)->select();
		if($arr2){
			$this->assign("eval_info",$arr2);
		}elseif(is_null($arr2)){
			$this->assign('eval_error_info','还没有评论');
		}else{
			$this->assign('eval_error_info','读取出错');
		}
	}
	//进行评价
	public function evalMe(){
		//只能公司进行评论
		//现在是凌晨12：40 我在敲代码
		if(!session('?oid')){
			return;
		}
		$content = $this->_post('content');
		$uid     = $this->_post('uid');
		$Eval = M('UserEvalute');
		$bool = $Eval->check($content, '1,100',length);
		if(!$bool){
			$this->ajaxReturn(2,"评价内容要在100个字以内",1);
		}
		$data = array('content'=>$content,'from_oid'=>session('oid'),'to_uid'=>$uid,'ctime'=>time());
		$flag = $Eval->add($data);
		if($flag){
			$this->ajaxReturn(1,"评价成功",1);
		}else{
			$this->ajaxReturn(0,"评价失败".$Eval->getLastSql(),1);
		}
	}
	//生成图片联系方式
	public function generatePhoneImage($num = '') {
		import('ORG.Util.Image');
		$t = $this->_get('t');
		if($t == 'phone'){
			$num = session('user_phone');	
		}elseif($t == 'qq'){
			$num = session('user_qq');
		}
		$num = (string)$num;
		$img = new Image();
		$img->buildString($num, array(),'','png',1,false);
	}
}
?>