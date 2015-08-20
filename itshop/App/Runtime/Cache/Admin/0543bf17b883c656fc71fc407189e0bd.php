<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 回收站列表 </title>
<meta name="robots" c>
<meta http-equiv="Content-Type" c />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script>
	$(function(){
		//全选
		$('#quanxuan').click(function(){
			$(':checkbox').each(function(i,item){
			$(this).attr('checked','checked');
			});
	 
	 	});
		//反选
		$('#fanxuan').click(function(){
			 $(':checkbox').each(function(i,item){
				 if($(this).attr('checked')=='checked'){
					 this.checked=false;
				 }else{
					 this.checked='checked';
				 }
			 });
		});
		
	
	});
	 

</script>
</head>
<body>

<h1>
<span class="action-span"><a href="__URL__/add">添加新商品</a></span>
<span class="action-span1"><a href="__GROUP__" target="_parent">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 回收站列表 </span>
<div style="clear:both"></div>
</h1>



<form method="post" action="__ACTION__" name="listForm" >
  <div class="list-div" id="listDiv">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      
      <a href="#">编号</a><img src="__AIMG__/sort_desc.gif"/>    </th>

    <th><a href="#">商品名称</a></th>
    <th><a href="#">货号</a></th>
    <th><a href="#">价格</a></th>
        <th>操作</th>
  <tr>
  <?php foreach($goodsdata as $k=>$v){?>
     <tr>
    <td><input type="checkbox"  name="ids[]" value="<?php echo $v['id'];?>" /><?php echo ++$k; ?></td>

    <td class="first-cell" style=""><span ><?php echo $v['goods_name']; ?></span></td>
    <td><span ><?php echo $v['goods_sn']; ?></span></td>
    <td align="center"><span ><?php echo $v['shop_price']; ?>
    </span></td> 
    
        <td align="center">
      <a href="__APP__/Goods/detail/id/<?php echo $v['id']; ?>" target="_blank" title="查看"><img src="__AIMG__/icon_view.gif" width="16" height="16" border="0" /></a>
      <a href="__URL__/restore/id/<?php echo $v['id']; ?>" title="还原"><img src="__AIMG__/icon_edit.gif" width="16" height="16" border="0" /></a>
      <a href="__URL__/del/id/<?php echo $v['id']; ?>"  title="回收站" onclick="return  confirm('确认删除?');"><img src="__AIMG__/icon_trash.gif" width="16" height="16" border="0" /></a>
  </tr>
  <?php }?>     
        
       
      </table>

<table id="page-table" cellspacing="0">
  <tr>
    <td align="left" nowrap="true">
      
     <input type='radio' id="quanxuan" name='xuan' />全选   <input type='radio' id="fanxuan"  name='xuan' />反选<input  type='submit' name='delsubmit' value='批量删除' onclick="return confirm('确定删除?');"/>  
    
    </td>
    <td align="right" nowrap="true">
      
       <?php echo $page;?>
    
    </td>
  </tr>

</table>

</div>
</form>

<div id="footer">
共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br />
版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>