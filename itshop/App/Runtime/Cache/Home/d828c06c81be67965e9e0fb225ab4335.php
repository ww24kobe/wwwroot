<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="YONGDA商城" />
        <meta name="Description" content="YONGDA商城" />

        <title>YONGDA商城 - Powered by YongDa</title>

        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="index_body">
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

        <div class="block block1">  

            <div class="block box">
                <div class="blank"></div>
                <div id="ur_here">
                    当前位置: <a href="/">首页</a> <code>&gt;</code> 找回密码
                </div>
            </div>
            <div class="blank"></div>


            <!--放入view具体内容-->

            <div class="block box">

                <div class="usBox">
                    <div class="usBox_2 clearfix">
                      <!--    <div class="logtitle3"></div> -->
                        <form id="yw0" action="__ACTION__" method="post">           
                             <table cellpadding="5" cellspacing="3" style="text-align:left; width:100%; border:0;">
                                <tbody>
                                    <tr>
                                        <td style="width:13%; text-align: right;"><label for="User_username" class="required">用户名 
                                        <span class="required"></span></label>
                                        </td>

                                        <td style="width:87%;">
                                            <input class="inputBg" size="25" name="username" required="required" id="User_username" type="text" value="" />                  
                                            <span style="color:red;display:none">用户名已经存在</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"><label for="User_user_email">邮箱</label></td>
                                        <td>
                                            <input class="inputBg"  size="25" name="email" required="required" id="User_user_email" type="email"  value="" />    
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>&nbsp;</td>

                                        <td align="left">
                                            <input name="Submit"   type="submit"  value="找回密码"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>        </div>
                </div>
            </div>
            <!--放入view具体内容-->

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