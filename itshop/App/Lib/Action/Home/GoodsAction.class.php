<?php
class  GoodsAction extends HomeAction{
	
	/*
	 * 商品详情页视图
	 */
	public function detail(){
		$id=(int)$_GET['id'];
		
		$data=M('brand')->select();
		//showbug($_SERVER);exit;
		//品牌数据字典
		$newdata=array();
		foreach($data as $v){
			$newdata[$v['id']]=$v['b_name'];
		}
		$this->branddata=$newdata;
		
		//分配用户名和id数据字典
		$data=M('Member')->select();
		$userdata=array();
		foreach($data as $v){
			$userdata[$v['id']]=$v['username'];
		}
		//showbug($userdata);exit;
		$this->userdata=$userdata;
		
		$goodsinfo=D('Goods')->find($id);
		$this->visitHistory($id);
		$this->goodsinfo=$goodsinfo;
		//分配商品id
		$this->goods_id=$id;
		//取出等级会员的价格
		$this->memberprice=D('Goods')->getMemberPrice($id,$goodsinfo['shop_price']);
		//取出属性价格
		$this->attrdata=D('Goods')->getAttrById($id);
		//取出面包屑导航
		$this->navdata=D('Category')->findfamily($goodsinfo['cat_id']);
		//取出评论总数
		$this->count=D('Comment')->count();
		//取出评论
		$this->commentdata=D('Comment')->where("goods_id=$id")->order("time desc")->limit(5)->select();
		
	
		$this->display();
	}
	
	
	
	/*
	 * 浏览历史
	 */
	public  function  visitHistory($goods_id){
		$ids=isset($_COOKIE['visit'])?unserialize($_COOKIE['visit']):array();
		if(!in_array($goods_id, $ids)){
			$ids[]=$goods_id;
		}
		setcookie('visit',serialize($ids),time()+24*3600,'/');
	}
	
	/*
	 * 清空浏览历史
	 */
	public function clearVisit(){
		setcookie('visit','',time()-100,'/');
		$this->redirect('Index/index');
	}
}