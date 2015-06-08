<?php
/**
 * header中的search
 */
class SearchAction extends Action {
	protected $word;
	public function index() {
		$this->display('job');
	}
	//显示搜索页
	public function showResult($data,$sf='job') {
		$result = $data;
		//dump($result);
		//通过直接获取结果数组的长度来，减轻了数据库的压力
		$count = count($data);
		//采用thinkphp的原生SQL，当结果为空时，返回的是空数组
		if($result && $count != 0) {
			$this->assign("result",$result);
			$this->assign("count",$count);
		}elseif($result === false) {
			$this->assign("error_info","搜索错误");
		}else{
			$this->assign("error_info","搜素结果为空");
		}

		$this->display($sf);
	}
	/**
	 * 执行搜索
	 */
	public function s() {
		//获取字段
		$sf;$wd;
		if($this->isGet()){
			if($this->_get('wd') != ''){
				$wd = $this->_get('wd');
			}else {
				$this->showResult(null);
				return;
			}
			if($this->_get('sf') == 'job'){
				$sf = 'job';				
			}elseif($this->_get('sf') == 'user'){
				$sf = 'user';
			}else{
				$sf = 'job';
			}
		}else{
			return;
		}
		//搜索
		$M = M();
		$where1 = "`title` LIKE BINARY '%" . $wd . "%'";
				 //.'OR' . "'addressname' LIKE BINARY '%" . $wd . "%'" .
		$where2 = "`username` LIKE BINARY '%" .$wd . "%'";
		//先不考虑中英文混合
		//$sql  = "SELECT jid,title,address,money FROM `xm_jobs` WHERE `title` LIKE BINARY CONCAT('%',UPPER('" . $this->word . "'),'%')";
		$sql1  = "SELECT jid,title,addressname,money,ctime FROM `xm_jobs` WHERE ( ". $where1 ." )";
		$sql2  = "SELECT username,sex,uid FROM `xm_users` WHERE (" . $where2. ")";
		$data;
		if($sf == 'job'){
			$data = $M->query($sql1);
		}elseif($sf == 'user'){
			$data = $M->query($sql2);	
		}
		$this->showResult($data,$sf);
	}
}
?>