<?php
class  CartAction  extends HomeAction{
	
	public  function  addCart(){
		//判断用户是否登录了,否则不能加入购物车
		if(!$_SESSION['user_id']){
			$this->error('亲,请先登录在购买哦!',U('User/login'),1);
		}
			
		$goods_id=$_POST['goods_id'];
		$user_id=(int)$_SESSION['user_id'];
		$session_id=session_id();
		$goods_name=$_POST['goods_name'];
		$goods_number=$_POST['goods_number'];
		$shop_price=D('Goods')->where("id=$goods_id")->getField('shop_price');
		$goods_attr='';
		$goods_attr_price='';
		$goods_attr_id='';
		
		$attr=$_POST['attr'];
		$attrmodel =D('Attribute');
		$lan=$attrmodel->getLan();
		$goods_attr_price="";
		foreach($attr as  $k=>$v){
			$price=$attrmodel->getAttrPrice($goods_id,$v);
			$goods_attr.=$lan[$k].":".$v.'['.$price.']'.'<br/>';
			$goods_attr_price+=$price;
			$goods_attr_id.=$k.',';
		}
		$goods_attr=trim($goods_attr,'<br/>');
		$goods_attr_id=trim($goods_attr_id,',');
		
		$cartmodel=D('Cart');
		if($cartmodel->addItem($goods_id,$goods_name,$goods_number,$shop_price,$goods_attr,$goods_attr_price,$goods_attr_id)){
			$this->success('添加购物车成功!','showCart');exit;
		}else{
			$this->error('失败了~~~~(>_<)~~~~!');
		}
		
	}
	/*
	 * 显示购物车视图
	 */
	public function showCart(){
		$cartdata=D('Cart')->showItem();
		$this->assign('listdata',$cartdata['list']);
		$this->assign('total_price',$cartdata['total_price']);
		$this->display('gwc1');
	}
	
	/*
	 * 删除购物车商品
	 */
	public function delitem(){
		if(D('Cart')->delItem()){
			$this->redirect('Cart/showCart');
		}
	}
	
	/*
	 * 清空购物车
	 */
	public function clearCart(){
		if(D('Cart')->clearItem()){
			$this->success('清空购物车成功','showCart');
		}else{
			$this->error('清空购物车失效');
		}
	}
	
	/*
	 * ajax修改购物车数量+1
	 */
 	public function updatecart(){
        //接收购物车数据的id
        $id = (int)$_GET['id'];
        $sql="update it_cart set goods_number=goods_number+1 where id=$id";
        if(M()->Execute($sql)!==false){
            echo 'ok';
        }
    
    }
    
    /*
     * ajax修改购物车数量-1
    */
    public function updatecartdec(){
    	//接收购物车数据的id
    	$id = (int)$_GET['id'];
    	$sql="update it_cart set goods_number=goods_number-1 where id=$id";
    	if(M()->Execute($sql)!==false){
    		echo 'ok';
    	}
    
    }
	
}