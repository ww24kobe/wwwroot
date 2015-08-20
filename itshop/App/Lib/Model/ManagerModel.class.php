<?php
class ManagerModel extends  Model{
	/*
	 * 用户用户名和密码
	 */
	public function checkUserAndPassword($u,$p){
		$u=addslashes($u);//转义
		$p=md5($p);//加密
		//echo $p;exit;
		$m_info=$this->where(" username='$u' and  password='$p'")->find();
		//showbug($m_info);exit;
		if(!empty($m_info)){
			//保存管理员信息
			$_SESSION['m_id']=$m_info['id'];
			$_SESSION['m_username']=$m_info['username'];
			//更新登陆时间和ip
			$data['last_time']=time();
			$data['last_ip']=$_SERVER['REMOTE_ADDR'];
			$this->where("id={$m_info['id']}")->save($data);
			return $m_info;
		}else{
			return  false;
		}
	}
		
}