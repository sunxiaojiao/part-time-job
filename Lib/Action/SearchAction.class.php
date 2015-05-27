<?php
/**
 * header中的search
 */
class SearchAction extends Action {
	protected $word;
	/**
	 * 模板显示
	 */
	public function index($data) {
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
		//dump($result);
		$this->display('index');
	}
	/**
	 * 执行搜索
	 */
	public function s() {
		//获取字段
		if($this->isGet()){
			if($this->_get('wd') != ''){
				$this->word = $this->_get('wd');
			}else {
				$this->index(null);
				return;
			}
		}else{
			return;
		}
		//搜索
		$Jobs = M();
		//先不考虑中英文混合
		//$sql  = "SELECT jid,title,address,money FROM `xm_jobs` WHERE `title` LIKE BINARY CONCAT('%',UPPER('" . $this->word . "'),'%')";
		$sql  = "SELECT jid,title,address,money FROM `xm_jobs` WHERE `title` LIKE BINARY '%" . $this->word . "%'";
		$data = $Jobs->query($sql);
		//dump($Jobs->getLastSql());
		$this->index($data);
	}
}
?>