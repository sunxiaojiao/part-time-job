<?php
interface ShowInfo{
	
	/**
	 * 从数据库读
	 * @param string $model  模型类命
	 */
	function read($model){}
	
	/**
	 * 将数据传入模板变量	
	 * @param string $model  模型类命
	 */
	function assign($model){}
}
?>