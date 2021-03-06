<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加属性</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="__GROUP__/GoodsType/typeList">商品类型</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品类型 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="__ACTION__" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">属性名称:</td>
                <td>
                    <input type='text' name='attr_name' maxlength="20" value="<?php echo $attrinfo['attr_name'];?>" size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">商品的类型:</td>
                <td>
                    <select name="type_id">
                        
                        <?php foreach($typedata as $v) { if($v['id']==$attrinfo['type_id'] ){ $sel='selected="selected"'; }else{ $sel=''; } ?>
                           <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?> > <?php echo $v['type_name']; ?> </option>
                        <?php  }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">属性的类型:</td>
                <td>
                    <input type="radio" name='attr_type'  value="0" size="15"  <?php  if($attrinfo['attr_type']==0) echo "checked='true'" ?>/>唯一属性
                    <input type="radio" name='attr_type'  value="1" size="15"  <?php  if($attrinfo['attr_type']==1) echo "checked='true'" ?>/>单选属性
                </td>
            </tr>
            <tr>
                <td class="label">属性值录入方式:</td>
                <td>
                   <input type="radio" name='attr_input_type' id="shougong"  value="0" size="15" <?php  if($attrinfo['attr_input_type']==0) echo "checked='true'" ?> />手工录入
                    <input type="radio" name='attr_input_type' id="listsel"  value="1" size="15" <?php  if($attrinfo['attr_input_type']==1) echo "checked='true'" ?> />从下面列表中选择(多个用逗号隔开)
                </td>
            </tr>
         
            <tr>
                <td class="label" >可选值列表:</td>
                <td>
                    <textarea name='attr_value' id="textarea"><?php echo $attrinfo['attr_value'];?></textarea>
                </td>
            </tr>
        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
        <input type="hidden" name="id" value="<?php echo $attrinfo['id'];?>"/>
    </form>
</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
<script>
	$("input[id='shougong']").click(function(){
		var dis=$(this).attr('checked');
	    if(dis=='checked')	
			$('#textarea').attr('disabled','disabled');
	});	
	$("input[id='listsel']").click(function(){
		var dis=$(this).attr('checked');
	    if(dis=='checked')	
			$('#textarea').attr('disabled',false);
	});	
</script>
</html>