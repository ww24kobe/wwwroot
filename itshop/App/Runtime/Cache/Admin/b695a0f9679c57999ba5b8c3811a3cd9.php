<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>爱购管理中心 - 添加新商品 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script type="text/javascript">

$(function(){
    //给显示属性的select添加change事件
    $("#showattr").change(function(){
        //取出option选项里面的值
        var type_id = $(this).val();
        ///传递type_id获取对应的属性信息
        $.ajax({
            type:'get',
            url:'__URL__/showattr/type_id/'+type_id,
            //返回的属性信息要根据属性自己的特点生成表单  
           success:function(msg){  
        	   //alert(msg);
                $("#listattr").html(msg);    
            }     
        });

    });


});







function charea(a) {
    var spans = ['general','detail','mix','attr','level'];
    for(i=0;i<5;i++) {
        var o = document.getElementById(spans[i]+'-tab');
        var tb = document.getElementById(spans[i]+'-table');
        o.className = o.id==a+'-tab'?'tab-front':'tab-back';
        tb.style.display = tb.id==a+'-table'?'block':'none';
    }
    
}
</script>
</head>
<body>

<h1>
<span class="action-span"><a href="__URL__/goodslist">商品列表</a></span>
<span class="action-span1"><a href="__GROUP__" target="_parent">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加新商品 </span>
<div style="clear:both"></div>
</h1>

<!-- start goods form -->
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab" onclick="charea('general');">通用信息</span>
        <span class="tab-back" id="detail-tab" onclick="charea('detail');">详细描述</span>
        <span class="tab-back" id="mix-tab" onclick="charea('mix');">其他信息</span>
        <span class="tab-back" id="attr-tab" onclick="charea('attr');">商品属性</span>
        <span class="tab-back" id="level-tab" onclick="charea('level');">会员等级</span>

      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="__ACTION__" method="post" name="theForm" >
        <!-- 最大文件限制 -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <!-- 通用信息 -->
        <table width="90%" id="general-table" align="center">
          <tr>
            <td class="label">商品名称：</td>
            <td><input type="text" name="goods[goods_name]" value="" style="float:left;color:;" size="30" /></td>
          </tr>
          <tr>
            <td class="label">
            <a href="#" title="点击此处查看提示信息"><img src="__AIMG__/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品货号： </td>
            <td><input type="text" name="goods[goods_sn]" value="" size="20"  /><span id="goods_sn_notice"></span><br />
            <span class="notice-span" style="display:block"  id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
          </tr>
          <tr>
            <td class="label">商品分类：</td>
            <td><select name="goods[cat_id]"  ><option value="0">请选择...</option>
            <?php foreach($catdata as $v){?>
                        <option value="<?php echo $v['id']?>"><?php echo str_repeat('--',$v['lev']).$v['cat_name']?></option>
            <?php }?>
            </select>
             </td>
          </tr>
          <tr>
            <td class="label">商品品牌：</td>
            <td><select name="goods[brand_id]"  >
            <?php foreach($branddata as $v){?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['b_name']?></option>
            <?php }?>
            </select>
             </td>
          </tr>
                   <tr>
            <td class="label">本店售价：</td>
            <td><input type="text" name="goods[shop_price]" value="0" size="20" /></td>
          </tr>
          
          <tr>
            <td class="label">上传商品图片：</td>
            <td>
              <input type="file" name="photo" size="35" />  
              
            </td>
          </tr>
        </table>

        <!-- 详细描述 -->
        <table width="90%" id="detail-table" style="display:none">
          <tr>
            <td><textarea name="goods[goods_desc]" rows="5" cols="50"></textarea></td>
          </tr>
        </table>

        <!-- 其他信息 -->
        <table width="90%" id="mix-table" style="display:none" align="center">
          <tr>
            <td class="label"><a href="#" title="点击此处查看提示信息"><img src="__AIMG__/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>

            <td><input type="text" name="goods[goods_number]" value="1" size="20" />
          </tr>
                    <tr>
            <td class="label">加入推荐：</td>
            <td><input type="checkbox" name="goods[is_best]" value="1"  />精品 <input type="checkbox" name="goods[is_new]" value="1"  />新品 <input type="checkbox" name="goods[is_hot]" value="1"  />热销</td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="is_sale">上架：</td>
            <td id="alone_sale_3"><input type="checkbox" name="goods[is_sale]" value="1" checked="checked" /> 打勾表示允许销售，否则不允许销售。</td>
          </tr>
          <tr>
            <td class="label">商品关键词：</td>
            <td><input type="text" name="goods[keywords]" value="" size="40" /> 用空格分隔</td>
          </tr>
          <!-- <tr>
            <td class="label">商品简单描述：</td>
            <td><textarea name="" cols="50" rows="5"></textarea></td>
          </tr> -->
        </table>
         <!-- 商品属性 -->
        <table width="50%" id="attr-table" style="display:none" align="center">
          <tr>
            <td>商品类型：<select id="showattr" name="goods[goods_type]">
                <option>选择商品类型</option>
                <?php foreach($typedata as $v){ ?>
                                <option value="<?php echo $v['id']?>"><?php echo $v['type_name']?></option>
                <?php }?>
            </select></td>
          </tr>
          <tr><td><div id="listattr"> </div></td></tr>
        </table>
      <!-- 等级价格 -->
        <table width="50%" id="level-table" style="display:none" align="center">
        <?php foreach($memberlevel as $v){?>
          <tr> 
                <td><?php echo $v['level_name']?></td>
                <td><input type="text" name="level[<?php echo $v['id']?>]" value="-1"/></td>
          </tr>         
        <?php }?>
        <tr><td colspan="2">会员价格为-1时表示会员价格按会员等级折扣率计算。</td></tr>
        </table>
        <div class="button-div">
         
          <input type="submit" value=" 确定 " class="button" />
          <input type="reset" value=" 重置 " class="button" />
        </div>
        
      </form>
    </div>
</div>
<!-- end goods form -->

</body>
</html>