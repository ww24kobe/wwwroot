<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加分类</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="__GROUP__/goodsType/typelist">商品类型列表</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 编辑类型 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form action="__GROUP__/GoodsType/edit" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">类型名称:</td>
                <td>
                    <input type='text' name='type_name' maxlength="20" value="<?php  echo $typeinfo['type_name'];?>" size='27' /> <font color="red">*</font>
                </td>
            </tr> 
             
            <tr>
            	<td></td><td><input type="submit" value=" 确定 " />
            	<input type="reset" value=" 重置 " /></td>
            </tr>     
        </table>
      <input type="hidden" name="id" value="<?php  echo $typeinfo['id'];?>" />
    </form>
</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>