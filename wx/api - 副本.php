<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "black");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
//$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	private $test = "<xml><ToUserName><![CDATA[gh_26ebe2576b1a]]></ToUserName>
<FromUserName><![CDATA[oFtkvt_kHUDNA4xt6J5OW-vrIIfI]]></FromUserName>
<CreateTime>1432740763</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你rfrfr好]]></Content>
<MsgId>6153574720938057684</MsgId>
</xml>";
	/**
	 * 微信接入
	 *
	 *
	 * Enter description here ...
	 */
	public function valid()
	{
		$echoStr = $_GET["echostr"];

		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}

	//微信响应
	public function responseMsg()
	{
		//文本回复模板
			$textTpl = "<xml>
							<ToUserName><![CDATA[fasd]]></ToUserName>
							<FromUserName><![CDATA[fasdf]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[fsadf]]></MsgType>
							<Content><![CDATA[wertg]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
		$xmlStr =file_get_contents("php://input");
		file_put_contents('post.txt',$xmlStr);//写入文件便于查看
		$xmlObj = simplexml_load_string($xmlStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		
		if (!empty($xmlStr)){
			//发送者(个人微信用户)
			$fromUsername = $xmlObj->FromUserName;
			//接收者(微信公共平台)
			$toUsername = $xmlObj->ToUserName;
			//用户发送内容的类型
			$msgType=$xmlObj->MsgType;	
			//接收关键字
			$keywords=$xmlObj->Content;
			//时间戳
			$time = time();
			//文本回复模板
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
						</xml>"; 
           //判断类型
		   switch($msgType){
				case 'text':
					if($keywords==1){
						echo sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', '111');
					}elseif($keywords==2){
						echo sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', '222');	
					}else{
						//小贱鸡开始聊天
						$msgType='text';
						//初始化curl
						$ch=curl_init();
						//设置请求的url
						$url="http://www.xiaohuangji.com/ajax.php";
						curl_setopt($ch,CURLOPT_URL,$url);
						//获取数据但不输出
						curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
						//模拟post请求
						curl_setopt($ch,CURLOPT_POST,1);
						//curl_setopt($ch, CURLOPTREFERER, 'www.xiaohuangji.com/');
						//请求参数
						$data=array('para'=>$keyword);
						//发送数据
						curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
						$content=curl_exec($ch);
						//关闭资源
						curl_close($ch);
						echo sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
						
					}
					break;
				case 'location':
					echo sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', 'location');
					break; 
				default:
					break;
					

		   }
//------------------------------------------------		
			if($msgType=='text'){
				$keyword=$xmlObj->Content;
				if(!empty($keyword)){
					if($keyword=='?'||$keyword=='？' ){
						$msgType = "text";
						$contentStr = "回复数字：\n1我的博客地址\n2我的偶像\n3看笑话\n4看动物\n5听音乐\n6慕课网\n回复[城市名+天气]可以查询天气\n回复[任意内容]与我们的机器人聊天\n发送地理位置查看附件的酒店信息,赶快试试吧亲!";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					//天气查询
					}elseif($pos=strpos($keyword,'天气')){
						$msgType = "text";
						$city=substr($keyword,0,$pos);
						//$content=$city;
						$url="http://api.map.baidu.com/telematics/v3/weather?location={$city}&output=json&ak=DE93a33f736d1e75409e43a9501fcf80";
						$str=file_get_contents($url);
						$json=json_decode($str);
						$content="当前日期:".$json->date."\n";
						$content.="查询城市:".$json->results[0]->currentCity."\n";
						$content.="天气情况:".$json->results[0]->weather_data[0]->weather."\n";
						$content.="当天温度:".$json->results[0]->weather_data[0]->temperature."\n";
						$content.="明天温度:".$json->results[0]->weather_data[1]->temperature."\n";
						$content.="后天温度:".$json->results[0]->weather_data[2]->temperature."\n";
						$content.="大后天温度:".$json->results[0]->weather_data[3]->temperature;
						//echo $content;*/
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
						echo $resultStr;
					
					
					}elseif($keyword==4){
						$msgType = 'news';
						$count = 5;
						$title=array('','动物1','动物2','动物3','动物4','动物5','图6',);
						$str = "<ArticleCount>$count</ArticleCount><Articles>";
						for($i=1;$i<=$count;$i++) {
							$str .= "<item>
											<Title><![CDATA[$title[$i]]]></Title>
											<Description><![CDATA[描述.....]]></Description>
											<PicUrl><![CDATA[http://wang241992.gotoip1.com/wx/images/{$i}.jpg]]></PicUrl>
											<Url><![CDATA[http://www.baidu.com]]></Url>
										</item>";
						}

						$str .= "</Articles>";
						$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $str);
						echo $resultStr;

					}elseif($keyword=='5'){
						$msgType = "music";
						$title='时间都去哪儿了';
						$description='不平凡的路';
						$url="http://music.163.com/#/song?id=28126661";
						$hurl="http://music.163.com/#/song?id=28126661";
						$resultStr = sprintf($musicTpl, $fromUsername, $toUsername, $time, $msgType, $title,$description,$url,$hurl);
						echo $resultStr;
							
					}elseif($keyword=='数据库'){
						$msgType='text';
						include_once 'conn.php';
						$contentStr = "";
						$sql='select  *  from  users';
						$res=mysql_query($sql);
						while($row=mysql_fetch_assoc($res)){
							$contentStr.='用户名:'.$row['username'].'密码: '.$row['password']."\n";
						}

						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}else{
						//小贱鸡开始聊天
						$msgType='text';
						//初始化curl
						$ch=curl_init();
						//设置请求的url
						$url="http://www.xiaohuangji.com/ajax.php";
						curl_setopt($ch,CURLOPT_URL,$url);
						//获取数据但不输出
						curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
						//模拟post请求
						curl_setopt($ch,CURLOPT_POST,1);
						//curl_setopt($ch, CURLOPTREFERER, 'www.xiaohuangji.com/');
						//请求参数
						$data=array('para'=>$keyword);
						//发送数据
						curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
						$content=curl_exec($ch);
						//关闭资源
						curl_close($ch);
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
						echo $resultStr;

					}

				}else{
					echo "Input something...";
				}

			}elseif($msgType=='location'){
				$msgType = "text";
				$url="http://api.map.baidu.com/telematics/v3/reverseGeocoding?output=json&location={$jd},{$wd}&coord_type=gcj02&ak=DFeb602c2287c0365ddc5776ee79af22";
				//模拟get请求
				$str = file_get_contents($url);
				//解析json格式
				$json = json_decode($str);
				$content="你发送的位置为:".$json->description."\n";
				$url="http://api.map.baidu.com/place/v2/search?query=酒店&location={$wd},{$jd}&radius=2000&output=json&ak=DE93a33f736d1e75409e43a9501fcf80";
				$str=file_get_contents($url);
				$json=json_decode($str);
				$result=$json->results;
				foreach($result as  $k=>$v){
					$content.=$v->name."\n地址:".$v->address.",\n电话:".$v->telephone."\n";
				}
				//echo $content;
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
				echo $resultStr;

			}elseif($msgType=='event'&& $event=='subscribe'){
				$msgType = "text";
				$contentStr = "谢谢您关注blackxun<a href='http://baidu.com'>公众号</a>\n订阅用户OpenId:{$fromUsername}";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;							
			}elseif($msgType=='event' && $event=='CLICK'){
				//自定义菜单推送事件
				if($eventkey=='goods'){
					$msgType = "text";
					$contentStr = "你点击了hdjfg产品中心";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
				}else{
					$msgType = "text";
					$contentStr = "你点击了关于商城";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
				}
				
				
			}


		}else {
			echo "";
			exit;
		}
	}

	private function checkSignature()
	{
		// you must define TOKEN by yourself
		if (!defined("TOKEN")) {
			throw new Exception('TOKEN is not defined!');
		}

		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		// use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>