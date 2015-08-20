<?php
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx7e1ead08432b01d3&secret=c0abf20205badd23d6d3a9a623ff5b67";
$str=file_get_contents($url);
var_dump($str);