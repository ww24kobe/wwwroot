<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	if(empty($_SESSION['m_id'])){
    		$this->redirect('Manager/login');
    	}
    	$this->display();
    }
    
    public function top(){
    	$this->display();
    }
    
    public function menu(){
    	$this->display();
    }
    
    public function drag(){
    	$this->display();
    }
    
    public function main(){
    	//分配系统参数
    	$this->display();
    }
}