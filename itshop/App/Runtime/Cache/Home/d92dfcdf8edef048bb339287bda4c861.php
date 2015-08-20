<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />

        <title>爱购商城 - Powered by Wangweia</title>

        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="__JS__/jquery.js"></script>
        <style type="text/css">
            table {border:1px solid #dddddd; border-collapse: collapse; width:99%; margin:auto;}
            td {border:1px solid #dddddd;}
            #consignee_addr {width:450px;}
        </style>
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
                当前位置: <a href="#">首页</a> <code>&gt;</code> 购物流程 
            </div>
        </div>
        <div class="blank"></div>

        <div class="blank"></div>
        <div class="block">
            <div class="flowBox">
                <h6><span>商品列表</span></h6>
                <form id="formCart">
                    <table cellpadding="5" cellspacing="1">
                        <tbody><tr>
                                <th>商品名称</th>
                                <th>属性</th>
                                <th>市场价</th>
                                <th>本店价</th>
                                <th>购买数量</th>
                                <th>小计</th>
                                <th>操作</th>
                            </tr>
                            <?php foreach($listdata as $v) {?>
                            <tr>
                                <td align="center">
                                    <a href="__GROUP__/Goods/detail/id/<?php  echo $v['goods_id'];?>" target="_blank"><img style="width: 80px; height: 80px;" src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" title="P806" /></a><br />
                                    <a href="__GROUP__/Goods/detail/id/<?php  echo $v['goods_id'];?>" target="_blank" class="f6"><?php  echo $v['goods_name'];?></a>
                                </td>
                                <td><?php  echo $v['goods_attr'];?>
                                </td>
                                <td align="right">￥<?php  echo $v['shop_price']*1.2;?>元</td>
                                <td align="right">￥<?php  echo $v['shop_price'];?>元</td>
                                <td align="right">
                                     <a href="javascript:" class="dec"><img src="__HIMG__/bag_close.gif"/></a><input name="goods_number[43]" id="goods_number_43" value="<?php  echo $v['goods_number'];?>" size="4" class="inputBg" style="text-align: center;" onkeydown="showdiv(this)" type="text" />
                                     <a href="javascript:" class="add"><img src="__HIMG__/bag_open.gif"/></a><input type="hidden" name="id" value="<?php echo $v['id'] ?>"/>
                                </td>
                                <td align="right">￥<span><?php  echo ($v['goods_attr_price']+$v['shop_price'])*$v['goods_number'];?>元</span></td>
                                <td align="center">
                                    <a href="__URL__/delItem/id/<?php  echo $v['id'];?>" class="f6">删除</a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                        </table>
                    <table cellpadding="5" cellspacing="1">
                        <tbody><tr>
                                <td>
                                    购物金额小计 ￥<span id="total_price"><?php  echo $total_price;?></span>元 </td>
                                <td align="right">
                                    <input value="清空购物车" class="bnt_blue_1"  type="button" onclick="window.location.href='__URL__/clearCart'" />
                                    <input name="submit" class="bnt_blue_1" value="更新购物车" type="submit" />
                                </td>
                            </tr>
                        </tbody></table>
                    <input name="step" value="update_cart" type="hidden" />
                </form>
                <table cellpadding="5" cellspacing="0" width="99%">
                    <tbody><tr>
                            <td><a href="#"><img src="__HIMG__/continue.gif" alt="continue" /></a></td>
                            <td align="right"><a href="__GROUP__/Order/checkout"><img src="__HIMG__/checkout.gif" alt="checkout" /></a></td>
                        </tr>
                    </tbody></table>
            </div>
            <div class="blank"></div>
            <div class="blank5"></div>
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
<script>
//四舍五入函数
function toDecimal(x) {   
    var f = parseFloat(x);               

if (isNaN(f)) {   
        return;               

}              

f = Math.round(x*100)/100;              

return f;           

}  

//给class=dec的标签添加单击事件
$(".dec").click(function(){
         //取出当前的购买数量
         var curr_num = parseInt($(this).next().val());
          //新的购买数量
          var new_num =  curr_num-1;
          if(curr_num<=1){
				return false;
          }
          
          //算出商品单价的价格（包含属性）  小计价格除以商品的数量
          //找出小计价格。
          var xiaoji_price = parseFloat($(this).parent().parent().find("span").html());
         //算出商品的单价：小计价格除以商品的数量
         var dan_price =  parseFloat(xiaoji_price/curr_num);
        
         //新的小计价格是：原来的小计价格+商品的单价
         var new_xiaoji_price = parseFloat(xiaoji_price-dan_price).toFixed(2);
         
         //查出原来购物总金额
         var total_price =parseFloat($("#total_price").html());
         
         //新的购物总的金额：原来的购物总的金额+商品的单价。
         var new_total_price = (total_price - dan_price).toFixed(2);
         //通过ajax修改数据库里面的数量
        //查找出当前购物车数据的id
            var id = $(this).parent().find("input:last").val();
            
            var _this = $(this);
            //发送ajax
            $.ajax({
                type:'get',
                url:'__URL__/updatecartdec/id/'+id,
                success:function(msg){
                    if(msg=='ok'){
                            //表示修改数据库成功，
                            //成功之后，把新的小计价格和新的数据量和新的总额，显示到相应的位置。
                           _this.next().val(new_num);//赋予新的购买数量
                            //赋予新的小计价格
                           _this.parent().parent().find("span").html(new_xiaoji_price);
                            //赋予新的总额
                            $("#total_price").html(new_total_price);
                    }
                }
         }); 
});  

//给class=add的标签添加单击事件
$(".add").click(function(){
         //取出当前的购买数量
         var curr_num = parseInt($(this).prev().val());
          //新的购买数量
          var new_num =  curr_num+1;
          //算出商品单价的价格（包含属性）  小计价格除以商品的数量
          //找出小计价格。
          var xiaoji_price = parseFloat($(this).parent().parent().find("span").html());
         //算出商品的单价：小计价格除以商品的数量
         var dan_price =  parseFloat(xiaoji_price/curr_num);
         //新的小计价格是：原来的小计价格+商品的单价
         var new_xiaoji_price = parseFloat(xiaoji_price+dan_price).toFixed(2);
         //查出原来购物总金额
         var total_price =parseFloat($("#total_price").html());
         //新的购物总的金额：原来的购物总的金额+商品的单价。
         var new_total_price = parseFloat(total_price + dan_price).toFixed(2);
         //通过ajax修改数据库里面的数量
        //查找出当前购物车数据的id
            var id = $(this).parent().find("input:last").val();
            var _this = $(this);
      $.ajax({
            type:'get',
            url:'__URL__/updatecart/id/'+id,
            success:function(msg){
                if(msg=='ok'){
                        //表示修改数据库成功，
                        //成功之后，把新的小计价格和新的数据量和新的总额，显示到相应的位置。
                       _this.prev().val(new_num);//赋予新的购买数量
                        //赋予新的小计价格
                       _this.parent().parent().find("span").html(new_xiaoji_price);
                        //赋予新的总额
                        $("#total_price").html(new_total_price);
                }
            }
         });     
});

</script>