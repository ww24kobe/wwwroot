<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />

        <title>爱购商城 - Powered by Wangwei</title>

        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            table {border:1px solid #dddddd; border-collapse: collapse; width:100%; margin:auto;}
            td {border:1px solid #dddddd;}
            #consignee_addr {width:450px;}
        </style>
        <script type="text/javascript" src="__JS__/jquery.js"></script>
<script>
  $(function(){
	  $('.showgoods').mouseover(function(){
		var  position=$(this).offset();
		$("#goods").css('display','block');
		$('#goods').css('left',position.left+50);
		$('#goods').css('top',position.top+15);
		var order_sn=$(this).html();
		//发送ajax
		$.ajax({
			type:'get',
		 	url:'__URL__/ajax/sn/'+order_sn,
		 	success:function(msg){
		 		$('#goods').html(msg);
		 	}
			
			
		});
	  });
	  
	  $('.showgoods').mouseout(function(){
		  $("#goods").css('display','none');
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
                当前位置: <a href="/">首页</a> <code>&gt;</code> 我的订单 
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
                            </div>     
						</div>
                    </div>
                </div>
            </div>

            <div class="AreaR">
                <div class="box">
                    <div class="box_1">
                        <div class="userCenterBox boxCenterList clearfix" style="">
                            <h5><span>我的订单</span></h5>
                            <div class="blank"></div>
                            <table cellpadding="5" cellspacing="1">
                                <tbody><tr align="center">
                                        <td>订单号</td>
                                        <td>下单时间</td>
                                        <td>订单总金额</td>
                                        <td>订单状态</td>
                                        <td>操作</td>
                                    </tr>
                                    <?php  foreach($orderdata as $v){?>
                                    <tr>
                                        <td align="center"><a class="showgoods" href="#" class="f6"><?php  echo $v['order_sn'];?></a></td>
                                        <td align="center"><?php  echo date('Y-m-d H:i:s',$v['add_time']);?></td>
                                        <td align="right">￥<?php  echo $v['goods_amount'];?>元</td>
                                        <td align="center"><?php  echo $v['info'];?></td>
                                        <td align="center"><font class="f6"><a onclick="return  confirm('确认删除订单吗？');" href="__GROUP__/Order/cancelOrder/order_sn/<?php  echo $v['order_sn'];?>/id/<?php  echo $v['id'];?>" >删除订单</a></font>&nbsp;&nbsp;&nbsp;
                                        
                                        
                                        <?php  if($v['status']==6){ echo '<a href="javascript:" target="_blank">完成支付</a>'; }else{ echo '<a href="__GROUP__/Order/done/order_sn/'.$v['order_sn'].'/total_price/'.$v['goods_amount'].'" target="_blank">去支付</a>'; } ?>
                                        </td>
                                    </tr>
                                    <?php  }?>
                                </tbody></table>
                            <div class="blank5"></div>

                            <form action="/user.php" method="get">

                                <div id="pager" class="pagebar">
                                    <span class="f_l " style="margin-right: 10px;">总计 <b><?php echo count($orderdata);?></b>  个记录</span>

                                </div>

                            </form>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank"></div>
        
        <div id='goods' style="display:none;border:1px solid  red;position:absolute">fsdfsd</div>
    </body>
</html>