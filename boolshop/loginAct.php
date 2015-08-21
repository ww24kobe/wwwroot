<?php
define('ACC',true);

include_once('./include/init.php');
//判断用户是否是从登陆界面提交过来的
if($_POST['act']=='act_login'){

	//接收数据
	$username=isset($_POST['username'])?$_POST['username']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';
	$remember=isset($_POST['remember'])?$_POST['remember']:'';
	$lastloginip=$_SERVER['REMOTE_ADDR'];
	$lastlogintime=time();

	

	/*是否cookie保存用户名
	if(!isset($remember)){
		if(!empty($_COOKIE['username'])){
		 setcookie('username',$username,time()-200);
		}
	}else{
		setcookie('username',$username,time()+24*3600*3);
	}*/	

	 

	//判断数据的合法性
	if(empty($username)||empty($password)){
		$msg='用户名或密码不能为空';
		include_once('./view/front/msg.html');
		header('Refresh:2;url=login.php');	
		exit;
	}
	//判断数据的有效性
	$user=new UserModel();
	if($user_pwd=$user->checkLoginUser($username)){	
		   //session记住用户名	  
		   if($user_pwd==md5($password))
			   $_SESSION['username']=$username;
		  // var_dump($_SESSION);exit;

			   //更改用户最后登陆的时间和ip
			   $data['lastlogintime']=$lastlogintime;
			   $data['lastloginip']=$lastloginip;
			   if($user->add($data,$username)){
			     $msg='登陆成功';
			   }else{
			     $msg='登陆信息错误';
			   }
			   
			   include_once('./view/front/msg.html');
			   header('Refresh:2;url=index.php');
			   exit;
		   }
		   
	}else{
			$msg='用户名和密码不匹配';
			include_once('./view/front/msg.html');
			header('Refresh:2;url=login.php');	
			exit;
		   }
	
	
	

	$msg='用户名和密码不匹配';
	include_once('./view/front/msg.html');
	header('Refresh:2;url=login.php');	
	exit;



