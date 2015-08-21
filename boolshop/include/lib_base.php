<?php


defined('ACC')||exit('ACC Denied');

// 递归转义数组
function _addslashes($arr) {
    foreach($arr as $k=>$v) {
        if(is_string($v)) {
            $arr[$k] = addslashes($v);
        } else if(is_array($v)) {  //如果是数组,调用自身,再判断
            $arr[$k] = _addslashes($v);
        }
    }
    
    return $arr;
}