<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");
$act=isset($_GET['act'])?trim($_GET['act']):'';
//更新pfz操作
if($act=='update'){
	$id = $_GET['id'];
    $pfz = $_GET['pfz'];
	//判断是否已经评过分
	$ids=isset($_COOKIE['pfids'])?unserialize($_COOKIE['pfids']):array();
	if(in_array($id,$ids)){
		echo -1 ;exit;
	}
	//准备sql执行
	$sql="select pfz,pfrs from dede_addonmovie where aid=$id";
    $dsql->Execute('me',$sql);
    $row = $dsql->GetArray('me');//返回查询的内容，返回的是一个一维数组
	//算出新的评分人数和评分值(总分除以总人数)
	$new_pfrs=$row['pfrs']+1;
	$new_pfz=round(($row['pfz']*$row['pfrs']+$pfz)/($new_pfrs),2);
	//更新数据库
	$sql="update dede_addonmovie set pfz=$new_pfz,pfrs=$new_pfrs where aid=$id";
	$dsql->ExecuteNoneQuery($sql);
	//返回json数据
	$data=array('pfz'=>$new_pfz,'pfrs'=>$new_pfrs);

	//把评论过的id放入数组在存放在cookie中,有效期今天晚上
	$ids[]=$id;
	setcookie('pfids',serialize($ids),mktime(23,59,59,date('m'),date('d'),date('Y')),'/' );
	echo  json_encode($data);
	
}elseif($act=='getpingfen'){
	//获取评分：
		$id = (int)$_GET['id'];
        $sql="select pfz,pfrs from dede_addonmovie where aid=$id";
        $dsql->Execute('me',$sql);
        $row = $dsql->GetArray('me');//返回查询的内容，返回的是一个一维数组
        //$row=$dsql->GetObject('me');//以对象的方式返回数据
       //var_dump($row);
        echo json_encode(array('pfz'=>$row['pfz'],'pfrs'=>$row['pfrs']));


}

	