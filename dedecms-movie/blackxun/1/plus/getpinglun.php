<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
	$id=(int)$_GET['id'];
	$sql="select a.id, a.title,a.content,count(b.id) hfcount,c.uname,c.face from dede_pinglun a 
	left  join dede_pinglun b on a.id=b.parent_id
	left join dede_member c on a.user_id=c.mid
		where a.movie_id=$id group by a.id order by a.id desc limit  5";
	//包含模板
	$dsql->Execute('me',$sql);
	$pldata=array();
	while($row=$dsql->getArray('me')){
		$pldata[]=$row;
	}
	?>
	<?php  foreach($pldata  as $v) { ?>
				<ul>
					<li class="pic"><a href="#" target="_blank"><img alt="听你唱的幸福的头像" src="<?php echo $v['face'];?>" /></a></li>
					<li class="txt">
						<p><a href="#" target="_blank"><?php echo $v['title'];?>。</a><span><a href="#" target="_blank"><?php echo $v['uname'];?></a> <img src="<?php echo $cfg_templets_skin;?>/images/1.jpg" /></span></p>
						<p style="padding-top:10px;line-height:22px;"><?php echo $v['content'];?>...<a href="#" target="_blank">（查看全文）</a> | <a href="#" target="_blank"><?php echo $v['hfcount'];?>人回应</a> | <a href="#" target="_blank">我来回应>></a></p>
					</li>
				</ul>
	<?php  }?>
	


