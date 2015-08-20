<?php
class  GoodsModel extends Model{
	protected $_validate=array(
		array('goods_name','require','必须填写用户名'),
		array('shop_price','require','必须填写价格'),
	    array('shop_price','checkNumber','价格必须大于0',1,'callback'),
		array('goods_number','checkNumber','库存数不能小于0',1,'callback'),
	);
	
	//验证不能为负数
	public function checkNumber($num){
		if($num<0){
			return  false;
		}
		return  true;
	}
	
	/*
	 * 取出销售排行榜
	 */
	public function  getGoodsTop($num){
		return  $this->where("is_hot=1 and is_delete=0 and is_sale=1")->order('sort asc' )->limit($num)->select();
	}
	/*
	 * 根据类型取出对应商品
	 */
	public  function getGoodsByType($type,$num) {
		if($type=='is_hot' || $type=='is_new' || $type=='is_best'){
			$sql="select * from it_goods where $type = 1 and is_sale = 1 and  is_delete=0 order by sort desc limit $num";
			return $this->query($sql);
		}else{
			return false;
		}
		
	}
	
	/*
	 * 取出会员等级价格
	 */
	public  function  getMemberPrice($id,$price){
		$sql="select a.level_name,ifnull(b.level_price,$price*a.rate/100) price  from it_member_level a 
				 left  join it_member_price b on a.id=b.level_id and b.goods_id=$id";
		return $this->query($sql);
	}
	
	/*
	 * 取出商品属性
	 */
	public function  getAttrById($goods_id){
	 $sql="select a.*,b.attr_name from it_goods_attr a left join it_attribute b on a.attr_id=b.id where a.goods_id=$goods_id and b.attr_type=1";
            $arr = $this->query($sql);//取出的数据
            $list=array();//定义一个空的数组，用于存储自己构造的数组
            /*
	            $array[属性的名称]=array(
	                ‘attr_value’=>属性的值,
	                ‘attr_price’=>属性的价格,
	                ‘id’=>属性的id
	              )
            */
            foreach($arr as $v){
                $list[$v['attr_name']][]=array(
                        'attr_value'=>$v['attr_value'],
                        'attr_price'=>$v['attr_price'],
                        'attr_id'=>$v['attr_id']
                );
            }
            return $list;
	}
}