<?php if (!defined('THINK_PATH')) exit();?><!doctype  html>
<html>
        <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />

        <title>爱购商城 - Powered by WangweiDa</title>

        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="__JS__/jquery.js"></script>
          <script type="text/javascript" src="__JS__/city.min.js"></script>
   		 <script type="text/javascript" src="__JS__/jquery.cityselect.js"></script>
   		
    <script>
      $(function(){
       $("#city_4").citySelect({
    	prov:"江西", 
    	
	}); 
      
      });
    
    </script>
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
                当前位置: <a href="#">首页</a> <code>&gt;</code> 收货地址
            </div>
        </div>

        <div class="blank"></div>
        <div class="blank"></div>

        <div class="block clearfix">
            <div class="AreaL">
                <div class="box">
                    <div class="box_1">
                        <div class="userCenterBox">
                            <div class="userMenu">
                               <a href="__GROUP__/User/center"  <?php if(ACTION_NAME=='center') echo "class='curs'";?> ><img src="__HIMG__/u1.gif" /> 欢迎页</a>
<a href="__GROUP__/User/updatepass" ><img src="__HIMG__/u3.gif" />修改密码</a>
<a href="__GROUP__/User/ucenter3" <?php if(ACTION_NAME=='ucenter3') echo "class='curs'"; ?>><img src="__HIMG__/u3.gif" /> 我的订单</a>
<a href="__GROUP__/User/ucenter2" <?php if(ACTION_NAME=='ucenter2') echo "class='curs'"; ?>><img src="__HIMG__/u4.gif" /> 收货地址</a>
<a href="__GROUP__/User/umessage" <?php if(ACTION_NAME=='umessage') echo "class='curs'"; ?>><img src="__HIMG__/u6.gif" /> 在线留言</a>
<!--  <a href="#"><img src="__HIMG__/u5.gif" /> 我的收藏</a>
<a href="#"><img src="__HIMG__/u7.gif" /> 我的标签</a>
<a href="#"><img src="__HIMG__/u8.gif" /> 缺货登记</a>
<a href="#"><img src="__HIMG__/u9.gif" /> 我的红包</a>
<a href="#"><img src="__HIMG__/u10.gif" /> 我的推荐</a>
<a href="#"><img src="__HIMG__/u11.gif"> 我的评论</a>
<a href="user.php?act=group_buy">我的团购</a>
<a href="#"><img src="__HIMG__/u12.gif" /> 跟踪包裹</a>
<a href="#"><img src="__HIMG__/u13.gif" /> 资金管理</a>
<a href="#" style="background: none repeat scroll 0% 0% transparent; text-align: right; margin-right: 10px;">
<img src="__HIMG__/bnt_sign.gif" /></a>-->
                            </div>      </div>
                    </div>
                </div>
            </div>

            <div class="AreaR">
                <div class="box">
                    <div class="box_1">
                        <div class="userCenterBox boxCenterList clearfix" style="">
                            <h5><span>收货人信息</span></h5>
                            <div class="blank"></div>
                            <form action="__ACTION__" method="post" name="theForm">
                                <table bgcolor="#dddddd" border="0" cellpadding="5" cellspacing="1" width="100%">
                                    <tbody><tr>
                                            <td align="right" bgcolor="#ffffff">配送区域：</td>
                                            <td colspan="3" align="left" bgcolor="#ffffff">
                                                <div id="city_4">
												<select name="province" class="prov"></select> 
												<select name="city" class="city" ></select>
												<select name="district" class="dist" ></select>
											</div>
                                                (必填) </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">收货人姓名：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="consignee" required class="inputBg" id="consignee_0" value="<?php  echo $address['consignee']?>" type="text" />
                                                (必填) </td>
                                            <td align="right" bgcolor="#ffffff">电子邮件地址：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="email"  class="inputBg" id="email_0" required value="<?php  echo $address['email']?>" type="email" />
                                                (必填)</td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">详细地址：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="address" required class="inputBg" id="address_0" value="<?php  echo $address['address']?>" type="text" />
                                                (必填)</td>
                                            <td align="right" bgcolor="#ffffff">邮政编码：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="zipcode" required class="inputBg" id="zipcode_0" value="<?php  echo $address['zipcode']?>" type="text" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">电话：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="tel" class="inputBg" id="tel_0" value="<?php  echo $address['tel']?>" type="text" />
                                                (必填)</td>
                                            <td align="right" bgcolor="#ffffff">手机：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="mobile" class="inputBg" required id="mobile_0" value="<?php  echo $address['mobile']?>" type="text" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">标志建筑：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="sign_building" class="inputBg" id="sign_building_0" type="text" value="<?php  echo $address['sign_building']?>"/></td>
                                            <td align="right" bgcolor="#ffffff">最佳送货时间：</td>
                                            <td align="left" bgcolor="#ffffff">
                                                <input name="best_time" class="inputBg" id="best_time_0" type="text" value="<?php  echo $address['best_time']?>" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">&nbsp;</td>
                                            <td colspan="3" align="center" bgcolor="#ffffff">                    
                                                <input name="submit" class="bnt_blue_1" value="确认修改" type="submit" />
                                                <input name="button" class="bnt_blue" value="删除" type="button" />
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <input type="hidden" name="id" value="<?php  echo $address['id']?>" />
                            </form>
                            
                        </div>
                    </div>
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