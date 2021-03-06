<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>爱购管理中心 - 商品列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery.js"></script>
<script>
 $(function(){
	 $("select[name=type_id]").change(function(){
		 var  type_id=$(this).val();
		 //发送ajax请求
		 $.ajax({
			 type:'get',
			 url:'__URL__/ajaxGetAttrs/id/'+type_id,
			 success:function(msg){
				 $('#listDiv').html(msg);
				 
			 }
			 
		 });
		 
	 });
		 
 });
</script>
</head>
<body>
<h1>
    <span class="action-span"><a href="__URL__/add/id/<?php echo $type_id; ?>">添加属性</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 属性列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="" name="searchForm">
        <img src="__AIMG__/icon_search.gif" width="26" height="22" border="0" alt="search" />
        按商品类型显示
        <!-- 分类 -->
        <select name="type_id">
            <option value="0">所有类型</option>
            <?php foreach($typedata as $v){?>
			<?php  if($v['id']==$type_id){ $sel="selected='selected'"; }else{ $sel=""; } ?>
            <option value="<?php echo $v['id']; ?>" <?php echo $sel; ?> ><?php echo $v['type_name']; ?></option>
            <?php  }?>
            
        </select>
        
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>属性名称</th>
                <th>商品类型</th>
                <th>属性值录入方式</th>
                <th>可选值列表</th>
                <th>操作</th>
            </tr>
            <?php  $i=0; foreach($attrdata as $k=>$v) {?>
            <tr>
                <td align="center"><?php  echo ++$i;?></td>
                <td align="center" class="first-cell"><span><?php  echo $v['attr_name'];?></span></td>
                <td align="center"><span onclick=""><span><?php  echo $v['type_name'];?></span></td>
                <td align="center"><span><?php  echo $v['attr_input_type']?'列表选择':'手工输入';?></span></td>
                <td align="center"><span><?php  echo $v['attr_value'];?></span></td>
                <td align="center">
                <a href="__GROUP__/Attribute/edit/id/<?php  echo $v['id'];?>" title="编辑"><img src="__AIMG__/icon_edit.gif" width="16" height="16" border="0" /></a>
                <a href="__GROUP__/Attribute/del/id/<?php  echo $v['id'];?>" onclick="return confirm('确认删除此属性?');" title="回收站"><img src="__AIMG__/icon_trash.gif" width="16" height="16" border="0" /></a>
                </td>
            </tr>
            <?php  }?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            
        </table>
    <!-- 分页结束 -->
    </div>
</form>

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>