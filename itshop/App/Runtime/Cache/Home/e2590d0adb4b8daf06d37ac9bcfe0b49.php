<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />
    
        <title>爱购商城 - Powered by Wangwei</title>
        <link rel="shortcut icon" href="__HIMG__/ico.ico" type="image/x-icon" />
        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />
        <style>
        .xuan{background:blue}
        </style>
        <script type="text/javascript" src="__JS__/jquery.js"></script>
    </head>
    <body>
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
           
                当前位置: <a href="#">首页</a> <code>&gt;</code> 
               <?php  foreach($navdata as $v){?>
                <a href="__GROUP__/Category/category/id/<?php  echo $v['id'];?>"><?php  echo $v['cat_name'];?></a>
                <?php if(end($navdata)!=$v){?>
                 <code>&gt;</code> 
                 <?php  }?>
                <?php }?>
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
                <div class="blank5"></div>

            </div>


            <div class="AreaR">

                <div class="box">
                    <div class="box_1">
                        <h3><span>商品筛选</span></h3>
                        <div class="screeBox">
                            <strong>品牌：</strong>
                            <a href="__ACTION__/b_id/0" <?php if(empty($_SESSION['query']['b_id'])) echo 'class="xuan"';?>>全部</a>&nbsp;
                            <a href="__ACTION__/b_id/1"  <?php if($_SESSION['query']['b_id']==1) echo 'class="xuan"';?> >小米</a>&nbsp;
                            <a href="__ACTION__/b_id/3" <?php if($_SESSION['query']['b_id']==3) echo 'class="xuan"';?>>三星</a>&nbsp;
                            <a href="__ACTION__/b_id/2" <?php if($_SESSION['query']['b_id']==2) echo 'class="xuan"';?>>华为</a>&nbsp;
                            <a href="__ACTION__/b_id/11" <?php if($_SESSION['query']['b_id']==11) echo 'class="xuan"';?>>苹果</a>&nbsp;
                            <a href="__ACTION__/b_id/4" <?php if($_SESSION['query']['b_id']==4) echo 'class="xuan"';?>>oppo</a>&nbsp;
                            <a href="__ACTION__/b_id/8" <?php if($_SESSION['query']['b_id']==8) echo 'class="xuan"';?>>索尼</a>&nbsp;
                            <a href="__ACTION__/b_id/7" <?php if($_SESSION['query']['b_id']==7) echo 'class="xuan"';?>>魅族</a>&nbsp;
                            <a href="__ACTION__/b_id/10" <?php if($_SESSION['query']['b_id']==10) echo 'class="xuan"';?>>诺基亚</a>&nbsp;
                            <a href="__ACTION__/b_id/9" <?php if($_SESSION['query']['b_id']==9) echo 'class="xuan"';?>>中兴</a>&nbsp;
                            <a href="__ACTION__/b_id/5" <?php if($_SESSION['query']['b_id']==5) echo 'class="xuan"';?>>酷派</a>&nbsp;
                            <a href="__ACTION__/b_id/12" <?php if($_SESSION['query']['b_id']==12) echo 'class="xuan"';?>>金士顿</a>&nbsp;
                        </div>
                        <div class="screeBox">
                            <strong>价格：</strong>
                            <a href="__ACTION__/b_price/0" <?php if(empty($_SESSION['query']['b_price'])) echo 'class="xuan"';?> >全部</a>&nbsp;
                            <a href="__ACTION__/b_price/0 and 1000" <?php if($_SESSION['query']['b_price']=='0 and 1000') echo 'class="xuan"';?> >0&nbsp;-&nbsp;1000</a>&nbsp;
                            <a href="__ACTION__/b_price/1000 and 3000" <?php if($_SESSION['query']['b_price']=='1000 and 3000') echo 'class="xuan"';?> >1000&nbsp;-&nbsp;3000</a>&nbsp;
                            <a href="__ACTION__/b_price/3000 and 5000" <?php if($_SESSION['query']['b_price']=='3000 and 5000') echo 'class="xuan"';?> >3000&nbsp;-&nbsp;5000</a>&nbsp;
                            <a href="__ACTION__/b_price/5000 and 8000" <?php if($_SESSION['query']['b_price']=='5000 and 8000') echo 'class="xuan"';?> >5000&nbsp;-&nbsp;8000</a>&nbsp;
                        </div>
                        <div class="screeBox">
                            <strong>其他 :</strong>
                            <a href="__ACTION__" <?php if(empty($_SESSION['query']['is_hot'])&&empty($_SESSION['query']['is_new'])&&empty($_SESSION['query']['is_best'])) echo 'class="xuan"';?> >全部</a>
                            <a href="__ACTION__/b_hot/1" <?php if($_SESSION['query']['is_hot']==1) echo 'class="xuan"';?>>热卖</a>&nbsp;
                            <a href="__ACTION__/b_new/1" <?php if($_SESSION['query']['is_new']==1) echo 'class="xuan"';?>>新品</a>&nbsp;
                            <a href="__ACTION__/b_best/1" <?php if($_SESSION['query']['is_best']==1) echo 'class="xuan"';?>>精品</a>&nbsp;
                        </div>
                       <!-- <div class="screeBox">
                            <strong>屏幕大小 :</strong>
                            <span>全部</span>
                            <a href="#">1.75英寸</a>&nbsp;
                            <a href="#">2.0英寸</a>&nbsp;
                            <a href="#">2.2英寸</a>&nbsp;
                            <a href="#">2.6英寸</a>&nbsp;
                            <a href="#">2.8英寸</a>&nbsp;
                        </div>
                        <div class="screeBox">
                            <strong>手机制式 :</strong>
                            <span>全部</span>
                            <a href="#">CDMA</a>&nbsp;
                            <a href="#">GSM,850,900,1800,1900</a>&nbsp;
                            <a href="#">GSM,900,1800,1900,2100</a>&nbsp;
                        </div>
                        <div class="screeBox">
                            <strong>外观样式 :</strong>
                            <span>全部</span>
                            <a href="#">滑盖</a>&nbsp;
                            <a href="#">直板</a>&nbsp;
                        </div>-->
                    </div>
                </div>
                <div class="blank"></div>


               <!--   <div class="itemTit" id="itemBest">

                    <div class="tit">精品推荐</div>
                </div>
                <div id="show_best_area" class="clearfix">
                <?php  foreach($bestdata as $v){?>
                    <div class="goodsItem">

                        <a href="__GROUP__/Goods/detail/id/<?php echo $v['id']; ?>"><img src="__UPLOAD__/<?php echo $v['goods_thumb']; ?>" alt="诺基亚E66" class="goodsimg"></a><br />
                        <p class="f1"><a href="#" title="诺基亚E66"><?php echo $v['goods_name']; ?></a></p>
                        <font class="market">￥<?php echo $v['shop_price']*1.2; ?>元</font><br />
                        <font class="f1">
                            ￥<?php echo $v['shop_price']; ?>元                     </font>
                    </div>
                <?php  }?> 
                   

                </div>-->
                <div class="blank"></div>
                <div class="box">
                    <div class="box_1">
                        <h3>
                            <span>商品列表</span>
                            <form method="GET" class="sort" name="listform">
                                显示方式：
                                <a href="#"><img src="__HIMG__/display_mode_list.gif" alt=""></a>
                                <a href="#"><img src="__HIMG__/display_mode_grid_act.gif" alt=""></a>
                                <a href="#"><img src="__HIMG__/display_mode_text.gif" alt=""></a>&nbsp;&nbsp;

                                <a href="#"><img src="__HIMG__/goods_id_DESC.gif"  alt="按上架时间排序"></a>
                                <a href="#"><img src="__HIMG__/shop_price_default.gif" alt="按价格排序"></a>
                                <a href="#"><img src="__HIMG__/last_update_default.gif" alt="按更新时间排序"></a>
                                <input name="category" value="3" type="hidden" />
                                <input name="display" value="grid" id="display" type="hidden" />
                                <input name="brand" value="0" type="hidden" />
                                <input name="price_min" value="0" type="hidden" />
                                <input name="price_max" value="0" type="hidden" />
                                <input name="filter_attr" value="0" type="hidden" />
                                <input name="page" value="1" type="hidden" />
                                <input name="sort" value="goods_id" type="hidden" />
                                <input name="order" value="DESC" type="hidden" />
                            </form>
                        </h3>
                        <form name="compareForm" action="compare.php" method="post" onsubmit="return compareGoods(this);">
                            <div class="clearfix goodsBox" style="border: medium none; padding: 11px 0pt 10px 5px;">
                                
                               
                                
                               <?php  foreach($goodsdata as $v){?>
                                <div class="goodsItem">
                                    <a href="__GROUP__/Goods/detail/id/<?php echo $v['id']; ?>"><img src="__UPLOAD__/<?php echo $v['goods_thumb']; ?>" alt="诺基亚5320..." class="goodsimg"></a><br />
                                    <p><a href="__GROUP__/Goods/detail/id/<?php echo $v['id']; ?>" title="<?php echo $v['goods_name']; ?>"><?php echo $v['goods_name']; ?></a></p>
                                    <font class="market_s">￥<?php echo $v['shop_price']*1.2; ?>元</font><br />
                                    <font class="shop_s">￥<?php echo $v['shop_price']; ?>元</font><br />
                                    <a href="#"><img src="__HIMG__/goumai.gif"></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#;"><img src="__HIMG__/shoucang.gif"></a>
                                </div>
                                <?php  }?>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="blank5"></div>
                <form name="selectPageForm" action="/category.php" method="get">
                    
                        <?php echo ($page); ?>   
                      
                </form>
            </div>  

        </div>

        </div>

        <div class="blank"></div>
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