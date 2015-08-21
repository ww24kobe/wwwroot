<?php

define('ACC',true);
require('./include/init.php');
//判断是否是由修改密码页面提交过来的
if(isset($_POST['act'])){
	$oldpassword=isset($_POST['oldpassword'])?$_POST['oldpassword']:'';
	$newpassword=isset($_POST['newpassword'])?$_POST['newpassword']:'';
	$renewpassword=isset($_POST['renewpassword'])?$_POST['renewpassword']:'';

	//检验数据的合法性
	if(empty($oldpassword)||empty($newpassword)||empty($renewpassword)){	
	   $msg='密码不能为空！';
	   include_once('./view/front/msg.html');
	   header('Refresh:2;url=user.php?username='.$_SESSION['username']);	 
	   exit;	
	}

	if($newpassword!==$renewpassword){	
	   $msg='新密码不一致，请重新填写！';
	   include_once('./view/front/msg.html');
	   header('Refresh:2;url=user.php?username='.$_SESSION['username']);		
	   exit;	
	}

	//验证数据的合法性	
	//检验原密码是否正确
	$user=new  UserModel();
	
	if($user_password=$user->checkPwd($_SESSION['username'])){
		//echo $user_password;exit;
	    if($user_password==md5($oldpassword)){
			   $data['password']=$newpassword;
			   if($user->updatePwd($data,$_SESSION['username'])){
				   $msg='修改成功！';
				   include_once('./view/front/msg.html');
				   header('Refresh:2;url=login.php');		 
				   exit;
				  
			   }
		
		}else{
				   $msg='原密码输入有误，请重新输入！';
				   include_once('./view/front/msg.html');
				   header('Refresh:2;url=user.php?username='.$_SESSION['username']);		 
				   exit;
			   
			   
			 }   
	
	}


}else{
       $msg='操作非法错误！';
	   include_once('./view/front/msg.html');
	 header('Refresh:2;url=user.php?username='.$_SESSION['username']);		 
	   exit;
}

