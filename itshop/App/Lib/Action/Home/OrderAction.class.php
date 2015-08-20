<?php
class OrderAction extends HomeAction{
	
	/*
	 * 订单视图
	 */
	public  function checkout(){
	   $session_id=session_id();
	   $user_id = $_SESSION['user_id'];
	   //-----------取出购物车数据-------------------
       $cartdata = D('Cart')->showItem();//getcart();//取出购物车里面的数据
       //---------------判断购物车是否有商品-----------------------------   
       if(count($cartdata['list'])<1){
                $this->error('购物车没有商品无法下订单');
       }
       
   
       $_SESSION['c']='Order';//记录当前的控制器名称
       $_SESSION['act']='checkout';//记录当前的方法名称。
   		//-----------判断用户是否登录------------------------
       if(empty($user_id)){
       	$this->redirect("User/login");
       }
       
  		 //-----------判断用户是否填写了收货地址--------------------
       $address = M('Address')->where("user_id=$user_id")->find();
       if(empty($address)){
       	return $this->writeaddress();
       }
//        showbug($address);exit;
       $this->assign('cartdata',$cartdata['list']);//把取出的购物车里面的商品给分配到静态页面
       $this->assign('address',$address);//收货地址
       $this->assign('total_price',$cartdata['total_price']);
       $this->display('gwc2');
	}
	
	/*
	 * 修改收货地址
	 *
	 */
	public function updateaddress(){
		if(IS_POST){
			$address=D('address');
			$user_id=$_SESSION['user_id'];
			if($address->where("user_id=$user_id")->save($_POST)){
				$this->success('地址修改成功',U('Order/checkout'));exit;
			}else{
				$this->error('修改地址失败');
			}
			
		}
		$u_id=$_SESSION['user_id'];
		$this->addressdata=D('address')->where("user_id=$u_id")->find();
		$this->display();
	}
	
	
	/*
	 * 收货地址视图
	 */
	public function writeaddress(){
		if($this->isPost()){
			$model = M('Address');
			if($model->add($_POST)){
				$this->redirect("Order/checkout");
			}else{
				$this->error('填写收货人失败');
			}
		}
		$this->display('address');
	}
	
	/*
	 * 订单信息入库
	 */
	public function flow(){
	//开始锁定
        $lock = $this->startlock('lock');//返回 锁定 结果，如果为true则锁定成功，
       //锁定成功，开始 下订单了
        if($lock){
                //接收提交的数据
        $total_price=$_POST['total_price'];//收货人
        $consignee=$_POST['consignee'];//收货人
        $address = $_POST['address'];//收货地址
        $tel = $_POST['tel'];
        $mobile=$_POST['mobile'];
        $shipping_name=$_POST['shipping_name'];
        $pay_name = $_POST['pay_name'];
        $goods_amount=$_POST['goods_amount'];
        $user_id = $_SESSION['user_id'];
        $order_sn="or_".time().rand(1000,9999);
        $time=time();
        $sql="insert into it_order_info(consignee,address,tel,mobile,shipping_name,pay_name,goods_amount,user_id,order_sn,add_time) values('$consignee','$address','$tel','$mobile','$shipping_name','$pay_name','$goods_amount','$user_id','$order_sn','$time')";
            if(M()->Execute($sql)!==false){
                //执行成功；取出购物车里面的信息入库
                $session_id=session_id();
                $cartdata = D('Cart')->showItem();
               // showbug($cartdata);
                foreach($cartdata['list'] as $v){
                    $goods_id=$v['goods_id'];
                    $goods_name =$v['goods_name'];
                    $shop_price = $v['shop_price'];
                    $goods_number = $v['goods_number'];
                    $goods_attr=$v['goods_attr'];
                    $goods_attr_id=$v['goods_attr_id'];
                        $sql="insert into it_order_goods(order_id,goods_id,goods_name,shop_price,goods_number,goods_attr,goods_attr_id) values('$order_sn','$goods_id','$goods_name','$shop_price','$goods_number','$goods_attr','$goods_attr_id')";
                       // var_dump(count($cartdata));
                       // echo '<br>gdsg'.$sql;exit;
                        M()->Execute($sql);
                 }
                    //完成后清空况购物车里面的数据
                    D('Cart')->where("user_id='$user_id'")->delete();
                    //开始释放锁
                    $this->endlock();
                    $this->redirect("Order/done",array('order_sn'=>$order_sn,'total_price'=>$total_price));
                }else{
                    //开始释放锁
                    $this->endlock();
                    $this->error('下订单失败');
                }   
            
                
        }else{
            $this->error('服务器繁忙，请呆会再下订单。');
        } 
	}
	
	/*
	 * 订单完成视图+在线支付
	 */
	public function done(){
		//showbug($_GET);exit;
		$v_mid="23128082";
		$key="#gd*5blac%kxun*5@";
		$v_moneytype = "CNY";
		$v_amount=0.01;//$_GET['total_price'];   //  $_GET['total_price']                                      //订单总金额 测试数据
		$v_oid=$_GET['order_sn'];
		$http_host=$_SERVER['HTTP_HOST'];
		$v_url="http://$http_host/index.php/Order/receive"; //返回支付url
		$v_md5info="";
		$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key;        // 6个 md5加密拼凑串,注意顺序不能变 
		$v_md5info = strtoupper(md5($text));                             //md5函数加密并转化成大写字母
		
		$this->v_mid=$v_mid;//
		$this->v_oid=$v_oid;
		$this->v_url=$v_url;
		$this->v_md5info=$v_md5info;
		$this->total_price=$v_amount;
		$this->display();
	}
	
	/*
	 * 取消订单动作
	 */
	public function cancelOrder(){
		$id=(int)$_GET['id'];
		$order_sn=$_GET['order_sn'];
		//删除订单信息表数据
		if(M("OrderInfo")->delete($id)){
			//删除对应的订单商品表
			if(M("orderGoods")->where("order_id='$order_sn'")->delete()){
				$this->success("取消订单成功",U("User/ucenter3"));exit;
			}else{
				$this->error('删除订单商品失败');
			}
			
		}else{
			$this->error('删除订单失败');
		}
	}
	
	/*
	 * 支付结果url
	 * Array
(
    [user_id] => 5
    [level_id] => 1
    [username] => test1
    [c] => Order
    [act] => checkout
    [post] => Array
        (
            [v_md5all] => E28BC7DF5DA26C25538F8B83BE9B2A41
            [v_md5info] => 2df91f058f367dad64e6b8d13999489c
            [remark1] => 
            [v_pmode] => 邮政储蓄银行
            [remark2] => 
            [v_idx] => 09015201505172414913
            [v_md5] => 64E502E6E2D5C6E9D967F635F3017EE1
            [v_pstatus] => 20
            [v_pstring] => 支付成功
            [v_md5str] => 64E502E6E2D5C6E9D967F635F3017EE1
            [v_md5money] => 3f35d20bc66df6241f7f796ec4d294ed
            [v_moneytype] => CNY
            [v_oid] => or_14317925465752
            [v_amount] => 0.01
        )

)


	 */
	public function receive(){
		$key="#gd*5blac%kxun*5@";     //密钥
		$v_oid     =trim($_POST['v_oid']);
		$v_pmode   =trim($_POST['v_pmode']);
		$v_pstatus =trim($_POST['v_pstatus']);
		$v_pstring =trim($_POST['v_pstring']);
		$v_amount  =trim($_POST['v_amount']);
		$v_moneytype  =trim($_POST['v_moneytype']);
		$remark1   =trim($_POST['remark1' ]);
		$remark2   =trim($_POST['remark2' ]);
		$v_md5str  =trim($_POST['v_md5str' ]);//md5加密字符串
		
		$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key)); //拼凑加密串
		if($v_md5str==$md5string){               //相等表明返回的信息没有被纂改
			if($v_pstatus=="20"){               //支付成功 更改订单信息状态 6 已确认,已付款,未发货
				$user_id=$_SESSION['user_id'];  //会员id
				$data=array();
				$data['status']=6;
				if(M('OrderInfo')->where("user_id=$user_id")->save($data)){
					$this->success("支付成功,我们马上安排发货！",U("Index/index"));exit;
				}
			}else{
				$this->success("支付失败！");
			}
		}
		
		exit;
		showbug($_POST);exit;
	}
}