<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>爱购管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__ACSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__ACSS__//main.css" rel="stylesheet" type="text/css" />

<script>
	function change() {
		var img1 = document.getElementById('img1');
		img1.src = '__URL__/verify/' + new Date().getTime();
	}
	function validate(){
		var	username=document.getElementById('username').value;
	    var password=document.getElementById('password').value;
	    var captcha=document.getElementById('captcha').value;
			if(username==''||password==''){
				alert('用户名或密码不能为空');
				return  false;
			}
			if(captcha==''){
				alert('请输入验证码!');
				return  false;
			}
			return  true;
	}
</script>  

</head>
<body style="background: #278296;color:white">
<form method="post" action="__ACTION__" onsubmit="return validate()">
    <table cellspacing="0" cellpadding="0" style="margin-top:100px" align="center">
        <tr>
            <td>
                <img src="__AIMG__/login.png" width="178" height="256" border="0" alt="ECSHOP" />
            </td>
            <td style="padding-left: 50px">
                <table>
                    <tr>
                        <td align="right">管理员姓名：</td>
                        <td>
                            <input type="text" id="username" name="m_user" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">管理员密码：</td>
                        <td>
                            <input type="password" id="password" name="m_pwd" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">验证码：</td>
                        <td>
                            <input type="text"  id="captcha" name="captcha" class="capital" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <a href='javascript:void(0)'><img id="img1" src="__URL__/verify" alt='验证码' onclick="change()" /></a>
							<span onclick="change()"><a href="javascript:void(0)">看不清，请换一张<a/></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <input type="checkbox" value="1" name="remember" id="remember" />
                            <label for="remember">请保存我这次的登录信息。</label>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="进入管理中心" class="button" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  <input type="hidden" name="act" value="signin" />
</form>
</body>