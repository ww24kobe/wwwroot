<?php

define('ACC',true);
require('./include/init.php');

$cat_id = isset($_GET['cat_id'])?$_GET['cat_id']+0:0;
$page=isset($_GET['page'])?$_GET['page']+0:1;

if($page>1){
  $page=1;
}
//每页两条
$perpage=2;
$offset=($page-1)*$perpage;


 
//调用分页类 
$goods=new GoodsModel();
$total=$goods->catGoodsCount($cat_id);
if($page>ceil($total/$perpage)){
 $page=1;
}
$pagetool=new PageTool($total,1,$perpage);
$pagenav=$pagetool->show();

$cat = new CatModel();
$category = $cat->find($cat_id);
//判断栏目是否存在
if(empty($category)) {
    header('location: index.php');
    exit;
}

// 取出所有栏目导航
$cats = $cat->select(); // 获取所有的栏目

//给栏目加缩进效果
$sort = $cat->getCatTree($cats,0,1);

// 根据接收到的cat_id得到面包屑导航
$nav = $cat->getTree($cat_id);


// 取出cat_id栏目下的商品
$goods = new GoodsModel();
$goodslist = $goods->catGoods($cat_id);


include(ROOT . 'view/front/lanmu.html');
