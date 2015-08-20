<?php
$url="http://api.map.baidu.com/telematics/v3/weather?location=九江&output=json&ak=DE93a33f736d1e75409e43a9501fcf80";
$jsonstr=file_get_contents($url);
$jsonarr=json_decode($jsonstr,true);
echo '<pre />';
print_r($jsonarr);

//小黄鸡
//$keywords=urlencode('你是谁');
//$url="http://www.simsimi.com/requestChat?lc=zh&ft=1.0&req={$keywords}";
//$jsonstr='{"res":"恩  是的"}';
//$jsonarr=json_decode($jsonstr);
//echo 'sdffffg<br>';
//print_r($jsonarr);