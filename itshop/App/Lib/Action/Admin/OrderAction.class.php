<?php
class  OrderAction extends AdminAction{
	
	/*
	 * 订单列表视图
	 */
	public  function orderList(){
		$this->orderdata=D('OrderInfo')->Field("it_order_info.*,b.info")->join("it_order_status b on it_order_info.status=b.id")->select();
		$this->display();
	}
	
	/*
	 * 编辑视图
	 */
	public  function edit(){
			if(IS_POST){
				$ordermodel=D('OrderInfo');
				if($ordermodel->create()){
					if($ordermodel->save($_POST)){
						$this->success('编辑成功',U('Order/orderlist'));exit;
					}else{
						$this->error('编辑失败');
					}
				}else{
					$this->error($ordermodel->getError());
				}
			}
			$id=(int)$_GET['id'];
			$this->orderinfo=D('OrderInfo')->find($id);
			$this->display();
		}
		
	/*
	 * 删除动作
	 */	
	public function del(){
			$id=(int)$_GET['id'];
			$affected=D('OrderInfo')->where("id=$id")->delete();
			if($affected){
				$this->success('删除成功',U('Order/orderList'),2);exit;
			}else{
				$this->error('删除失败');
			}
		}

	/*
	 * ajax请求订单商品信息
	 */	
	public function ajax(){
		$order_sn=$_GET['sn'];
		$sql="select a.*,b.goods_thumb  from  it_order_goods  a left  join it_goods b on a.goods_id=b.id where a.order_id='$order_sn'";
		$this->goodsdata=M()->query($sql);
		$this->display();
	}	
	
	
}