<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />

        <title>爱购商城 - Powered by Wangwei</title>

        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
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
                当前位置: <a href="#">首页</a> <code>&gt;</code> 订单完成
            </div>
        </div>

        <div class="blank"></div>
        <div class="blank"></div>

        <div class="block">
            <div class="flowBox" style="margin: 0pt auto 70px;">
                <h6 style="text-align: center; height: 30px; line-height: 30px;">感谢您在本店购物！您的订单已提交成功，请记住您的订单号: <font style="color: red;"><?php echo $v_oid;?></font></h6>
                <table style="border: 1px solid rgb(221, 221, 221); margin: 20px auto;" align="center" bgcolor="#ffffff" border="0" cellpadding="15" cellspacing="0" width="99%">
                    <tbody>
                    <tr>
                            <td align="center" bgcolor="#ffffff">
                                您选定的配送方式为: <strong>城际快递</strong>，您选定的支付方式为: <strong>银行汇款/转帐</strong>。您的应付款金额为: <strong>￥<?php echo $total_price;?>元</strong>
                            </td>
                     </tr>
                     <tr>
                            <td align="center" bgcolor="#ffffff">
                            <form  action="https://pay3.chinabank.com.cn/PayGate" method="post">
                            <input type=hidden name=v_mid value="<?php echo $v_mid;?>">                  
							<input type=hidden name="v_oid" value="<?php echo $v_oid;?>">
							<input type=hidden name="v_amount" value="<?php echo $total_price;?>">       
							<input type=hidden name=v_moneytype value="CNY">                
							<input type=hidden name=v_url value="<?php echo $v_url;?>">
							<input type=hidden name=v_md5info value="<?php echo $v_md5info;?>">   
                            <input  type="submit" value="网银支付"/>
                            </form>
                            
                            </td>
                     </tr>
                        
                    </tbody>
                    </table>
                <p style="text-align: center; margin-bottom: 20px;">您可以 <a href="/">返回首页</a> 或去 <a href="#">用户中心</a></p>
            </div>
        </div>

        <div class="blank"></div>
        
    </body>
</html>