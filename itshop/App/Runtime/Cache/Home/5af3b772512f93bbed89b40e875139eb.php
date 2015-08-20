<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="YONGDA商城" />
        <meta name="Description" content="YONGDA商城" />
        
        <title>爱购商城 - Powered by Wangwei</title>
        <link rel="shortcut icon" href="__HIMG__/ico.ico" type="image/x-icon" />
        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body class="index_body">
    <!-- 引入头部 -->
    <div class="block clearfix" style="position: relative; height: 98px;">
            <a href="/" name="top"><img class="logo" src="__HIMG__/logo.jpg"></a>

            <div id="topNav" class="clearfix">
                <div style="float: left;"> 
                    <font id="ECS_MEMBERZONE">
                    
                        <div id="append_parent"></div>
                      
                        <?php if(empty($_SESSION['username'])){?>
                        <a href="__GROUP__/User/login"> 登录</a>
                        <a href="__GROUP__/User/register">注册</a>
                        <?php  }else{?>
                          		欢迎光临本店&nbsp;:<?php echo $_SESSION['username'].'&nbsp;'."<a href='__GROUP__/User/center'>个人中心</a>&nbsp;"."<a href='__GROUP__/User/logout'>退出登录</a>&nbsp;"; ?>
                        <?php  }?>
                    </font>
                </div>
                <div style="float: right;">
                   
                    <a  onClick="SetHome('www.mobileshop.com')" href="javascript:void(0)" title="设为首页">设为首页</a>
                    |
                    <a onClick="AddFavorite('www.mobileshop.com','手机商城')" href="javascript:void(0)" title="加入收藏">收藏</a>
                    
                </div>
            </div>
            <div id="mainNav" class="clearfix">
                <a href="/" class="cur">首页<span></span></a>
                <?php foreach($topdata as $v){?>
                <a href="__GROUP__/Category/Category/id/<?php echo $v['id'];?>"><?php echo $v['cat_name'];?><span></span></a>
                
                <?php  }?>
            </div>
        </div>

        <div class="header_bg">
            <div style="float: left; font-size: 14px; color:white; padding-left: 15px;">
            </div>  
            <form id="searchForm" method="get" action="__GROUP__/Category/category">
                <input name="keywords" id="keyword" required type="search" />
                <input name="imageField" value=" " class="go" style="cursor: pointer; background: url('__HIMG__/sousuo.gif') no-repeat scroll 0% 0% transparent; width: 39px; height: 20px; border: medium none; float: left; margin-right: 15px; vertical-align: middle;" type="submit" />
            </form>
        </div>
        <div class="blank5"></div>
        <div class="header_bg_b">
              <div class="f_l" style="padding-left: 10px;">
                <!--  <img src="__HIMG__/biao6.gif" />
                    北京市区，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
                    <img style="vertical-align: middle;" src="__HIMG__/biao3.gif">-->
                    <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 <?php  echo $cartdata['number'];?> 种商品，总计金额 ￥<?php  echo $cartdata['total_price']?>元。</a></span>
                    <a href="__GROUP__/Cart/showCart"><img style="vertical-align: middle;" src="__HIMG__/biao7.gif"></a>
            </div>
            <!--  <div class="f_r" style="padding-right: 10px;">
                <img style="vertical-align: middle;" src="__HIMG__/biao3.gif">
                    <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 <?php  echo $cartdata['number'];?> 种商品，总计金额 ￥<?php  echo $cartdata['total_price']?>元。</a></span>
                    <a href="__GROUP__/Cart/showCart"><img style="vertical-align: middle;" src="__HIMG__/biao7.gif"></a>

            </div>-->
        </div>
        
        <script>
        function SetHome(url) {

            if (document.all) {

                document.body.style.behavior = 'url(#default#homepage)';

                document.body.setHomePage(url);

            } else {

                alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");

            }

        }
        
        function AddFavorite(sURL, sTitle) {

            sURL = encodeURI(sURL);

            try {

                window.external.addFavorite(sURL, sTitle);

            } catch (e) {

            try {

                window.sidebar.addPanel(sTitle, sURL, "");

            } catch (e) {

                alert("加入收藏失败,请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");

                }

            }

        }
        
        
        </script>
        <div class="block box">
            <div class="blank"></div>
            <div id="ur_here">
                当前位置: <a href="/">首页</a> 
            </div>
        </div>
        <div class="blank"></div>
        <div class="block box">

        <div class="block clearfix">

            <div class="AreaL">

                <h3><span>商品分类</span></h3> 
                <!-- 引入公共栏目模块 -->
                <div id="category_tree" class="box_1">
                <?php foreach($catdata as $v){ if($v['parent_id']==0){ ?>
                    <dl>
                        <dt><a href="__GROUP__/Category/Category/id/<?php echo $v['id'];?>"><?php echo $v['cat_name'];?></a></dt>
                       
                        <dd>  
                        <?php foreach($catdata as $v1){ if($v1['parent_id']==$v['id']){ ?>   
                            <a href="__GROUP__/Category/Category/id/<?php echo $v1['id'];?>"><?php echo $v1['cat_name'];?></a>
                          <?php }}?> 
                        </dd>
                       
                    </dl>
                    <?php }}?>
                    
                   

 </div>
                <div class="blank"></div>
                <div class="box">
                    <h3><span>销售排行榜</span></h3> 
                    <div class="box_1">
                        <div class="top10List clearfix">
                           
                            <?php  $k=0; foreach($topgoodsdata as $v){?>
                            <ul class="clearfix">
                                <img src="__HIMG__/top_<?php echo ++$k; ?>.gif" class="iteration">
                                    <li class="topimg">
                                        <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>"><img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" alt="" class="samllimg"></a>
                                    </li>

                                    <li class="iteration1">
                                        <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" title=""><?php  echo $v['goods_name'];?></a><br />
                                        本店售价：<font class="f1">￥<?php  echo $v['shop_price'];?>元</font><br />
                                    </li>
                            </ul>
                            <?php }?>
                           
                            
                            <?php  $k=4;foreach($goodsdata as $v){?>
                            <ul class="clearfix">
                                <img src="__HIMG__/top_<?php echo $k++; ?>.gif" class="iteration">

                                    <li>
                                        <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" title=""><?php  echo $v['goods_name'];?></a><br />
                                        本店售价：<font class="f1">￥<?php  echo $v['shop_price'];?>元</font><br />
                                    </li>
                            </ul>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="blank5"></div>
               <!--  <div class="box">  <h3><span>品牌专区</span></h3>
                    <div class="box_1">
                        <div class=" brands clearfix">
                            <a href="#"><img src="__HIMG__/1240803062307572427.gif" alt="诺基亚 (7)"></a>
                            <a href="#"><img src="__HIMG__/1240802922410634065.gif" alt="摩托罗拉 (1)"></a>
                            <a href="#"><img src="__HIMG__/1240803144788047486.gif" alt="多普达 (1)"></a>
                        </div>
                    </div>
                </div>-->
            </div>

            <div class="AreaM">
                <div class="box clearfix">
                    <div id="focus">
                        <img src="__HIMG__/iphone6.png" width="515" height="160" alt="" />
                    </div>       
                </div>
                <div class="blank"></div>

                <div class="itemTit" id="itemHot">
                    <div class="tit">热卖商品</div>
                    <h2><a  href="#" >全部商品</a></h2>
                    <h2 class="h2bg"><a href="#" >GSM手机</a></h2>
                    <h2 class="h2bg"><a href="#" >双模手机</a></h2>
                    <h2 class="h2bg"><a href="#" >充值卡</a></h2>
                    <h2 class="h2bg"><a href="#" >小灵通/固话充值卡</a></h2>
                </div>
                <div id="show_hot_area" class="clearfix">
                <?php foreach($hotdata as $v){?>
                    <div class="goodsItem">

                        <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>"><img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" alt="诺基亚E66" class="goodsimg"></a><br />
                        <p class="f1"><a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" title="<?php  echo $v['goods_name'];?>"><?php  echo $v['goods_name'];?></a></p>
                        <font class="market">￥<?php  echo $v['shop_price']*1.2;?>元</font><br />
                        <font class="f1">
                                              ￥<?php  echo $v['shop_price'];?>元                     </font>
                    </div>
                   <?php }?>
                </div>
                <div class="blank"></div>

                <div class="itemTit" id="itemBest">

                    <div class="tit">精品推荐</div>
                    <h2><a href="#" >全部商品</a></h2>
                    <h2 class="h2bg"><a href="#" >GSM手机</a></h2>
                    <h2 class="h2bg"><a href="#" >双模手机</a></h2>
                    <h2 class="h2bg"><a href="#" >充值卡</a></h2>
                    <h2 class="h2bg"><a href="#" >联通手机充值卡</a></h2>
                </div>
                <div id="show_best_area" class="clearfix">
                    <?php foreach($bestdata as $v){?>
                    <div class="goodsItem">

                        <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>"><img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" alt="诺基亚E66" class="goodsimg"></a><br />
                        <p class="f1"><a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" title="<?php  echo $v['goods_name'];?>"><?php  echo $v['goods_name'];?></a></p>
                        <font class="market">￥<?php  echo $v['shop_price']*1.2;?>元</font><br />
                        <font class="f1">
                                              ￥<?php  echo $v['shop_price'];?>元                     </font>
                    </div>
                   <?php }?>

                </div>
                <div class="blank"></div>

                <div class="itemTit" id="itemNew">
                    <div class="tit">新品上架</div>
                    <h2><a href="#" >全部商品</a></h2>
                    <h2 class="h2bg"><a href="#" >GSM手机</a></h2>
                    <h2 class="h2bg"><a href="#" >双模手机</a></h2>
                    <h2 class="h2bg"><a href="#" >充值卡</a></h2>
                    <h2 class="h2bg"><a href="#" >联通手机充值卡</a></h2>
                </div>
                <div id="show_new_area" class="clearfix">
                    
                   
                    <?php foreach($newdata as $v){?>
                    <div class="goodsItem">

                        <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>"><img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" alt="诺基亚E66" class="goodsimg"></a><br />
                        <p class="f1"><a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" title="<?php  echo $v['goods_name'];?>"><?php  echo $v['goods_name'];?></a></p>
                        <font class="market">￥<?php  echo $v['shop_price']*1.2;?>元</font><br />
                        <font class="f1">
                                              ￥<?php  echo $v['shop_price'];?>元                     </font>
                    </div>
                   <?php }?>

                </div>
                <div class="blank"></div>

            </div>


            <div class="AreaL" style="float: right;">

                <h3><span>站内公告</span></h3> 
                <div class="NewsList tc box_1" style="border-top: medium none;">
                    <ul>
                     	<?php foreach($advdata as $v){?>
                        <li>
                            <a href="__URL__/showadv/id/<?php echo $v['id'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a>
                        </li>
                        <?php }?>
                    </ul>
                </div>

                <div class="blank"></div>
                <!--  -->
                <div class="box">  
                    <h3><span>订单查询</span></h3>
                    <div class="box_1">
                        <div class="boxCenterList">
                            <form name="ecsOrderQuery">
                                <input name="order_sn" class="inputBg" type="text" /><br />
                                <div class="blank5"></div>
                                <input value="查询该订单号" class="bnt_blue_2"  type="button" />
                            </form>
                            <div id="ECS_ORDER_QUERY" style="margin-top: 8px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blank"></div>
                <!--  <div class="blank"></div><div class="box">
                    <h3><span>邮件订阅</span></h3>
                    <div class="box_1">

                        <div class="boxCenterList RelaArticle">
                            <input id="user_email" class="inputBg" type="text" /><br />
                            <div class="blank5"></div>
                            <input class="bnt_blue" value="订阅"  type="button" />
                            <input class="bnt_bonus" value="退订"  type="button" />
                        </div>
                    </div>
                </div>-->
                 <div style="display: block;" class="box" id="history_div">
                    <h3><span>浏览历史</span></h3>
                    <div class="box_1">

                        <div class="boxCenterList clearfix" id="history_list">
                        <?php foreach($visitdata as $v){?>
                            <ul class="clearfix">
                                <li class="goodsimg">
                                    <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" target="_blank">
                                        <img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" alt="飞利浦9@9v" class="B_blue" />
                                    </a>
                                </li>
                                <li>
                                    <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" target="_blank" title="飞利浦9@9v"><?php  echo $v['goods_name'];?></a><br />
                                    本店售价：<font class="f1">￥3<?php  echo $v['shop_price'];?>元</font><br />
                                </li>
                            </ul>
                           <?php  }?>
                            <ul id="clear_history">
                                <a  href="__GROUP__/Goods/clearVisit" onclick="clear_history() ">[清空]</a>
                            </ul>  
                        </div>
                    </div>
                </div>
                <div class="blank"></div>
               <!--  
                <div class="box"> 
                    <h3>
                        <span><a href=""></a></span>
                        <a href="">更多</a>
                    </h3>
                    <div class="box_1">

                        <div class="boxCenterList RelaArticle">
                        </div>
                    </div>
                </div>-->
                <div class="blank5"></div>
                <style type="text/css">
                    .boxCenterList form{display:inline;}
                    .boxCenterList form a{color:#404040; text-decoration:underline;}
                </style>
               <!--  <div class="box">  
                    <h3><span>发货查询</span></h3>
                    <div class="box_1">
                        <div class="boxCenterList">
                            订单号 2009061909851<br />
                            发货单 232421   <div class="blank"></div>
                            订单号 2009052224892<br />
                            发货单 1123344   <div class="blank"></div>
                        </div>
                    </div>
                </div>-->
                <div class="blank"></div>
            </div>
        </div>
        </div>

        <div class="blank"></div>
       <!-- 引入尾部 -->
           <!--<div class="block">
            <a href="#" target="_blank" title="YONGDA商城"><img alt="YONGDA商城" src="__HIMG__/di.jpg"></a>
            <div class="blank"></div>
        </div>-->
        <div class="block">
            <div class="box">
                <div class="helpTitBg" style="clear: both;">
                    <dl>
                        <dt><a href="#" title="新手上路 ">新手上路 </a></dt>
                        <dd><a href="#" title="售后流程">售后流程</a></dd>
                        <dd><a href="#" title="购物流程">购物流程</a></dd>
                        <dd><a href="#" title="订购方式">订购方式</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="手机常识 ">手机常识 </a></dt>
                        <dd><a href="#" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                        <dd><a href="#" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                        <dd><a href="#" title="如何享受全国联保">如何享受全国联保</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="配送与支付 ">配送与支付 </a></dt>
                        <dd><a href="#" title="货到付款区域">货到付款区域</a></dd>
                        <dd><a href="#" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                        <dd><a href="#" title="支付方式说明">支付方式说明</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="会员中心">会员中心</a></dt>
                        <dd><a href="#" title="资金管理">资金管理</a></dd>
                        <dd><a href="#" title="我的收藏">我的收藏</a></dd>
                        <dd><a href="#" title="我的订单">我的订单</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="服务保证 ">服务保证 </a></dt>
                        <dd><a href="#" title="退换货原则">退换货原则</a></dd>
                        <dd><a href="#" title="售后服务保证 ">售后服务保证</a></dd>
                        <dd><a href="#" title="产品质量保证 ">产品质量保证</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="联系我们 ">联系我们 </a></dt>
                        <dd><a href="#" title="网站故障报告">网站故障报告</a></dd>
                        <dd><a href="#" title="选机咨询 ">选机咨询</a></dd>
                        <dd><a href="#" title="投诉与建议 ">投诉与建议</a></dd>
                    </dl>
                </div>
            </div>


        </div>
        <div class="blank"></div>
        <div id="bottomNav" class="box block">
           
        </div>
        <div class="blank"></div>
        <div id="bottomNav" class="box block">
            <div class="bNavList clearfix">
                <a href="#">免责条款</a>
                |
                <a href="#">隐私保护</a>
                |
                <a href="#">咨询热点</a>
                |
                <a href="#">联系我们</a>
                |
                <a href="#">Powered&nbsp;by&nbsp;<strong><span style="color: rgb(51, 102, 255);">YongDa</span></strong></a>
                |
                <a href="#">批发方案</a>
                |
                <a href="#">配送方式</a>

            </div>
        </div>

        <div id="footer">
            <div class="text">
                © 2005-2012 YONGDA 版权所有，并保留所有权利。<br />
            </div>
        </div>
    </body>
</html>