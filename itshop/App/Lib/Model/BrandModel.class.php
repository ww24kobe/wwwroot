<?php
class  BrandModel extends Model{
	protected $_validate=array(
		array('b_name','require','必须填写品牌名称'),			
	);
}