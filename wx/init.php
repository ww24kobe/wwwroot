<?php
//初始化页面

session_start();//开启session
$config=include("./config/config.php");
require_once 'conn.php';//包含数据库文件
