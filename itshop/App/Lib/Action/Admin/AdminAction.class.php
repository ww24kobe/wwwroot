<?php
class AdminAction extends Action{
	public  function _initialize(){
	if(empty($_SESSION['m_id'])){
    		$this->error('请先登录!',U('Manager/login'));
    	}
	}
	
	/*
	 * 正在建设中......
	 */
	public function  build(){
		echo '正在建设中.........';
	}
}