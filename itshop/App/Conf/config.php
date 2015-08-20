<?php
return array(
		//'配置项'=>'配置值'
		'APP_GROUP_LIST' => 'Home,Admin', 
		'DEFAULT_GROUP'  => 'Home', 
		
		'URL_MODEL'             => 1,//传统模式
		'URL_CASE_INSENSITIVE' =>TRUE,//url不区分大小写
		//'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
		"LOAD_EXT_FILE"=>"functions",//导入自定义配置文件
		
		'TMPL_ACTION_SUCCESS'=>'Public:dispatch_jump',//自定义success和error的提示页面模板
		'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',
		

		
		//模板解析变量
		'TMPL_PARSE_STRING'  =>array(
				
		     '__HCSS__' => '/Public/Home/styles', 
		     '__HIMG__' => '/Public/Home/images', 
			 '__ACSS__' => '/Public/Admin/styles',
			 '__AIMG__' => '/Public/Admin/images',
		     '__JS__' => '/Public/js', 
		     '__UPLOAD__' => '/Public/Uploads', 
	    ),
		
		//数据库配置信息
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'itshop', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => 'root', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'it_', // 数据库表前缀
		
		
);
?>