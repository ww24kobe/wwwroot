<?php

defined('ACC')||exit('ACC Denied');
class mysql extends db {
    private static $ins = NULL;
    private $conn = NULL;
    private $conf = array();
    
    /*
	 *获取单例的conf，连接数据库初始化
	 *
	 */
     private function __construct() {
        $this->conf = conf::getIns(); //获取单例的conf类的实例，获取配置文件       
        $this->connect($this->conf->host,$this->conf->user,$this->conf->pwd);
        $this->select_db($this->conf->db);
        $this->setChar($this->conf->char);
    }

	/*
	 *获取自身的实例
	 *@return 自身实例对象
	 */
    public static function getIns() {
        if(!(self::$ins instanceof self)){//保证是同一个对象
            self::$ins = new self();
        }
        return self::$ins;
    }
     //禁止克隆对象
	 private  function  __clone(){
	 	 
	 }
	/*
	 *连接数据库
	 *
	 */
    public function connect($h,$u,$p) {
        $this->conn = mysql_connect($h,$u,$p);
        if(!$this->conn) {
            $err = new Exception('连接失败');
            throw $err;
        }
    }
 
    /*
	 *选择数据库
	 *@parm 传入一个数据库名
	 */
    protected function select_db($db) {
        $sql = 'use ' . $db;
        $this->query($sql);
    }

	/*
	 * 选择连接数据库的字符集
	 *
	 *
	 */

    protected function setChar($char) {
        $sql = 'set names ' . $char;
        return $this->query($sql);
    }

	/*执行sql语句并写入日志文件
	 *@parm   接收一条sql语句
	 *@return 成功返回结果集
	 */  
    public function query($sql) {

        $rs = mysql_query($sql,$this->conn);

        log::write($sql);//写入日志文件中

        return $rs;
    }

     /* 查询多行数据
	  *@parm   接收一条sql语句
	  *@return 成功返回二维关联数组
	  */ 
     public function getAll($sql) {
        $rs = $this->query($sql);
        
        $list = array();
        while($row = mysql_fetch_assoc($rs)) {
            $list[] = $row;
        }

        return $list;
    }

	 /* 查询一行数据
	  *@parm   接收一条sql语句
	  *@return 成功返回一维关联数组
	  */
    public function getRow($sql) {
        $rs = $this->query($sql);
        return mysql_fetch_assoc($rs);
    }


     /* 查询一行数据
	  *@parm   接收一条sql语句
	  *@return 成功返回单个值
	  */
    public function getOne($sql) {
        $rs = $this->query($sql);
        $row = mysql_fetch_row($rs);
        return $row[0];
    }


     /* 执行update，insert语句
	  *@parm1 string $table 表名   
	  *@parm2 array $arr 添加的数据以及键名
	  *@return  resource 成功返回结果集 否则false
	  */
	 public function autoExecute($table,$arr,$mode='insert',$where = ' where 1 limit 1') {
        
        if(!is_array($arr)) {
            return false;
        }

        if($mode == 'update') {
            $sql = 'update ' . $table .' set ';
            foreach($arr as $k=>$v) {
                $sql .= $k . "='" . $v ."',";
            }
            $sql = rtrim($sql,',');
            $sql .= $where;
            
            return $this->query($sql);
        }

        $sql = 'insert into ' . $table . ' (' . implode(',',array_keys($arr)) . ')';
        $sql .= ' values(\'';
        $sql .= implode("','",array_values($arr));
        $sql .= '\')';

        return $this->query($sql);
    
    }

     /*  返回INSERT，UPDATE 或 DELETE语句所影响的行数  
	  *@return  int 成功返回所影响的整数值
	  */ 
    public function affected_rows() {
        return mysql_affected_rows($this->conn);
    }

     /*  取得上一步 INSERT 操作产生的 ID   
	  *@return 成功返回取得上一步 INSERT 操作产生的 ID 
	  */
    public function insert_id() {
        return mysql_insert_id($this->conn);
    }


}
