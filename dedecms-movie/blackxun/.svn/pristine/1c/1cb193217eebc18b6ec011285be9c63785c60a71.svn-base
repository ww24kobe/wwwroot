<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");

//包含文档类
include_once DEDEINC.'/arc.archives.class.php';
//引入会员登陆类
require DEDEINC.'/memberlogin.class.php';

$act=isset($_GET['act'])?trim($_GET['act']):'';
//添加评论
if($act=='add'){
	$title=$_POST['title'];
	$content=$_POST['content'];
	$id=$_POST['id'];
	$time=time();
	$mem=new  Memberlogin();
	$user_id=$mem->M_ID;
	if(empty($user_id)){
		echo '请先登录再评论';
		exit;
	}
	//插入数据库
	$sql="insert  into  dede_pinglun values(null,0,'$title','$content','$id','$user_id','$time')";
	$dsql->ExecuteNoneQuery($sql);
	echo '你的评论已经提交,正在审核';
}elseif($act=='islogin'){
	$mem=new  Memberlogin();
	$user_id=$mem->M_ID;
	$username=$mem->M_LoginID;
	echo  json_encode(array('user_id'=>$user_id,'username'=>$username));


}else{
	$id=(int)$_GET['id'];
	$filename="./cache/movie".$id.".html";
	if(file_exists($filename)&&filemtime($filename)+300>time()){
		include_once $filename;exit;
	}
	$arc=new  Archives($id);
	$arc->ParAddTable();
	//取出评论
	$sql="select a.id, a.title,a.content,count(b.id) hfcount,c.uname,c.face from dede_pinglun a 
	left  join dede_pinglun b on a.id=b.parent_id
	left join dede_member c on a.user_id=c.mid
		where a.movie_id=$id group by a.id";
	//包含模板
	$dsql->Execute('me',$sql);
	$pldata=array();
	while($row=$dsql->getArray('me')){
		$pldata[]=$row;
	}
	//添加缓存
    ob_start();
	include_once '../templets/a67/pinglun.html';
	$cache=ob_get_contents();
	file_put_contents($filename,$cache);
}
?>