<?php
//1）初始化curl
$ch = curl_init();
//2)设置参数
$access_token="74vuTHGhRfKuFcCoXTLCJUc_owMskq6Dk59bIGClWixk6l8YNYAdo013cdz0DnT-7vYiwiwgrpsx7iNbPdcLYmUcCxwmc4E3tVTriVOFKG8";
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$data = ' {
     "button":[
     {	
          "type":"view",
          "name":"我的商城",
          "url":"http://wang2419920920.gotoip1.com/"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.baidu.com/"
            },
            {
               "type":"click",
               "name":"产品中心",
               "key":"goods"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"zan"
            },
			{
               "type":"view",
               "name":"登陆网站",
               "url":"http://wang2419920920.gotoip1.com/wx/html/index.html"
            }]
       },
		{
				"type":"click",
               "name":"关于商城",
               "key":"about"
			}]
 }';
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//3）执行
$output = curl_exec($ch);
echo $output;
//4）关闭句柄
curl_close($ch);
?>