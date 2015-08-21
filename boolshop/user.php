<?php
$username=isset($_GET['username'])?$_GET['username']:'';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>新建网页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<script type="text/javascript">

</script>

<style type="text/css">
</style>
</head>
    <body bgcolor='#eeeeee'>
	<form  action="userAct.php" method="post">
	<div  style="width:500px;height:300px;margin:100px auto;text-align:center;">
<table  >
<tr style="border:1px solid  #cccccc;text-align:right; ">
	<td>用户名</td>
	<td><input type="text" name="username" disabled="disabled" value="<?php   echo $username; ?>" /></td>
</tr>
<tr style="border:1px solid  #cccccc; text-align:right">
	<td>原始密码</td>
	<td><input type="password" name="oldpassword" value="" /></td>
</tr>
<tr style="border:1px solid  #cccccc;text-align:right">
	<td>新密码</td>
	<td><input type="password" name="newpassword" value="" /></td>
</tr>
<tr style="border:1px solid  #cccccc;text-align:right">
	<td>确认新密码</td>
	<td><input type="password" name="renewpassword" value="" /></td>
</tr>
<tr style="border:1px solid  #cccccc;text-align:right">
	<input type="hidden" name="act" value="update_pwd"  />
</tr>
<tr style="border:1px solid  #cccccc;text-align:center">
	
	<td colspan='2'><input type="submit" name="" value="提交" /></td>
</tr>
</table>
</form>
</div>
    </body>
</html>

