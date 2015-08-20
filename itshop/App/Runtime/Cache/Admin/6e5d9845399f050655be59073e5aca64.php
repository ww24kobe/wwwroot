<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>爱购后台管理中心 - 商品品牌 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span1"><a href="__GROUP__" target="_parent">爱购后台管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品品牌 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>品牌名称</th>
                 <th>品牌网址</th>
                 <th>品牌描述</th>
                 <th>排序</th>
                 <th>是否显示</th>
                <th>操作</th>
            </tr>
            <?php foreach($branddata as $k=>$v) {?>
            <tr class="0">
                <td align='center' ><span class="showgoods"><?php echo $v['b_name'];?></span></td>
                <td  ><span><?php echo $v['b_site_url'];?></span></td>
                <td  ><span><?php echo $v['b_desc'];?></span></td>
                <td  ><span><?php echo $v['b_sort'];?></span></td>
                <td  ><span><?php echo $v['b_is_show'];?></span></td>
                <td  align="center">
				<a href="__URL__/edit/id/<?php  echo $v['id'];?>">编辑</a> |
                <a href="__URL__/del/id/<?php  echo $v['id'];?>" title="移除" onclick="return confirm('确认删除品牌吗?')">移除</a>
                </td>
            </tr>
            <?php  }?>
        </table>
    </div>
</form>
<div id="footer">
共执行 1 个查询，用时 0.055904 秒，Gzip 已禁用，内存占用 2.202 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<div id='goods' style="display:none;border:1px solid  red;position:absolute">fasdfgdh</div>
</body>
</html>