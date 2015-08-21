<?php
function litimgurls($imgid=0)
{
    global $lit_imglist,$dsql;
    //获取附加表
    $row = $dsql->GetOne("SELECT c.addtable FROM #@__archives AS a LEFT JOIN #@__channeltype AS c 
                                                            ON a.channel=c.id where a.id='$imgid'");
    $addtable = trim($row['addtable']);
    
    //获取图片附加表imgurls字段内容进行处理
    $row = $dsql->GetOne("Select imgurls From `$addtable` where aid='$imgid'");
    
    //调用inc_channel_unit.php中ChannelUnit类
    $ChannelUnit = new ChannelUnit(2,$imgid);
    
    //调用ChannelUnit类中GetlitImgLinks方法处理缩略图
    $lit_imglist = $ChannelUnit->GetlitImgLinks($row['imgurls']);
    
    //返回结果
    return $lit_imglist;
}

//根据评分值获取相应的星星数量
function getStar($pfz){
	global  $cfg_templets_skin;
	$gold=floor($pfz/2);//金星数量
	$grid=5-$gold;
	$html='';
	for($i=0;$i<$gold;$i++){
		$html.="<img src='{$cfg_templets_skin}/images/star.jpg'/>";
	}

	for($i=0;$i<$grid;$i++){
		$html.="<img src='{$cfg_templets_skin}/images/star_grid.jpg'/>";
	}
	return  $html;
}

function  jiequ($str){
	return  mb_substr($str,0,40,'utf-8');
}