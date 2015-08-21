<?php


/**
file log.class.php
作用: 记录信息到日志
**/


defined('ACC')||exit('ACC Denied');
class Log {

    const LOGFILE = 'curr.log'; //建一个常量,代表日志文件的名称

    // 写日志的
    public static function write($cont) {
       
        // 判断是否备份
        $log = self::isBak(); // 获取日志文件的地址
		//追加换行符
         $cont .= "\r\n";
		//打开，写入，关闭
        $fh = fopen($log,'ab');
        fwrite($fh,$cont);
        fclose($fh); 
    }

    // 备份日志
    public static function bak() {
        // 就是把原来的日志文件,改个名,存储起来
        // 改成 年-月-日.bak这种形式

        $log = ROOT . 'data/log/' . self::LOGFILE;
        $bak = ROOT . 'data/log/' . date('ymd') . mt_rand(10000,99999) . '.bak';
        return rename($log,$bak);
    }

    // 判断日志的大小
    public static function isBak() {
        $log = ROOT . 'data/log/' . self::LOGFILE;        
        if(!file_exists($log)) { //如果文件不存在,则创建该文件
            touch($log);    // touch在linux也有此命令,是快速的建立一个文件
            return $log;
        }

        // 要是存在,则判断大小
        // 清除缓存
        clearstatcache(true,$log);
		//判断文件大小
        $size = filesize($log);
        if($size <= 1024 * 1024) { 
            return $log;
        }
        
        // 走到这一行,说明>1M
        if(!self::Bak()) {
            return $log; //执行这一句说明备份失败返回原文件名
        } else {
            touch($log);
            return $log;//执行这一句说明备份成功返回备份文件，替换原来的日志文件
        }
    }
}




