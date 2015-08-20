<?php
class  CartModel  extends  Model{
	
	/*
	 * 判断购物车有没有商品
	 */
	public  function hasItem($goods_id,$goods_attr){
		$session_id=session_id();
		return  $this->where("goods_id=$goods_id and goods_attr='$goods_attr' and session_id='$session_id'")->select();
	}
	
	/*
	 * 添加商品至购物车
	 */
	public  function addItem($goods_id,$goods_name,$goods_number,$shop_price,$goods_attr,$goods_attr_price,$goods_attr_id){
		$session_id=session_id();
		//判断购物车里面有没有商品
		if($this->hasitem($goods_id,$goods_attr)){
			//要修改购物车，
			$sql="update it_cart set goods_number=goods_number+$goods_number where goods_id=$goods_id and goods_attr='$goods_attr' and session_id='$session_id'";
		}else{
			//要添加到购物车。
			$user_id = (int)$_SESSION['user_id'];//取不到值就为0
			$sql="insert into it_cart (goods_id,user_id,session_id,goods_name,shop_price,goods_number,goods_attr,goods_attr_price,goods_attr_id) values($goods_id,$user_id,'$session_id','$goods_name','$shop_price','$goods_number','$goods_attr','$goods_attr_price','$goods_attr_id')";
			 
		}
		return $this->Execute($sql);
	}
	
	/*
	 * 清空购物车商品
	 */
	public function  clearItem(){
		$session_id=session_id();
		$res = $this->where("session_id='$session_id'")->delete();
		return  $res;
	}
	
	/*
	 * 删除购物车指定的商品
	 */
	public  function  delItem(){
		$id = (int)$_GET['id'];
		return $this->delete($id);
	}
	
	/*
	 * 显示购物车数据
	 */
	public function showItem(){
		//如何取出数据
		$user_id=(int)$_SESSION['user_id'];
		if(!empty($user_id)){
			$cartdata = M('Cart')->where("user_id=$user_id ")->select();
		}
		$list=array();
		$total_price =0;
		foreach($cartdata as $v){
			$goods_id=$v['goods_id'];
			$v['goods_thumb']=D('Goods')->where("id=$goods_id")->getField('goods_thumb');
			$total_price+=($v['goods_attr_price']+$v['shop_price'])*$v['goods_number'];
			$list[]=$v;
		}
		
		$data=array('list'=>$list,'total_price'=>$total_price);
		return $data;
	}
}
