<?php
class ManagerAction  extends Action{
	
	/*
	 * 用户登录视图
	 * Array
(
    [m_user] => sdfgy
    [m_pwd] => sfdgh
    [captcha] => sdfghjk
    [act] => signin
    verify
)
	 */
	public function  login(){
		if(IS_POST){
			$verify=md5($_POST['captcha']);
			$username=$_POST['m_user'];
			$password=$_POST['m_pwd'];
			//验证验证码
			if($verify!=$_SESSION['verify']){
				$this->error('验证码不正确!');
			}
			//验证用户名和密码
			if($userinfo=D('Manager')->checkUserAndPassword($username,$password)){
				//showbug($_SESSION);exit;
				$this->success('登录成功',U('Index/index'));exit;
			}else{
				$this->error('用户名或密码错误');
			}
		}
		
		$this->display();
	}
	
	/*
	 * 验证码
	 */
	public function verify() {
		// echo 'hehe';
		import('ORG.Util.Image');
		header("Content-type: image/png");
		Image::buildImageVerify();
	}
	
	/*
	 * 管理员退出登陆
	 *
	 */
	public  function logout() {
		session(null);
		$this->redirect('Manager/login');
	}
	/*
	 * 修改管理员资料视图
	 * Array
(
    [password] => dfgh
    [newpassword] => hjsdfgh
    [renewpassword] => sdfghjk
)
	 */
	public  function  updateInfo(){
	
		if(IS_POST){
			//showbug($_SESSION);exit;
			//echo md5('admin');exit; 21232f297a57a5a743894a0e4a801fc3
			$password=$_POST['password'];
			$newpassword=$_POST['newpassword'];
			$renewpassword=$_POST['renewpassword'];
			if($newpassword!=$renewpassword){
				$this->error('两次密码不一致',U('Manager/updateinfo'),2);
			}
			//验证原密码
			$username=$_SESSION['m_username'];
			//echo $username;exit;
			$md5password=md5($_POST['password']);
			if(!D('Manager')->where("username='$username' and password='$md5password'")->find()){
				$this->error('原密码输入错误',U('Manager/updateinfo'),2);
			}
			//更新新密码
			$md5newpassword=md5($newpassword);
			$id=$_SESSION['m_id'];
			$sql="update it_manager set password='$md5newpassword' where  id=$id";
			if(D('Manager')->execute($sql)){
				$_SESSION['m_username']=null;
				$_SESSION['m_id']=null;
				 $this->success("修改成功",U("Index/index"),2);exit;
				//$this->redirect('Manager/login');
			}else{
				$this->error('修改失败');
			}
		}
		$this->display();
	}
}