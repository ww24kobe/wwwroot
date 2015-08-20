<?php
class  MemberLevelModel extends  Model{
	protected $_validate=array(
		array('level_name','require','必须填写会员等级名称'),
		array('min_points','number','下限必须是数字'),
		array('max_points','number','上限必须是数字'),
		array('rate','1,100','必须1-100范围内',0,'between'),
		array('max_points','isMax','上限必须大于下限',0,'callback'),
			
			
	);
	
	
	/**
	 * 判断积分上限是否大于积分下限
	 * 
	 */
	public function isMax($num){
		if($num>$_POST['min_points']){
			return  true;			
		}else{
			return false;
		}
		
	}
}