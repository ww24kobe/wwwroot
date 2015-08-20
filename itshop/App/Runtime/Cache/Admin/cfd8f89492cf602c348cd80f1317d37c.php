<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品订单 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__/main.css" rel="stylesheet" type="text/css" />
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
<h1>
	<span class="action-span"><a href="__GROUP__/Advert/add">添加公告</a></span>
    <span class="action-span1"><a href="__GROUP__" target="_parent">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 会员列表 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>编号</th>
                 <th>标题名称</th>
                 <th>内容</th>
                 <th>发布时间</th>
                <th>操作</th>
            </tr>
            <?php $i=0; foreach($advdata as $k=>$v) {?>
            <tr class="0">
                <td align='center' ><span class="showgoods"><?php echo ++$i;?></span></td>
                <td  ><span><?php echo $v['title'];?></span></td>
                <td  ><span><?php echo mb_substr($v['content'],0,8,'utf-8');?></span></td>
                <td  ><span><?php echo date('Y-m-d H:i:s',$v['add_time']);?></span></td>
                <td  align="center">
                <a href="__URL__/del/id/<?php  echo $v['id'];?>" title="移除" onclick="return confirm('确认删除此条公告吗?')">移除</a>
                </td>
            </tr>
            <?php  }?>
        </table>
    </div>
</form>
<div id="footer">
共执行 1 个查询，用时 0.055904 秒，Gzip 已禁用，内存占用 2.202 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>

<div id='goods' style="display:none;border:1px solid  red;position:absolute"></div>
</body>
</html>