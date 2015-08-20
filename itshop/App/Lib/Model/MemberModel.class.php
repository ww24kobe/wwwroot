<?php
class MemberModel  extends  Model{
	protected  $_validate=array(
			array('username','require','用户名不能为空'),
			array('username','','用户名称已经存在',0,'unique'),
			array('password','require','密码不能为空'),
			array('password','6,12','密码长度必须在6-12位',1,'length'),
			array('repassword','password','两次密码不一致',1,'confirm'),
			array('email','email','邮箱不合法'),
			array('email','','邮箱已存在',0,'unique'),
			
	);
	
	/*
	 * 检查登录
	 */
	public function checkLogin($username,$password){
		$userinfo=$this->where("username='$username'")->find();
		if($userinfo){
			if($userinfo['password']==$password){
				$_SESSION['user_id']=$userinfo['id'];
				$_SESSION['level_id']=$userinfo['level_id'];
				$_SESSION['username']=$userinfo['username'];
				return true;
			}else{
				return false;
			}
		}else{
			return  false;
		}
		
	}
	
	/*
	 * 
	 */
	public  function updateUserInfo($user_id){
		$data['last_time']=time();
		$data['last_ip']=$_SERVER['REMOTE_ADDR'];
		$this->where("id=$user_id")->save($data);
	}
	
	
	
	
	
	
}