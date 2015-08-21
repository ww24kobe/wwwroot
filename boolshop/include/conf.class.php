<?php

/***
file conf.class.php
加载配置文件读写类，设成单例
***/

defined('ACC')||exit('ACC Denied');
class conf {
    private static $ins = null;
    private $data = array();
      
		
     //加载配置信息，禁止new对象
    private function __construct() {
        include(ROOT . 'include/config.inc.php');
        $this->data = $_CFG;
    }
    //禁止克隆对象
    private function __clone() {
    }

     //获取自身实例
    public static function getIns() {
        if(self::$ins instanceof self) {
            return self::$ins;
        } else {
            self::$ins = new self();
            return self::$ins;
        } 
    }


    // 用魔术方法,读取data内的信息
    public function __get($key) {
        if(array_key_exists($key,$this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }
    }


    // 用魔术方法,在运行期,动态增加或改变配置选项
    public function __set($key,$value) {
        $this->data[$key] = $value;
    }
}


$conf = conf::getIns();


/****
// 已经能把配置文件的信息,读取到自身的 data属性中存储起来
// print_r($conf);


// 读取选项
echo $conf->host,'<br />';
echo $conf->user,'<br />';
var_dump($conf->template_dir);

// 动态的追加选项
$conf->template_dir = 'D:/www/smarty';

echo $conf->template_dir;
****/