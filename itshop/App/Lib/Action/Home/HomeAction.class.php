<?php
class  HomeAction extends Action{
	
	//定义一个静态的属性用于存储打开文件的资源
	public static $lockfile=array();
	
	public  function _initialize(){
		//取出顶级分类
    	$this->topdata=D('Category')->getTop();
    	//取出子孙树
    	$this->catdata=D('Category')->getSonTree();
    	//取出购物车数据
    	$this->cartdata = $this->getcart();
    	//取出历史记录
    	$this->visitdata=$this->getVisit();
    	
    	//检查是否有cookie,系统帮助用户登录
    	$user_id=$_COOKIE['user_id'];
    	$username=isset($_COOKIE['username'])?$_COOKIE['username']:'';
    	$password=isset($_COOKIE['password'])?$_COOKIE['password']:''; //PS:cookie中密码已经加密
    	if(!empty($username)&&!empty($password)){
    		D('Member')->checkLogin($username, $password);
    		D('Member')->updateUserInfo($user_id);
    	}
	}
	
	
	//开始锁定
	//参数：filename要锁定的文件
	public function startlock($filename){
		self::$lockfile[$filename]=$fp=fopen('./Public/'.$filename,'r+');
		$lock = flock($fp,LOCK_EX);
		// var_dump($lock);exit;
		$try=10;
		if(!$lock){
			do{
				$lock = flock($fp,LOCK_EX);
				usleep(5000);//间隔0.05秒尝试。
			}while(!$lock && --$try);
		}
		return $lock;//返回锁定的结果
	}
	//结束锁定
	public function endlock(){
		$fp =  self::$lockfile[$filename];
		@flock($fp,LOCK_UN);
		@fclose($fp);//关闭打开文件。
	}
	
	/*
	 * 显示购物车商品种类和价格
	 */
	public function getCart(){
		$session_id = session_id();
		$user_id=$_SESSION['user_id'];
		if(!empty($user_id)){
			$cartdata = D('Cart')->where("user_id=$user_id")->select();
		}
		//要算出商品的总数和总的价格。
		$number =count($cartdata);//用于存储商品的数量
		$total_price='';//用于存储商品的总的价格
		foreach($cartdata as  $v){
			$total_price+=($v['shop_price']+$v['goods_attr_price'])*$v['goods_number'];
		}
		return array('number'=>$number,'total_price'=>$total_price);
	}
	
	/*
	 * 取出浏览历史
	 */
	public function getVisit(){
		$ids=isset($_COOKIE['visit'])?unserialize($_COOKIE['visit']):array();
		if(empty($ids)){
			return false;
		}
		$ids=implode(',', $ids);
		return  D('Goods')->field("id,goods_name,goods_thumb,shop_price")->where("id in ($ids)")->limit(5)->select();
	}
}