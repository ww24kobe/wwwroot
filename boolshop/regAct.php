<?php

define('ACC',true);
require('./include/init.php');
	//判断是否是从注册页面提交过来的
if(isset($_POST['submit'])){
	$username=isset($_POST['username'])?$_POST['username']:'';
	$email=isset($_POST['email'])?$_POST['email']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';
	$repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
	$regtime=time();
	$regip=$_SERVER['REMOTE_ADDR'];//string类型

	//判断数据的合法性
    
	if(empty($username)||empty($email)||empty($password)){	
	   $msg='注册信息不能为空，请重新填写！';
	   include_once('./view/front/msg.html');
	   header('Refresh:2;url=reg.php');	 
	   exit;
	}

	//判断两次输入的密码是否一致
	if($password!==$repassword){	
	   $msg='两次密码输入不一致！';
	   include_once('./view/front/msg.html');
	   header('Refresh:2;url=reg.php');	   
	   exit;
	}
    

	//判断数据的有效性
    //判断当前用户名是否在数据库存在
	    $user=new  UserModel();
		if($user->checkUser($username)){
		  $msg='用户名已存在，请重新注册！';
		  include_once('./view/front/msg.html');
		  header('Refresh:2;url=reg.php');	
	      exit;
		}
		$data=array();
		$data['username']=$username;
		$data['password']=$password;
		$data['email']=$email;
		$data['regtime']=$regtime;
		$data['regip']=$regip;

		if($user->insertUserAndPass($data)){
		   $msg='恭喜你，注册成功！';
		   include_once('./view/front/msg.html');
		   header('Refresh:2;url=login.php');
	       exit;		  
		}else{
			//var_dump($user);exit;
			$msg='哎呀，注册失败！';
		   include_once('./view/front/msg.html');
		   header('Refresh:2;url=reg.php');
	       exit;	
		
		}


}else{
  $msg='你还没有注册,请先注册！';
  include_once('./view/front/msg.html');
  exit;
}

	







