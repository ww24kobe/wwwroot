<?php
class  GoodsTypeModel  extends  Model{
	protected $_validate=array(
		array('type_name','require','必须填写商品类型'),			
	);
	
	
}