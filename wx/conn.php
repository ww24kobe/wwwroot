<?php
 $link=mysql_connect($config['host'],$config['user'],$config['pass']);
 mysql_query("use ".$config['dbname']);
 mysql_query("set  names ".$config['char']);
