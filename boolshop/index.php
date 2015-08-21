<?php



define('ACC',true);

require('./include/init.php');


//取出5条新品
$goods = new GoodsModel();
$newlist = $goods->getNew();

//取出女士栏目下的商品
$cat_id=4;
$womenlist=$goods->catGoods($cat_id);

//取出男士栏目下的商品
$cat_id=7;
$manlist=$goods->catGoods($cat_id);


include(ROOT . 'view/front/index.html');