<?php
class AttributeModel extends   Model{
	
	protected  $_validate=array(
			array('attr_name','require','必须填写属性值'),
			array('attr_type','require','属性的类型不能为空'),
			array('attr_type',array(0,1),'必须填写属性值',0,'in'),
			array('attr_input_type','require','必须选择属性值的输入方式'),
			
	);
	
	/**
	 * 根据商品类型的id取出属性值
	 * 
	 */
	public  function  getAttr($type_id){
		if(empty($type_id)){ //所有类型属性
			$where=1;	
		}else{               //指定类型属性
			$where="type_id=$type_id";		
		}
		return  $this->field("it_attribute.*,b.type_name")->
		join("it_goods_type b on it_attribute.type_id=b.id")->where($where)->select();	
	}
	
	/*
	 * 根据属性的id取出属性对应的名字
	 * array(
	 * 'id'=>'name'
	 * )
	 * @return array
	 */
	public function getLan(){
		$attr = $this->select();
		$list=array();
		foreach($attr as $v){
			$list[$v['id']]=$v['attr_name'];
		}
		return $list;
	}
	
	/*
	 * 根据商品的id和属性的值获取价格
	 */
	public function getAttrPrice($goods_id,$attr_value){
		$sql="select attr_price from it_goods_attr where goods_id=$goods_id and attr_value='$attr_value'";
		$data = M()->query($sql);
		return  $data[0]['attr_price'];
	}
}