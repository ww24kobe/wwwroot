<?php
class CommentAction extends HomeAction{
	
	//ajax添加评论
	public function addcomment(){
		//showbug(D('Comment'));exit;
		//一星代表两分
		//id,u_id,goods_id,content,time,star
		$content=$_GET['content'];
		$star=(int)$_GET['star'];
		$goods_id=(int)$_GET['goods_id'];
		$u_id=isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
		$time=time();
		//评论插入数据库
		$data=array();
		$data['u_id']=$u_id;
		$data['star']=$star;
		$data['goods_id']=$goods_id;
		$data['time']=$time;
		$data['content']=$content;
		if(D('Comment')->add($data)){
			
			echo $goods_id;
		}else{
			echo '0';
		}
		
	}
}