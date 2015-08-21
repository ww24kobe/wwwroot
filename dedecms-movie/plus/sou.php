<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
//die($_SERVER['QUERY_STRING']);

/***************取出导航栏目***********************************/
$sql="select id,typename,typedir,isdefault,ispart,defaultname,namerule2,moresite,siteurl,sitepath from dede_arctype where  reid=0 order  by sortrank asc";
$dsql->Execute('me',$sql);
$channeldata=array();
while($row=$dsql->getArray('me')){
	$row['typelink'] = GetOneTypeUrlA($row);
	$channeldata[]=$row;
}
//var_dump($channeldata);exit;
/**************************取出电影栏目************************/
$sql="select id,typename from dede_arctype where  reid=1 ";
$dsql->Execute('me',$sql);
$subchanneldata=array();
while($row=$dsql->getArray('me')){
	$subchanneldata[$row['id']]=$row['typename'];
	
}
//var_dump($subchanneldata);exit;
//取出我的电影栏目的子栏目

/*************搜索条件***********************/
$where="";//搜索条件字符串
//$search=array();//保存搜索条件

if(!empty($_GET['title'])){
	$where.=" and arc.title like '%{$_GET['title']}%'";
	$search[]=array('title',$_GET['title']);
}
//var_dump($search);exit;
if(!empty($_GET['typeid'])){
	$where.=" and addf.typeid='{$_GET['typeid']}'";
	$search[]=array('typeid',$subchanneldata[$_GET['typeid']]);
}

if(!empty($_GET['diqu'])){
	$where.=" and addf.diqu='{$_GET['diqu']}'";
	$search[]=array('diqu',$_GET['diqu']);
}
if(!empty($_GET['niandai'])){
	$where.=" and addf.niandai='{$_GET['niandai']}'";
	$search[]=array('niandai',$_GET['niandai']);
}
//var_dump($search);exit;
//获取地址栏的url参数
function geturl($a){
	$url=$_SERVER['QUERY_STRING'];
	//用去掉叠加的p
	$patt='/'.$a.'=[^&]+&?/';
	$url=preg_replace($patt,'',$url);
	$url=trim($url,'&');
	if(empty($url)){
		return  '';
	}
	return $url.'&';
}
$url=geturl('p');
/**************分页操作(五大步)**************/
//1,获取总的记录数
$sql="select  count(*) total from  dede_archives arc 
left  join dede_addonmovie addf on  addf.aid=arc.id
where arc.channel=17 ".$where;
//die($sql);
$row=$dsql->getOne($sql);
$count=$row['total'];
//2,每页显示多少条记录
$pagesize=4;
//3,算出总共多少页
$pagecount=ceil($count/$pagesize);
//4,设置当前页.防止越界
$page=isset($_GET['p'])?max(1,min($_GET['p'],$pagecount)):1;
//5,设置limit
$limit=" limit ".($page-1)*$pagesize.",".$pagesize;
//6,构建分页字符串

/*
	<p>共 7037 部手机电影，共 704 页，当前页为第 1 页</p>
			<div><span><a href="#" target="_blank">上一页</a></span> <a href="#" class="on">1</a> <a href="#" target="_blank">2</a> <a href="#" target="_blank">3</a> <a href="#" target="_blank">4</a> <a href="#" target="_blank">5</a> <a href="#" target="_blank">...</a> <span><a href="#" target="_blank">下一页</a></span></div>
*/
$show="<p>共{$count}部手机电影，共 {$pagecount} 页，当前页为第 {$page}页</p><div><span>";
$prevpage=max(1,($page-1));
$nextpage=min($page+1,$pagecount);
$show.="<a href='?{$url}p=1#maodian'>首页</a>";
$show.="<a href='?{$url}p={$prevpage}#maodian'>上一页</a></span>";
$show.="<span><a href='?{$url}p={$nextpage}#maodian'>下一页</a>";
$show.="<a href='?{$url}p={$pagecount}#maodian'>最后一页</a></span></div>";


$sql="SELECT arc.*,addf.pfz,addf.yuuan,tp.typedir,tp.typename,tp.corank,tp.isdefault,tp.defaultname,tp.namerule,tp.namerule2,tp.ispart,
tp.moresite,tp.siteurl,tp.sitepath from dede_archives arc  
left join  dede_addonmovie addf on addf.aid=arc.id 
left join dede_arctype  tp  on arc.typeid=tp.id where 1 ".$where.$limit;
//die($sql);
$dsql->Execute('me',$sql);
$data=array();
while($row=$dsql->getArray('me')){
	//增加电影内容链接
	$row['arcurl'] = GetFileUrl($row['id'],$row['typeid'],$row['senddate'],$row['title'],$row['ismake'],
                $row['arcrank'],$row['namerule'],$row['typedir'],$row['money'],$row['filename'],$row['moresite'],$row['siteurl'],$row['sitepath']);
	$data[]=$row;
}
//var_dump($data);
//加载模板
include_once '../templets/a67/sou.html';