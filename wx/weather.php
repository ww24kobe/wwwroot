<?php
$url="http://api.map.baidu.com/telematics/v3/weather?location=�Ž�&output=json&ak=DE93a33f736d1e75409e43a9501fcf80";
$jsonstr=file_get_contents($url);
$jsonarr=json_decode($jsonstr,true);
echo '<pre />';
print_r($jsonarr);

//С�Ƽ�
//$keywords=urlencode('����˭');
//$url="http://www.simsimi.com/requestChat?lc=zh&ft=1.0&req={$keywords}";
//$jsonstr='{"res":"��  �ǵ�"}';
//$jsonarr=json_decode($jsonstr);
//echo 'sdffffg<br>';
//print_r($jsonarr);