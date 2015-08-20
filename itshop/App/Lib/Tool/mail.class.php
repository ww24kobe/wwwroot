<?php
//include(dirname(__FILE__)."/PHPMailer/class.phpmailer.php");
class mail{
    /*
    参数：
        $address:收件人的邮箱地址
        $title:邮件的标题
        $content:发送邮件的内容
        $fromuser:发件人的署名
    */
    static public function send($address,$title,$content,$fromuser){
        $mail             = new PHPMailer();
		/*服务器相关信息*/
		$mail->IsSMTP();                        //设置使用SMTP服务器发送
		$mail->SMTPAuth   = true;               //开启SMTP认证
		$mail->Host       = 'smtp.163.com';   	    //设置 SMTP 服务器(发件人邮箱的服务器地址)
		$mail->Username   = 'manbawei';  		//发件人的用户名，没有@后缀
		$mail->Password   = 'xusnxnjvzdydfwrl';       //发件人邮箱的密码
		/*内容信息*/
		$mail->IsHTML(true); 			         //指定邮件格式为：html
		$mail->CharSet    ="UTF-8";			     //编码
		$mail->From       = 'manbawei@163.com';	 //完整的发件人邮箱
		$mail->FromName   = $fromuser;			 //发信人署名
		$mail->Subject    = $title;  			 //发信的标题
		$mail->MsgHTML($content);  				 //内容		
		/*发送邮件*/
		$mail->AddAddress($address);  			 //完整的收件人的邮箱地址
        //$mail ->AddAttachment('110.jpg');//
		if($mail->Send()) {
		  	return true;
		} else {
			//self::$errorInfo=$mail->ErrorInfo;
			return false;
		}
    }
}
?>