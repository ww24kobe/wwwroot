<?php
class OrderInfoModel extends  Model{
	protected  $_validate=array(
		array('consignee','require','必须填写收货人姓名!'),
		array('address','require','必须填写收货人地址!'),
		array('mobile','require','必须填写手机号!'),
		array('mobile','checkMobile','手机号格式不正确!',1,'callback'),
	);
	
	//正则验证手机号码
	public  function  checkMobile($mobile){
		$pattern="/^1(3|5|8)\d{9}$/";
		$pi=preg_match($pattern, $mobile);
		if($pi){
			return  true;
		}
		return  false;
	}
}