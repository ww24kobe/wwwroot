<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends HomeAction {
	/*
	 * 首页视图
	 */
    public function  index(){
    	//取出公告10条
    	$this->advdata=M('Advert')->order("add_time  desc")->limit(10)->select();
    	//取出类型商品
    	$this->hotdata=D('Goods')->getGoodsByType('is_hot',3);
    	$this->newdata=D('Goods')->getGoodsByType('is_new',3);
    	$this->bestdata=D('Goods')->getGoodsByType('is_best',3);
    	//取出销售排行榜
    	$this->topgoodsdata=D('Goods')->getGoodsTop(3);
    	//取出普通商品
    	$this->goodsdata=D('Goods')->where("is_sale=1 and  is_delete=0")->limit(5)->select();
    	$this->display();
    	
    	
    }
    /*
     * 调试
     */
    public  function bug(){
    	$arr=get_defined_constants();
    	
    	$http_host=$_SERVER['HTTP_HOST'];
    	showbug($_SESSION);exit;
    }
    
    /*
     * 公告内容视图
     */
    public function showadv(){
    	$id=(int)$_GET['id'];
    	$this->advinfo=M('Advert')->find($id);
    	$this->display();
    }
    
}