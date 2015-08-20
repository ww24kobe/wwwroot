<?php

class CategoryAction extends  HomeAction{
	/*
	 * 栏目视图
	 */
	public function Category(){
		import('@.Tool.Page'); //引入自定义分页类
		//多条件查询
		$where='';
		//关键字
		if(!empty($_GET['keywords'])){
			unset($_SESSION['query']);
			$_SESSION['query']['keywords']=$_GET['keywords'];//放入session
		}else{//非关键字查询
			if(!empty($_GET['b_id'])){
				$_SESSION['query']['b_id']=$_GET['b_id'];//放入session
				unset($_SESSION['query']['keywords']);
			}elseif($_GET['b_id']=='0'){
				unset($_SESSION['query']['b_id']);
				unset($_SESSION['query']['keywords']);
			}
			//价格查询
			if(!empty($_GET['b_price'])){
				$_SESSION['query']['b_price']=$_GET['b_price'];//放入session
				unset($_SESSION['query']['keywords']);
			}elseif($_GET['b_price']=='0'){
				unset($_SESSION['query']['b_price']);
				unset($_SESSION['query']['keywords']);
			}
			
			//其他查询
			if(!empty($_GET['b_hot'])){
				$_SESSION['query']['is_hot']=1;
				unset($_SESSION['query']['is_new']);
				unset($_SESSION['query']['is_best']);
				unset($_SESSION['query']['keywords']);
			}elseif($_GET['b_new']){
				$_SESSION['query']['is_new']=1;
				unset($_SESSION['query']['is_hot']);
				unset($_SESSION['query']['is_best']);
				unset($_SESSION['query']['keywords']);
			}elseif($_GET['b_best']){
				$_SESSION['query']['is_best']=1;
				unset($_SESSION['query']['is_hot']);
				unset($_SESSION['query']['is_new']);
				unset($_SESSION['query']['keywords']);
			}else{
				unset($_SESSION['query']['is_hot']);
				unset($_SESSION['query']['is_new']);
				unset($_SESSION['query']['is_best']);
				unset($_SESSION['query']['keywords']);
			}
		}
		//showbug($_SESSION['query']);exit;
		//品牌
		
		
	//where查询条件从session['query']里面获取	 拼接查询调价
		if(!empty($_SESSION['query']['keywords'])){
			$keywords=$_SESSION['query']['keywords'];
			$keywords='and keywords like'."'%".$keywords."%'";
			$where.=$keywords;
		}
		
	  if(!empty($_SESSION['query']['b_id'])){
	  	$brand='and brand_id='.$_SESSION['query']['b_id'];
	  	$where.=$brand;
	  }
	  
	   if(!empty($_SESSION['query']['b_price'])){
	   	$price=' and shop_price between '.$_SESSION['query']['b_price'];
	   	$where.=$price;
	   } 
	   
	   if(!empty($_SESSION['query']['is_hot'])){
	   	$other=' and is_hot=1 ';
	   	$where.=$other;
	   }elseif($_SESSION['query']['is_new']){
	   	$other=' and is_new=1 ';
	   	$where.=$other;
	   }elseif($_SESSION['query']['is_best']){
	   	$other=' and is_best=1 ';
	   	$where.=$other;
	   }
		$id=(int)($_GET['id']);
		$count=D('Goods')->where("1 $where")->count();
		$page=new Page($count,4);
		
		$sub_ids=D('Category')->getSonId($id);
		if(empty($ids)){
			$sub_ids[]=$id;
		}
		$ids=implode(',', $sub_ids);
		//取出商品列表
		$sql="select *  from  it_goods where 1 and cat_id in ($ids) and  is_delete=0 $where  order  by sort desc   {$page->limit}";
// 		echo $sql;
		$this->goodsdata=D('Goods')->query($sql);
		
		//取出品牌
		$this->branddata=D('brand')->select();
		//取出精品推荐
		$this->bestdata=D('Goods')->where("cat_id in ($ids) and is_best=1 and is_sale=1 and is_delete=0")->select();
		//面包屑导航
		$this->navdata=D('Category')->findfamily($id);
		$this->count=$count;
		$this->assign('page',$page->fpage());
		$this->display();
	}
}

?>