<?php
define('ACC',true);
require('./include/init.php');

//接收别的页面传来的商品good_id
$goods_id = isset($_GET['goods_id'])?$_GET['goods_id']+0:0;

//通过接收goods_id得到商品的所有信息
$goods = new GoodsModel();
$g = $goods->find($goods_id);

//如果没有查到此商品则跳回首页
if(empty($g)) {
    header('location: index.php');
    exit;
}

//通过接收goods_id得到父栏目->> 面包屑导航
$cat = new CatModel();
$nav = $cat->getTree($g['cat_id']);
var_dump($nav);



include(ROOT . 'view/front/shangpin.html');
