<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="SMS EMS MMS 短消息群发 语音 阅读器 SMS,EMS,MMS,短消息群发语音合成信息阅读器 黑色 白色 滑盖" />
        <meta name="Description" content="" />
        
        <title>爱购商城 - Powered by Wangwei</title>
        <link rel="shortcut icon" href="__HIMG__/ico.ico" type="image/x-icon" />
        <link href="__HCSS__/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="__JS__/magiczoomplus/magiczoomplus.css" />
        <script type="text/javascript" src="__JS__/jquery.js"></script>
        <script type="text/javascript" src="__JS__/magiczoomplus/magiczoomplus.js"></script>
    </head>
    <body style="cursor: auto;">
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
                当前位置: <a href="/">首页 </a> <code>&gt;</code> 
                <?php  foreach($navdata as $v){?>
                <a href="__GROUP__/Category/category/id/<?php  echo $v['id'];?>"><?php  echo $v['cat_name'];?></a> <code>&gt;</code> 
                <?php }?>
                <?php echo $goodsinfo['goods_name'];?> 
            </div>
        </div>
        <div class="blank"></div>



        <div class="block clearfix">
            <div class="AreaL">
                <h3><span>商品分类</span></h3> 
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
                        <?php  foreach($visitdata as $v){?>
                            <ul class="clearfix"><li class="goodsimg">
                            <a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" target="_blank"><img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>" alt="夏新N7" class="B_blue"></a></li>
                            <li><a href="__GROUP__/Goods/detail/id/<?php  echo $v['id'];?>" target="_blank" title="夏新N7"><?php  echo $v['goods_name'];?></a><br />本店售价：<font class="f1">￥<?php  echo $v['shop_price'];?>元</font><br /></li>
                            </ul>
                            <?php  }?>
                            <ul id="clear_history"><a href="__GROUP__/Goods/clearVisit" onclick="clear_history()">[清空]</a></ul> 
                       </div>
                    </div>
                </div>
                <div class="blank5"></div>
            </div>

            <div class="AreaR">
                <div id="goodsInfo" class="clearfix">
                    <div class="imgInfo">
                        <a style="position: relative; display: block; outline: 0pt none; text-decoration: none; width: 310px; -moz-user-select: none;" href="__UPLOAD__/<?php echo $goodsinfo['goods_ori'];?>" id="zoom1" class="MagicZoomPlus"" title="<?php echo $goodsinfo['goods_name'];?> ">
                            <img id="sim806035" src="__UPLOAD__/<?php echo $goodsinfo['goods_img'];?>" alt="<?php echo $goodsinfo['goods_name'];?> " height="310px" width="310px;" />
                            <div class="MagicZoomBigImageCont" style="width: 200px; height: 269px; overflow: hidden; z-index: 100; visibility: visible; position: absolute; top: -10000px; left: 327px; display: block;" id="bc806035">
                                <div style="position: relative; z-index: 10; left: 0px; top: 0px; padding: 3px;" id="MagicZoomHeaderbc806035" class="MagicZoomHeader"><?php echo $goodsinfo['goods_name'];?> 
                                </div>
                                <div style="overflow: hidden;">
                                    <img style="position: relative; border-width: 0px; padding: 0px; left: 0px; top: 0px; display: block; visibility: visible;" src="__HIMG__/9_P_1241511871575.jpg" />
                                </div>
                                <div style="color:red; font-size: 10px; font-weight: bold; font-family: Tahoma; position: absolute; width: 100%; text-align: center; left: 0px; top: 249px;">
                                </div>
                            </div>
                            <div style="z-index: 10; visibility: hidden; position: absolute; opacity: 0.5; width: 98px; height: 98px; left: 31px; top: 1px;" class="MagicZoomPup">
                            </div>
                        </a>
                        <div class="blank5"></div>
                        <div style="text-align: center; position: relative; width: 100%;">
                            <a href="#">
                                <img style="position: absolute; left: 0pt;" alt="prev" src="__HIMG__/up.gif" /></a>
                            <a href="javascript:;" >
                                <img alt="zoom" src="__HIMG__/zoom.gif" />
                            </a>
                            <a href="#">
                                <img style="position: absolute; right: 0pt;" alt="next" src="__HIMG__/down.gif" /></a>
                        </div>
                        <div class="blank5"></div>

                        <div class="picture" id="imglist">
                            <a style="outline: 0pt none;" href="javascript:" rel="zoom1" rev="images/200905/goods_img/9_P_1241511871575.jpg" title="">
                                <img src="__UPLOAD__/<?php echo $goodsinfo['goods_thumb'];?>" alt="诺基亚E66" class="onbg" /></a>
                        </div>
                    </div>

                    <div class="textInfo">
                        <form action="__GROUP__/Cart/addCart" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY">
                            <div class="clearfix" style="font-size: 14px; font-weight: bold; padding-bottom: 8px;">
                                <?php echo $goodsinfo['goods_name'];?>     
                            </div>
                            <ul>
                                <li class="clearfix">
                                    <dd>
                                        <strong>商品货号：</strong><?php echo $goodsinfo['goods_sn'];?>      
                                    </dd>
                                </li> 
                                <li class="clearfix">
                                    <dd>
                                        <strong>商品库存：</strong>
                                        <?php echo $goodsinfo['goods_number'];?> 台             
                                    </dd>
                                </li>  
                                <li class="clearfix">
                                    <dd>
                                        <strong>商品品牌：</strong><a href="#"><?php echo $branddata[$goodsinfo['brand_id']];?></a>
                                    </dd>
                                </li>  
                                <li class="clearfix">
                                    <dd>
                                        <strong>上架时间：</strong><?php echo date('Y-m-d',$goodsinfo['add_time']);?>      
                                    </dd>
                                </li>
                                
                                <li class="clearfix">
                                    <dd>
                                        <strong>市场价格：</strong><font class="market">￥<?php echo $goodsinfo['shop_price']*1.2;?>元</font><br />

                                        <strong>本店售价：</strong><font class="shop" id="ECS_SHOPPRICE">￥<?php echo $goodsinfo['shop_price'];?>元</font><br />  
                                        <?php foreach($memberprice as $v){?>
                                        <strong><?php echo $v['level_name'];?>：</strong><font class="shop" id="ECS_RANKPRICE_1">￥<?php echo round($v['price'],2);?>元</font><br />
                                    	<?php  }?>
                                    </dd>
                                </li>
                               <!--   <li class="clearfix">
                                    <dd>
                                        <strong>用户评价：</strong>
                                        <img src="__HIMG__/stars5.gif" alt="comment rank 5">
                                    </dd>
                                </li>-->
                                <!-- <li class="padd">
                                    <font class="f1">购买商品达到以下数量区间时可享受的优惠价格：</font><br />
                                    <table bgcolor="#aad6ff" border="0" cellpadding="3" cellspacing="1" width="100%">
                                        <tbody><tr>
                                                <td align="center" bgcolor="#ffffff"><strong>数量</strong></td>
                                                <td align="center" bgcolor="#ffffff"><strong>优惠价格</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="shop" align="center" bgcolor="#ffffff">3</td>
                                                <td class="shop" align="center" bgcolor="#ffffff">￥2200元</td>
                                            </tr>
                                            <tr>
                                                <td class="shop" align="center" bgcolor="#ffffff">5</td>
                                                <td class="shop" align="center" bgcolor="#ffffff">￥2100元</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </li>-->
                                <!--  <li class="clearfix">
                                    <dd>
                                        <strong>商品总价：</strong><font id="ECS_GOODS_AMOUNT" class="shop">￥2298元</font>
                                    </dd>
                                </li>-->
                                <li class="clearfix">
                                    <dd>
                                        <strong>购买数量：</strong>
                                        <input name="goods_number" id="number" value="1" size="4" onblur="changePrice()" style="border: 1px solid rgb(204, 204, 204);" type="text" />
                                    </dd>
                                </li>
                                <li class="clearfix">
                                    <dd>
                                        <strong>购买此商品可使用：</strong><font class="f4">2200 积分</font>
                                    </dd>
                                </li>
								<?php  foreach($attrdata as $k=>$v){?>
                                <li class="padd loop">
                                    <strong><?php echo $k;?>:</strong>
                                    <?php  foreach($v as $k1=>$v1){?>
                                    <label for="spec_value_227">
                                        <input name="attr[<?php echo $v1['attr_id'];?>]" value="<?php echo $v1['attr_value'];?>" id="spec_value_227" checked="checked" onclick="changePrice()" type="radio" />
                                        <?php echo $v1['attr_value'];?> [ ￥<?php echo $v1['attr_price'];?>元] </label>
                                    <?php }?>
                                    
                                </li>
								 <?php }?>
                                <li class="padd">
                                    <a href="javascript:" onclick="addCart()"><img src="__HIMG__/goumai2.gif"></a>
                                   <!--   <a href="#"><img src="__HIMG__/shoucang2.gif"></a> -->
                                </li>
                            </ul>
                            <input name="goods_id" value="<?php echo $goodsinfo['id'];?>" type="hidden" />
                            <input name="goods_name" value="<?php echo $goodsinfo['goods_name'];?>" type="hidden" />
                        </form>
                    </div>
                </div>
                <div class="blank"></div>
                <div class="box">
                    <div class="box_1">
                        <h3 style="padding: 0pt 5px;">
                            <div id="com_b" class="history clearfix">
                                <h2 style="cursor: pointer;">商品描述：</h2>
                              <!--    <h2 style="cursor: pointer;" class="h2bg">商品属性</h2>-->
                            </div>
                        </h3>
                        <div id="com_v" class="boxCenterList RelaArticle">
                            <p><?php echo $goodsinfo['goods_desc'];?></p>       
                        </div>
                    </div>
                    <div class="box">
                        <div class="box_1">
                            <h3><span class="text">用户评论</span>(共<font class="f1"><?php echo ($count); ?></font>条评论)</h3>
                            <div class="boxCenterList clearfix" style="height: 1%;">
                                <ul class="comments">
                                    
                                    <?php  if(empty($commentdata)){ echo "<li>暂时还没有任何用户评论</li>"; } $k=1; foreach($commentdata as $v){?>
                                    <li><?php  if($v['u_id']==0){ echo 匿名用户.'说:'.$v['content']; }else{ echo $userdata[$v['u_id']].'说:'.$v['content']; } ?>
                                    
                                    </li>
                                    <?php  }?>
                                </ul>

                                <div id="pagebar" class="f_r">
                                    <form name="selectPageForm" action="/goods.php" method="get">
                                        <div id="pager">
                                            总计 0 个记录，共 1 页。 <span> <a href="#">第一页</a> <a href="#">上一页</a> <a href="#">下一页</a> <a href="#">最末页</a> </span>
                                        </div>
                                    </form>
                                </div>

                                <div class="blank5"></div>

                                <div class="commentsList">
                                    <form action=""  method="post" name="commentForm" id="commentForm">
                                        <table border="0" cellpadding="0" cellspacing="5" width="710">
                                            <tbody>
                                            	<!-- <tr>
                                                    <td align="right" width="64">用户名：</td>
                                                    <td width="631">匿名用户</td>
                                                </tr> -->
                                               <!--   <tr>
                                                    <td align="right">E-mail：</td>
                                                    <td>
                                                        <input name="email" id="email" maxlength="100" class="inputBorder" type="text" />
                                                    </td>
                                                </tr>-->
                                                <tr>
                                                    <td align="right">评价等级：</td>
                                                    <td>
                                                        <input name="star" value="1" id="comment_rank1" type="radio" /> 
                                                        <img src="__HIMG__/stars1.gif" />
                                                        <input name="star" value="2" id="comment_rank2" type="radio" /> 
                                                        <img src="__HIMG__/stars2.gif" />
                                                        <input name="star" value="3" id="comment_rank3" type="radio" /> 
                                                        <img src="__HIMG__/stars3.gif" />
                                                        <input name="star" value="4" id="comment_rank4" type="radio" /> 
                                                        <img src="__HIMG__/stars4.gif" />
                                                        <input name="star" value="5" checked="checked" id="comment_rank5" type="radio" /> 
                                                        <img src="__HIMG__/stars5.gif" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" valign="top">评论内容：</td>
                                                    <td>
                                                        <textarea name="content" class="inputBorder"  required style="height: 50px; width: 620px;"></textarea>
                                                        <input name="goods_id" value="<?php echo ($goods_id); ?>" type="hidden" />
                                                    </td>
                                                </tr>
                                                  <tr>
                                                    <td colspan="2">
                                                       <!-- <div style="padding-left: 15px; text-align: left; float: left;">
                                                            验证码：<input name="captcha" class="inputBorder" style="width: 50px; margin-left: 5px;" type="text" />
                                                            <img src="__HIMG__/captcha.png" alt="captcha" onclick="this.src='captcha.php?'+Math.random()" class="captcha" />
                                                        </div>-->
                                                        <input   value="评论" id="comment" onclick="javascript:comment()" class="f_r bnt_blue_1" style="margin-right: 8px;"  />
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="blank"></div>
                    <div id="ECS_COMMENT"> 
                    
                    <div class="blank5"></div>

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
<script>
	//js购物车提交
 function addCart(){
	 $('#ECS_FORMBUY').submit();
 }
	
	//提交评论
 $('#comment').bind('click',function(){
	 var str=$("form[name=commentForm]").serialize();
	 $.ajax({
		 type:'get',
		 url:'__GROUP__/comment/addcomment',
		 data:str,
		 success:function(msg){
			 if(msg){
				 alert('评论成功');
				 window.location.href="__GROUP__/Goods/detail/id/"+msg;
			 }else{
				 alert('0000');
			 }
		 }
	 });
 });
</script>