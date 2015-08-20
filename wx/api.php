<?php
/**
 * wechat php test
 */

//define your token
//header("Content-type:text/html;charset=utf-8");
define("TOKEN", "black");
require_once('init.php');
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	private $config=null;

	
	
	/**
	 * 微信接入
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
		$xmlstr =$GLOBALS["HTTP_RAW_POST_DATA"];
		file_put_contents('post.txt',$xmlstr);//写入文件便于查看
		$xmlobj = simplexml_load_string($xmlstr, 'SimpleXMLElement', LIBXML_NOCDATA);		
		if (!empty($xmlstr)){	
           //判断类型
		   switch($xmlobj->MsgType){
				case 'text':
					$this->receive_text($xmlobj);							
					break;                                                    
				case 'event':
					$this->receive_event($xmlobj);                                                         
					break;
				case 'location':
					$this->receive_location($xmlobj);
					break;
				case 'image':
					$this->receive_image($xmlobj);
					break;
				case 'voice':
					$this->receive_voice($xmlobj);
					break;
				default:
					break;
              }

         }else {
                    echo "";
                    exit;
         }
	}

	/*菜单推送事件*/
	private  function receive_event($xmlobj){
		$event=$xmlobj->Event;
		$eventKey=$xmlobj->EventKey;
		if($event=="subscribe"){
			$this->response_subscribe($xmlobj);
		}elseif($event=="CLICK"){
			//菜单推送事件
			if($eventKey=='zan'){
				$content="谢谢亲宝贵的一票！/::D";
                $this->response_text($xmlobj,$content);
			}elseif($eventKey=='about'){
				$oauth_url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7e1ead08432b01d3&redirect_uri=http://wang2419920920.gotoip1.com/wx/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
				$content="<a href='$oauth_url'>点我网页授权(待开发。。。。)</a>";
				$this->response_text($xmlobj,$content);		
			}elseif($eventKey=='goods'){
				$mobiledata=$this->getMobile(7);
				$this->response_mobilenews($xmlobj,$mobiledata);
			}elseif($eventKey=='weather'){
				$mobiledata=$this->getMobile(7);
				$content="请输入【城市+天气】\n如:广州天气";
				$this->response_text($xmlobj,$content);
			}
		}
		
	}
	
	/*接收关注事件*/
	private  function response_subscribe($xmlobj){
		$content="欢迎关注，回复'?'或'?'了解更多哦！/::D";
		$this->response_text($xmlobj,$content);
	}

	/*接收语音事件*/
	private  function receive_voice($xmlobj){
		$content="声音好甜哦！/::D";
		$this->response_text($xmlobj,$content);
	}

	/*接收图片事件*/
	private  function receive_image($xmlobj){
		$content="图片美美哒！/::D";
		$this->response_text($xmlobj,$content);
	}

   
	/*接受文本消息*/
	private  function receive_text($xmlobj){
		global $config;//提升作用域
		$keywords=$xmlobj->Content;
		switch($keywords){
			case '1':
				$this->response_text($xmlobj,'111');
				break;
			case '2':
				$this->response_text($xmlobj,'222');
				break;
			case '?':
				$content = "回复【城市名+天气】可以查询天气/:8-)\n回复【任意内容】与我们的机器人聊天/::B\n发送地理位置查看附件的酒店信息,赶快试试吧亲!/::D";
				$this->response_text($xmlobj,$content);
				break;
			case '？':
				$content = "回复【城市名+天气】可以查询天气/:8-)\n回复【任意内容】与我们的机器人聊天/::B\n发送地理位置查看附件的酒店信息,赶快试试吧亲!/::D";
				$this->response_text($xmlobj,$content);
				break;
			case '4':
				//取出十条手机
			    $mobiledata=$this->getMobile(5);				
				$this->response_mobilenews($xmlobj,$mobiledata);
			default:
				//天气查询
				if(strrpos($keywords,'天气')){
					$this->response_weather($xmlobj,$keywords);
				}
				$this->response_xiaoji($xmlobj,$keywords);
				break;
		}
	}

	/*获取手机信息*/
	private  function  getMobile($num=6){
		$sql="select *  from it_goods where 1 and is_new=1 and is_sale=1 order by  add_time desc limit 1,$num";
				$res=mysql_query($sql);
				$data=array();
				while($rows=mysql_fetch_assoc($res)){
						$data[]=$rows;
				}
		return  $data;
	}

	/*
	 接受地理位置信息
	*/
	private  function  receive_location($xmlobj){
		$Location_Y=$xmlobj->Location_Y;
		$Location_X=$xmlobj->Location_X;
		$Label=$xmlobj->Label;
		$url="http://api.map.baidu.com/telematics/v3/local?location={$Location_Y},{$Location_X}&keyWord=酒店&output=json&ak=DE93a33f736d1e75409e43a9501fcf80";
		$json_str=file_get_contents($url);
		$json_obj=json_decode($json_str,true);
		//$this->response_hotelnews($json_obj['pointList']);
		$this->response_hotelnews($xmlobj,$json_obj['pointList']);
	}
	/*返回天气信息*/
	private function response_weather($xmlobj,$keywords){
		//$pos=strpos($keyword,'天气');
		$city=preg_replace('/天气/','',$keywords);
		$url="http://api.map.baidu.com/telematics/v3/weather?location={$city}&output=json&ak=DE93a33f736d1e75409e43a9501fcf80";
		//$str=file_get_contents($url);
		$res=$this->https_request($url);
		$json_arr=json_decode($res,true);
		$this->response_text($xmlobj,$json_arr['results']['currentCity']);
	}

   /*返回天气图文消息*/
   private  function response_weathernews($xmlobj,$content){
		$count=count($content['results'][0]['weather_data']);
			$newsTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					   %s
					</xml> "; 

            $news="<ArticleCount>$count</ArticleCount><Articles>";
			$weather_data=$content['results'][0]['weather_data'];
			foreach($weather_data as  $k=>$v){
				$pic=$v['dayPictureUrl'];
				$picurl="";
				if(!$k){
					$news.="<item>
						<Title><![CDATA[{$content['results'][0]['currentCity']} {$v['date']}]]></Title>
						<Description><![CDATA[]]></Description>
						<PicUrl><![CDATA[]]></PicUrl>
						<Url><![CDATA[$picurl]]></Url>
						</item>";
				}else{
					$news.="<item>
						<Title><![CDATA[{$v['date']} {$v['weather']} {$v['temperature']} {$v['wind']}]]></Title>
						<Description><![CDATA[]]></Description>
						<PicUrl><![CDATA[$pic]]></PicUrl>
						<Url><![CDATA[$picurl]]></Url>
						</item>";
				
				}
				
			}
			$news.="</Articles>";
			echo  sprintf($newsTpl, $xmlobj->FromUserName, $xmlobj->ToUserName, time(), $news);
   }
	/*
	 *回复文本消息
	 */
	private  function  response_text($xmlobj,$content){
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
						</xml>"; 
			echo  sprintf($textTpl, $xmlobj->FromUserName, $xmlobj->ToUserName, time(), $content);		
	}

	/*
	机器人(小贱鸡)聊天
	*/
	private  function response_xiaoji($xmlobj,$keywords){
		$url="http://www.simsimi.com/requestChat?lc=zh&ft=1.0&req={$keywords}";
		//$data=array('p'=>$keyword);
		$result=$this->https_request($url);
		$jsonarr=json_decode($result,true);
		$content=$jsonarr['res'];
		$this->response_text($xmlobj,$content);
	
	}

	/*
	 *回复手机图文消息
	 */
	private  function  response_mobilenews($xmlobj,$content){
		   $count=count($content);
			$newsTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					   %s
					</xml> "; 

            $news="<ArticleCount>$count</ArticleCount><Articles>";
			foreach($content as  $v){
				$pic="http://wang2419920920.gotoip1.com/Public/Uploads/{$v['goods_ori']}";
				$picurl="http://wang2419920920.gotoip1.com/index.php/Goods/detail/id/{$v['id']}";
				$news.="<item>
						<Title><![CDATA[{$v['goods_name']}]]></Title>
						<Description><![CDATA[]]></Description>
						<PicUrl><![CDATA[$pic]]></PicUrl>
						<Url><![CDATA[$picurl]]></Url>
						</item>";
			}
			$news.="</Articles>";
			echo  sprintf($newsTpl, $xmlobj->FromUserName, $xmlobj->ToUserName, time(), $news);
		
	}

	 /*
	 *回复酒店图文消息
	 */
	private  function  response_hotelnews($xmlobj,$content){
		   $count=count($content);
			$newsTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					   %s
					</xml> "; 

            $news="<ArticleCount>$count</ArticleCount><Articles>";
			foreach($content as  $v){
				$y=$v['location']['lng'];
				$x=$v['location']['lat'];
				$pic="http://api.map.baidu.com/panorama?width=512&height=256&location={$y},{$x}&fov=180&ak=DE93a33f736d1e75409e43a9501fcf80";
				$news.="<item>
						<Title><![CDATA[{$v['name']}\n地址:{$v['address']}\n电话:{$v['additionalInformation']['telephone']}]]></Title>
						<Description><![CDATA[gdsdghfhgdg]]></Description>
						<PicUrl><![CDATA[{$pic}]]></PicUrl>
						<Url><![CDATA[{$v['additionalInformation'][link][1][url]}]]></Url>
						</item>";
			}
			$news.="</Articles>";
			echo  sprintf($newsTpl, $xmlobj->FromUserName, $xmlobj->ToUserName, time(), $news);
		
	}

	//https请求（支持GET和POST）
    private function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		//post请求
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

   //验证token是否合法
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