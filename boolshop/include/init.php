<?php




/*
file init.php
作用:框架初始化
*/


// 初始化当前的绝对路径

header("content-type:text/html;charset:utf-8");
defined('ACC')||exit('ACC Denied');


define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))) . '/');
//echo ROOT;exit;  //E:/wamp/www/myshop/
define('DEBUG',true);


require(ROOT . 'include/lib_base.php');

function __autoload($class) {
    if(strtolower(substr($class,-5)) == 'model') {
        require(ROOT . 'Model/' . $class . '.class.php');
    } else if(strtolower(substr($class,-4)) == 'tool') {
        require(ROOT . 'tool/' . $class . '.class.php');
    } else {
        require(ROOT . 'include/' . $class . '.class.php');
    }
}



// 过滤参数,用递归的方式过滤$_GET,$_POST,$_COOKIE,暂时不会
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);

//开启session
session_start();


// 设置报错级别
if(defined('DEBUG')) {
    error_reporting(E_ALL); //生产状态
	//ini_set('error_reporting',E_ALL);
} else {
    error_reporting(0);    //上线状态ini_set('error_reporting',0);
	//ini_set('display_errors',      1);
}
