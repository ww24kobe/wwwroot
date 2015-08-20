<?php 


	//调试函数
  function  showbug($param){
  	echo '<pre />';
  	print_r($param);
  	
  }
  /*
   * 查找条件
   */
  function  demo(){
  	$uri=$_SERVER['REQUEST_URI'];
  	echo '----'.$uri;
  	echo '<br>';
  	$pos=strrpos($uri,'?page');
  	 $str=ltrim($uri,'/index.php/Category/category/' ) ;
  	echo  '---'.$str;
	echo '<br>';
 
  }