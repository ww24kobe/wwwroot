<?php
class  UserAction extends HomeAction{
	/*
	 * 用户注册视图
	 */
	public  function  register(){
		if(IS_POST){
			$MemberModel=D('Member');
           if($MemberModel->create()){
           	$MemberModel->password=md5($_POST['password']);//加密AR模型
           	 if($MemberModel->add()){
           	 	$this->success('注册成功',__GROUP__.'/Index/index');exit;
           	 }else{
           	 	$this->error('注册失败');
           	 }
           }else{
           	$this->error($MemberModel->getError());
           }
		}
		
		$this->display();
	}
	
	/*
	 * 用户登录视图
	 */
	public  function  login(){
		if(IS_POST){
			$MemberModel=D('Member');
			
 			$c = $_SESSION['c'];//取出控制器的名称
			$act=$_SESSION['act'];//取出方法名称
			if(isset($c) && isset($act)){
				$mubiao = '/'.$c.'/'.$act;
			}else{
				$mubiao="/Index/index";
			}
			//验证登录
			if($MemberModel->checkLogin($_POST['username'],md5($_POST['password']))){
				//更新用户最后登录时间和ip
				$MemberModel->updateUserInfo($_SESSION['user_id']);
				//判断是否记住用户名 写入cookie 保存一个星期
				if($_POST['remember']){
					setcookie('user_id',$_SESSION['user_id'],time()+7*24*3600,'/');
					setcookie('username',$_POST['username'],time()+7*24*3600,'/');
					setcookie('password',md5($_POST['password']),time()+7*24*3600,'/');
				}
				$this->success('登录成功',__GROUP__.$mubiao);exit;
			}else{
				$this->error('用户名或密码错误');
			}
			
		}
		$this->display();
	}
	
	/*
	 * 用户退出登录
	 */
	public  function logout(){
		$_SESSION['user_id']=null;
// 		$_SESSION['level_id']=null;
		$_SESSION['username']=null;
// 		setcookie('user_id','',time()-100,'/');
// 		setcookie('username','',time()-100,'/');
// 		setcookie('password','',time()-100,'/');
		$this->redirect('/Index/index');
	}
	
	/*
	 * 找回密码功能
	 *     [username] => wdsfghjkl
    	  [email] => dfshjkl@163.com
   		  [Submit] => 
	 */
	public function findPass(){
		//导入邮件相关类
		import('@.Tool.mail');
		import('@.Tool.phpmailer');
		import('@.Tool.smtp');
		//找回密码

		if(IS_POST){
			$username=$_POST['username'];
			$email=$_POST['email'];
			$userinfo=D('Member')->where("username='$username' and  email='$email'")->find();
			//生成链接validate
			if($userinfo){
				$validate=uniqid();
				$id=$userinfo['id'];
				$data['id']=$userinfo['id'];
				$data['validate']=$validate;
				//插入链接validate
				if(D('Member')->save($data)){
					$http_host=$_SERVER['HTTP_HOST'];
					//发送邮件
					$a="<a href='http://$http_host/index.php/User/active/id/$id/validate/$validate'>点我从新设置密码</a>";
					if(mail::send($email,'找回密码',$a,'')){
						$this->success("发送邮件成功，请到邮箱验证",U('User/login'));exit;
					}else{
						$this->error("发送邮件失败，请重试！");
					}
					
				}
				
			}else{
				$this->error("用户名或邮箱错误");
			}
			
		}
		$this->display();
	} 
	

	/*
	 * 激活
	 */
	public function  active(){
		
		//导入邮件相关类
		import('@.Tool.mail');
		import('@.Tool.phpmailer');
		import('@.Tool.smtp');
		$id=$_GET['id'];
		$validate=$_GET['validate'];
		$userinfo=D('Member')->find($id);
		if($validate!=$userinfo['validate']){
			die('链接失效，找回密码失败');
		}
		//设置新密码
		$str1="qwe2r1234&567ty3456f6gds32dsgui57opsdea4566sdfg6sdfghjklzx567cvbnm";
		$str2="";
		
		$newpass=substr(str_shuffle($str1),1,10);
		
		//修改密码
		$md5newpass=md5($newpass);
		$data['id']=$id;
		$data['password']=$md5newpass;
		if(D('Member')->save($data)){
			//发送邮件
			$text='请及时修改自己的密码，--------------------新密码是：'.$newpass;
			if(mail::send($userinfo['email'],'找回密码',$text,'找回密码')){
				$this->success("修改密码成功，请到邮箱查看",U('User/login'));
			}else{
				$this->error("邮箱发送密码失败,请重试！",U('User/findPass'));
			}
		}else{
			$this->error("修改密码失败,请重试！",U('User/findPass'));
		}
		
	}
	
	/*
	 * 修改密码
	 * [password] => fasdf
    [newpassword] => asdf
    [renewpassword] => sadfg
	 */
	public function updatepass(){
		if(IS_POST){
			$password=$_POST['password'];
			$newpassword=$_POST['newpassword'];
			$renewpassword=$_POST['renewpassword'];
			if($newpassword!=$renewpassword){
				$this->error('新密码和确认新密码不一致');
			}
			$id=$_SESSION['user_id'];
			$userinfo=D('Member')->find($id);
			if(md5($password)!=$userinfo['password']){
				$this->error('原始密码错误!');
			}
			//修改新密码
			$data['id']=$id;
			$data['password']=md5($newpassword);
			if(D('Member')->save($data)){
				$this->success('修改密码成功',U('User/login'));
			}else{
				$this->error('密码修改失败!');
			}
		}
		$id=$_SESSION['user_id'];
		$this->userinfo=D('Member')->find($id);
		$this->display();
	}
	
	/*
	 * 用户中心视图
	 */
	public  function  center(){
		$user_id=$_SESSION['user_id'];
		$this->userinfo=D("Member")->find($user_id);
		$this->display("ucenter1");
	}
	
	/*
	 * 用户中心地址视图
	 */
	public  function  ucenter2(){
		if(IS_POST){
			if(M('address')->save($_POST)){
				$this->success("修改地址成功",U('User/ucenter2'));exit;
			}else{
				$this->error("修改地址失败");
			}
		}
		$user_id=$_SESSION['user_id'];
		$this->address=M("address")->where("user_id=$user_id")->find();
		$this->display();
	}
	
	/*
	 * 用户中心订单视图
	*/
	public  function  ucenter3(){
		$user_id=$_SESSION['user_id'];
		$orderdata=D('OrderInfo')->Field("it_order_info.*,b.info")->join("it_order_status b on it_order_info.status=b.id  ")->where("it_order_info.user_id=$user_id")->select();
		
		
		$pattern=array("/已付款/","/未付款/","/未发货/");
		$replace=array("<font color='green'>已付款</font>","<font color='red'>未付款</font>","<font color='red'>未发货</font>");
		//加工数组 正则替换
		foreach($orderdata as  &$v){
			$v['info']=preg_replace($pattern,$replace,$v['info']);
		}
		$this->orderdata=$orderdata;
		$this->display();
	}
	
	/*
	 * ajax请求订单商品信息
	*/
	public function ajax(){
		$order_sn=$_GET['sn'];
		$sql="select a.*,b.goods_thumb  from  it_order_goods  a left  join it_goods b on a.goods_id=b.id where a.order_id='$order_sn'";
		$this->goodsdata=M()->query($sql);
		$this->display();
	}
	
	/*
	 * 在线留言视图
	 *
	 */
	public  function umessage(){
		if(IS_POST){
			$_POST['time']=time();
			if(M('message')->add($_POST)){
				$this->success('留言成功',U("User/umessage"));exit;
			}else{
				$this->error('留言失败');
			}
		}
		
		$this->display();
	}
	
}